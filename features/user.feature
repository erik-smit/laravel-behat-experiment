Feature: Users
  In order to administer the website
  As an admin
  I should be able to manage users

  Background:
    Given there are users:
    | name        | email                   | password | role  |
    | admin       | admin@example.com       | 123456   | admin |
    | useraccount | user@example.com        | 234567   | user  |
    | testaccount | testaccount@example.com | 22@222   | user  |

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
    Then I should not see "behattest"
    When I follow "Create new user"
    Then I should be on "/user/create"
    When I fill in the following:
      | name             | behattest         |
      | email            | behat@example.com |
      | role             | user              |
      | password         | 1234abcd          |
      | password-confirm | 1234abcd          |
    And I press "Create user"
    Then I should be on "/user"
    And I should see "behattest"

  Scenario: Admin can delete user
    Given I sign in with 'admin@example.com' '123456' successfully
    When I am on "/user"
    Then I should see "behattest"
    When I follow "behattest"
    When I follow "Delete user"
    Then I should see "Are you sure"
    When I press "Delete user"
    Then I should be on "/user"
    And I should not see "behattest"

  Scenario: Admin can view and edit user
    Given I sign in with 'admin@example.com' '123456' successfully
    When I am on "/user"
    And I follow "testaccount"
    Then I should see "testaccount@example.com" in the "#emailfield" element
    And I should see "testaccount" in the "#namefield" element
    And I should see "user" in the "#rolefield" element
    When I follow "Edit user"
    And I fill in "name" with "behattestaccount"
    And I fill in "role" with "admin"
    And I press "Edit user"
    Then I should see "behattestaccount" in the "#namefield" element
    And I should see "admin" in the "#rolefield" element

  Scenario: User can not view userlist
    Given I sign in with 'user@example.com' '234567' successfully
    When I am on "/user"
    Then the response should not contain "testaccount"
