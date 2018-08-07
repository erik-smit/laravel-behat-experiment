Feature: Users
  In order to check correct permissions
  As a visitor
  I should be able to visit some pages but not others

  Background:
    Given there are users:
    | name                 | email               | password | role  |
    | admin@example.com    | admin@example.com   | 123456   | admin |
    | user@example         | user@example.com    | 22@222   | user  |

  Scenario: Can log in with correct credentials
    Given I sign in with 'admin@example.com' '123456' successfully
    When I follow "Logout"
    Then I should be on "/logout"

  Scenario: Fail to login with incorrect credentials
    Given I sign in with 'admin@example.com' 'wrongpass'
    Then I should be on "/login"

  Scenario: Admin can create user
    Given I sign in with 'admin@example.com' '123456' successfully
    When I am on "/user"
    Then the response should not contain "behattest"
    When I follow "Create new user"
    Then I should be on "/user/create"
    When I fill in "name" with "behattest"
    And I fill in "email" with "behat@example.com"
    And I fill in "role" with "user"
    And I fill in "password" with "1234abcd"
    And I fill in "password-confirm" with "1234abcd"
    And I press "Create user"
    Then I should be on "/user"
    And the response should contain "behattest"

  Scenario: Admin can delete user
    Given I sign in with 'admin@example.com' '123456' successfully
    When I am on "/user"
    Then the response should contain "behattest"
    When I follow "behattest"
    When I follow "Delete user"
    Then the response should contain "Are you sure"
    When I press "Delete user"
    Then I should be on "/user"
    And the response should not contain "behattest"


  