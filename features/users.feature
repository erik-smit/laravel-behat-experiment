Feature: Users
  In order to check correct permissions
  As a visitor
  I should be able to visit some pages but not others

  Background:
    Given there are users:
    | name                 | email               | password | role  |
    | admin@example.com    | admin@example.com   | 123456   | admin |
    | user@example         | user@example.com    | 22@222   | user  |

  Scenario: Correct credentials can log in
    Given I sign in with 'admin@example.com' '123456' successfully
    When I follow "Logout"
    Then I should be on "/logout"

  Scenario: Incorrect credentials can not log in
    Given I sign in with 'admin@example.com' 'wrongpass'
    Then I should be on "/login"



  