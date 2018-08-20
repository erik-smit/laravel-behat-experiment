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
     * @BeforeFeature
     */
    public static function prepare()
    {
        Artisan::call('migrate:refresh');
    }

    /**
     * @Given there are users:
     */
    public function thereAreUsers(TableNode $table)
    {
        $users = $table->getHash();
        foreach ($users as $user) {
            $user = App\User::firstOrCreate([
                'email' => $user['email']
                ], [
                'name' => $user['name'],
                'role' => $user['role'],
                'password' => bcrypt($user['password'])
            ]);
        }
    }

    /**
     * @Given there are customers:
     */
    public function thereAreCustomers(TableNode $table)
    {
        $customers = $table->getHash();
        foreach ($customers as $customer) {
            $customer = App\Customer::firstOrCreate([
                'companyname' => $customer['companyname']
                ], [
                'contactname' => $customer['contactname'],
                'contactmail' => $customer['contactmail'],
                'address' => $customer['address'],
                'country' => $customer['country'],
                'memo' => $customer['memo']
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
