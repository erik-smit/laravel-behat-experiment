# setup

1. composer update
2. composer install
3. copy .env.example -> .env en config mysql
4. php artisan tinker

User::create(['name' => 'admin', 'email' => 'admin@example.com', 'role' => 'admin', 'password' => Hash::make("1234abcd")]);

voor behat:

5. patch https://github.com/laracasts/Behat-Laravel-Extension/pull/81/files to vendor\laracasts
6. patch https://github.com/Behat/Behat/pull/1163/files to 
7. sqlite3 database\database.sqlite "create table aTable(field1 int); drop table aTable;"

# behat output

```
λ vendor\bin\behat.bat
Feature: Customers
  As a user
  I want to be to create, modify and delete customers
  So that I can create invoices for the customers

  Background:              # features\customer.feature:6
    Given there are users: # FeatureContext::thereAreUsers()
      | name        | email             | password | role  |
      | admin       | admin@example.com | 123456   | admin |
      | useraccount | user@example.com  | 234567   | user  |

  Scenario: User can create customers                                   # features\customer.feature:12
    Given I sign in with 'user@example.com' '234567' successfully       # FeatureContext::iSignInSuccess()
    When I am on "/customer"                                            # FeatureContext::visit()
    Then I should not see "behatcompany"                                # FeatureContext::assertPageNotContainsText()
    When I follow "Create new customer"                                 # FeatureContext::clickLink()
    Then I should be on "/customer/create"                              # FeatureContext::assertPageAddress()
    When I fill in "companyname" with "behatcompany"                    # FeatureContext::fillField()
    And I fill in "contactname" with "behatcontact"                     # FeatureContext::fillField()
    And I fill in "contactmail" with "behatmail@example.com"            # FeatureContext::fillField()
    And I fill in "address" with "behataddress"                         # FeatureContext::fillField()
    And I fill in "country" with "NL"                                   # FeatureContext::fillField()
    And I fill in "memo" with "behatmemo"                               # FeatureContext::fillField()
    And I press "Create customer"                                       # FeatureContext::pressButton()
    Then I should be on "/customer"                                     # FeatureContext::assertPageAddress()
    And I should see "behatcompany"                                     # FeatureContext::assertPageContainsText()
    When I follow "behatcompany"                                        # FeatureContext::clickLink()
    Then I should see "behatcompany" in the "#companynamefield" element # FeatureContext::assertElementContainsText()
    And I should see "behatcontact" in the "#contactnamefield" element  # FeatureContext::assertElementContainsText()
    And I should see "behataddress" in the "#addressfield" element      # FeatureContext::assertElementContainsText()
    And I should see "NL" in the "#countryfield" element                # FeatureContext::assertElementContainsText()
    And I should see "behatmemo" in the "#memofield" element            # FeatureContext::assertElementContainsText()

  Scenario: User can modify customers                                         # features\customer.feature:34
    Given I sign in with 'user@example.com' '234567' successfully             # FeatureContext::iSignInSuccess()
    When I am on "/customer"                                                  # FeatureContext::visit()
    Then I should see "behatcompany"                                          # FeatureContext::assertPageContainsText()
    When I follow "behatcompany"                                              # FeatureContext::clickLink()
    And I follow "Edit customer"                                              # FeatureContext::clickLink()
    And I fill in "companyname" with "newcompany"                             # FeatureContext::fillField()
    And I fill in "contactname" with "newcontact"                             # FeatureContext::fillField()
    And I fill in "contactmail" with "newmail@example.com"                    # FeatureContext::fillField()
    And I fill in "address" with "newaddress"                                 # FeatureContext::fillField()
    And I fill in "country" with "BE"                                         # FeatureContext::fillField()
    And I fill in "memo" with "newmemo"                                       # FeatureContext::fillField()
    And I press "Edit customer"                                               # FeatureContext::pressButton()
    Then I should see "newcompany" in the "#companynamefield" element         # FeatureContext::assertElementContainsText()
    And I should see "newcontact" in the "#contactnamefield" element          # FeatureContext::assertElementContainsText()
    And I should see "newmail@example.com" in the "#contactmailfield" element # FeatureContext::assertElementContainsText()
    And I should see "newaddress" in the "#addressfield" element              # FeatureContext::assertElementContainsText()
    And I should see "BE" in the "#countryfield" element                      # FeatureContext::assertElementContainsText()
    And I should see "newmemo" in the "#memofield" element                    # FeatureContext::assertElementContainsText()

  Scenario: User can delete customers                             # features\customer.feature:54
    Given I sign in with 'user@example.com' '234567' successfully # FeatureContext::iSignInSuccess()
    When I am on "/customer"                                      # FeatureContext::visit()
    Then I should see "newcompany"                                # FeatureContext::assertPageContainsText()
    When I follow "newcompany"                                    # FeatureContext::clickLink()
    And I follow "Delete customer"                                # FeatureContext::clickLink()
    Then I should see "Are you sure"                              # FeatureContext::assertPageContainsText()
    When I press "Delete customer"                                # FeatureContext::pressButton()
    Then I should be on "/customer"                               # FeatureContext::assertPageAddress()
    And I should not see "newcompany"                             # FeatureContext::assertPageNotContainsText()
    And the response status code should be 200                    # FeatureContext::assertResponseStatus()

Feature: Invoice
  As a user
  I want to be able to create and modify invoice orders
  and be able to process invoice orders into invoices
  So that I can create invoices for the customers

  Background:                  # features\invoice.feature:7
    Given there are users:     # FeatureContext::thereAreUsers()
      | name        | email            | password | role |
      | useraccount | user@example.com | 234567   | user |
    Given there are customers: # FeatureContext::thereAreCustomers()
      | companyname | contactname | contactmail     | address    | country | memo |
      | 1stcompany  | 1stcontact  | 1st@example.com | newaddress | NL      | memo |
      | 2ndcompany  | 2ndcontact  | 2nd@example.com | newaddress | NL      | memo |

  Scenario: User can create invoice order                         # features\invoice.feature:17
    Given I sign in with 'user@example.com' '234567' successfully # FeatureContext::iSignInSuccess()
    When I am on "/invoiceorder"                                  # FeatureContext::visit()
    When I follow "Create new invoice order"                      # FeatureContext::clickLink()
    Then I should be on "/invoiceorder/create"                    # FeatureContext::assertPageAddress()
    When I fill in the following:                                 # FeatureContext::fillFields()
      | customer  | 1          |
      | product[] | 1stproduct |
      | number[]  | 10         |
      | price[]   | 123        |
    And I press "Create invoice order"                            # FeatureContext::pressButton()
    Then I should see "1stproduct"                                # FeatureContext::assertPageContainsText()
    And I should see "1stcompany"                                 # FeatureContext::assertPageContainsText()

  Scenario: User can modify invoice order                         # features\invoice.feature:31
    Given I sign in with 'user@example.com' '234567' successfully # FeatureContext::iSignInSuccess()
    When I am on "/invoiceorder"                                  # FeatureContext::visit()
    Then I should see "1"                                         # FeatureContext::assertPageContainsText()
    When I follow "1"                                             # FeatureContext::clickLink()
    And I follow "Edit invoice order"                             # FeatureContext::clickLink()
    When I fill in the following:                                 # FeatureContext::fillFields()
      | customer  | 2          |
      | product[] | 2ndproduct |
      | number[]  | 10         |
      | price[]   | 123        |
    And I press "Edit invoice order"                              # FeatureContext::pressButton()
    Then I should see "2ndcompany"                                # FeatureContext::assertPageContainsText()
    And I should see "2ndproduct"                                 # FeatureContext::assertPageContainsText()

  Scenario: User can delete invoice order                         # features\invoice.feature:46
    Given I sign in with 'user@example.com' '234567' successfully # FeatureContext::iSignInSuccess()
    When I am on "/invoiceorder"                                  # FeatureContext::visit()
    Then I should see "1"                                         # FeatureContext::assertPageContainsText()
    When I follow "1"                                             # FeatureContext::clickLink()
    And I follow "Delete invoice order"                           # FeatureContext::clickLink()
    Then I should see "Are you sure"                              # FeatureContext::assertPageContainsText()
    When I press "Delete invoice order"                           # FeatureContext::pressButton()
    Then I should be on "/invoiceorder"                           # FeatureContext::assertPageAddress()
    And I should not see "1"                                      # FeatureContext::assertPageNotContainsText()

  Scenario: User can create invoice order to process into invoice # features\invoice.feature:57
    Given I sign in with 'user@example.com' '234567' successfully # FeatureContext::iSignInSuccess()
    When I am on "/invoiceorder"                                  # FeatureContext::visit()
    When I follow "Create new invoice order"                      # FeatureContext::clickLink()
    Then I should be on "/invoiceorder/create"                    # FeatureContext::assertPageAddress()
    When I fill in the following:                                 # FeatureContext::fillFields()
      | customer  | 2          |
      | product[] | 2ndproduct |
      | number[]  | 10         |
      | price[]   | 123        |
    And I press "Create invoice order"                            # FeatureContext::pressButton()
    Then I should see "2ndproduct"                                # FeatureContext::assertPageContainsText()
    And I should see "2ndcompany"                                 # FeatureContext::assertPageContainsText()
    When I press "Process invoice order"                          # FeatureContext::pressButton()
    Then I should see "2ndproduct"                                # FeatureContext::assertPageContainsText()
    And I should see "2ndcompany"                                 # FeatureContext::assertPageContainsText()
    When I follow "Download invoice as PDF"                       # FeatureContext::clickLink()
    Then the response status code should be 200                   # FeatureContext::assertResponseStatus()

Feature: Users
  In order to administer the website
  As an admin
  I should be able to manage users

  Background:              # features\user.feature:6
    Given there are users: # FeatureContext::thereAreUsers()
      | name        | email                   | password | role  |
      | admin       | admin@example.com       | 123456   | admin |
      | useraccount | user@example.com        | 234567   | user  |
      | testaccount | testaccount@example.com | 22@222   | user  |

  Scenario: Can log in with correct credentials                    # features\user.feature:13
    Given I sign in with 'admin@example.com' '123456' successfully # FeatureContext::iSignInSuccess()
    When I follow "Logout"                                         # FeatureContext::clickLink()
    Then I should be on "/logout"                                  # FeatureContext::assertPageAddress()

  Scenario: Fail to login with incorrect credentials     # features\user.feature:18
    Given I sign in with 'admin@example.com' 'wrongpass' # FeatureContext::iSignIn()
    Then I should be on "/login"                         # FeatureContext::assertPageAddress()

  Scenario: Admin can create user                                  # features\user.feature:22
    Given I sign in with 'admin@example.com' '123456' successfully # FeatureContext::iSignInSuccess()
    When I am on "/user"                                           # FeatureContext::visit()
    Then I should not see "behattest"                              # FeatureContext::assertPageNotContainsText()
    When I follow "Create new user"                                # FeatureContext::clickLink()
    Then I should be on "/user/create"                             # FeatureContext::assertPageAddress()
    When I fill in the following:                                  # FeatureContext::fillFields()
      | name             | behattest         |
      | email            | behat@example.com |
      | role             | user              |
      | password         | 1234abcd          |
      | password-confirm | 1234abcd          |
    And I press "Create user"                                      # FeatureContext::pressButton()
    Then I should be on "/user"                                    # FeatureContext::assertPageAddress()
    And I should see "behattest"                                   # FeatureContext::assertPageContainsText()

  Scenario: Admin can delete user                                  # features\user.feature:38
    Given I sign in with 'admin@example.com' '123456' successfully # FeatureContext::iSignInSuccess()
    When I am on "/user"                                           # FeatureContext::visit()
    Then I should see "behattest"                                  # FeatureContext::assertPageContainsText()
    When I follow "behattest"                                      # FeatureContext::clickLink()
    When I follow "Delete user"                                    # FeatureContext::clickLink()
    Then I should see "Are you sure"                               # FeatureContext::assertPageContainsText()
    When I press "Delete user"                                     # FeatureContext::pressButton()
    Then I should be on "/user"                                    # FeatureContext::assertPageAddress()
    And I should not see "behattest"                               # FeatureContext::assertPageNotContainsText()
    And the response status code should be 200                     # FeatureContext::assertResponseStatus()

  Scenario: Admin can view and edit user                                     # features\user.feature:50
    Given I sign in with 'admin@example.com' '123456' successfully           # FeatureContext::iSignInSuccess()
    When I am on "/user"                                                     # FeatureContext::visit()
    And I follow "testaccount"                                               # FeatureContext::clickLink()
    Then I should see "testaccount@example.com" in the "#emailfield" element # FeatureContext::assertElementContainsText()
    And I should see "testaccount" in the "#namefield" element               # FeatureContext::assertElementContainsText()
    And I should see "user" in the "#rolefield" element                      # FeatureContext::assertElementContainsText()
    When I follow "Edit user"                                                # FeatureContext::clickLink()
    And I fill in "name" with "behattestaccount"                             # FeatureContext::fillField()
    And I fill in "role" with "admin"                                        # FeatureContext::fillField()
    And I press "Edit user"                                                  # FeatureContext::pressButton()
    Then I should see "behattestaccount" in the "#namefield" element         # FeatureContext::assertElementContainsText()
    And I should see "admin" in the "#rolefield" element                     # FeatureContext::assertElementContainsText()

  Scenario: User can not view userlist                            # features\user.feature:64
    Given I sign in with 'user@example.com' '234567' successfully # FeatureContext::iSignInSuccess()
    When I am on "/user"                                          # FeatureContext::visit()
    Then the response should not contain "testaccount"            # FeatureContext::assertResponseNotContains()
    And the response status code should be 401                    # FeatureContext::assertResponseStatus()

13 scenarios (13 passed)
144 steps (144 passed)
0m4.89s (32.50Mb)
```
