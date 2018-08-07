<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use PHPUnit\Framework\Assert as PHPUnit;
use App\User;
use Laracasts\Behat\Context\MigrateRefresh;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context
{
    /**
     * Migrate the database before this suite
     *
     * @BeforeSuite
     */
    public static function prepare()
    {
        Artisan::call('migrate:refresh');
    }

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Then I can do something with Laravel
     */
    public function iCanDoSomethingWithLaravel()
    {
        PHPUnit::assertEquals('.env.behat', app()->environmentFile());
        PHPUnit::assertEquals('acceptance', env('APP_ENV'));
        PHPUnit::assertTrue(config('app.debug'));
    }

    /**
     * @Given the method :arg1 receives the numbers :arg2 and :arg3
     */
    public function theMethodReceivesTheNumbersAnd($arg1, $arg2, $arg3)
    {
        $this->calculator = new Calculator();
        $this->calculator->$arg1($arg2, $arg3);
    }

    /**
     * @Then the calculated value should be :arg1
     */
    public function theCalculatedValueShouldBe($arg1)
    {
        PHPUnit::assertEquals($arg1, $this->calculator->result());
    }

    /**
     * @Given there are users:
     */
    public function thereAreUsers(TableNode $table)
    {
        $users = $table->getHash();
        foreach ($users as $user) {
            if (App\User::where('email', $user['email'])->count())
                continue;
            $user = App\User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
                'password' => bcrypt($user['password'])
            ]);
        }
    }

    /**
     * @Given I sign in with :email :password
     */
    public function iSignIn($email, $password)
    {
        $this->visit('/login');
        $this->fillField('email', $email);
        $this->fillField('password', $password);
        $this->pressButton('Login');
    }

    /**
     * @Given I sign in with :email :password successfully
     */
    public function iSignInSuccess($email, $password)
    {
        $this->iSignIn($email, $password);
        $this->assertPageAddress("/home");
    }
}
