Feature: Customers
  As a user
  I want to be to create, modify and delete customers
  So that I can create invoices for the customers

  Background:
    Given there are users:
    | name        | email                   | password | role  |
    | admin       | admin@example.com       | 123456   | admin |
    | useraccount | user@example.com        | 234567   | user  |

  Scenario: User can create customers
    Given I sign in with 'user@example.com' '234567' successfully
    When I am on "/customer"
    Then I should not see "behatcompany"
    When I follow "Create new customer"
    Then I should be on "/customer/create"
    When I fill in "companyname" with "behatcompany"
    And I fill in "contactname" with "behatcontact"
    And I fill in "contactmail" with "behatmail@example.com"
    And I fill in "address" with "behataddress"
    And I fill in "country" with "NL"
    And I fill in "memo" with "behatmemo"
    And I press "Create customer"
    Then I should be on "/customer"
    And I should see "behatcompany"
    When I follow "behatcompany"
    Then I should see "behatcompany" in the "#companynamefield" element
    And I should see "behatcontact" in the "#contactnamefield" element
    And I should see "behataddress" in the "#addressfield" element
    And I should see "NL" in the "#countryfield" element
    And I should see "behatmemo" in the "#memofield" element

  Scenario: User can modify customers
    Given I sign in with 'user@example.com' '234567' successfully
    When I am on "/customer"
    Then I should see "behatcompany"
    When I follow "behatcompany"
    And I follow "Edit customer"
    And I fill in "companyname" with "newcompany"
    And I fill in "contactname" with "newcontact"
    And I fill in "contactmail" with "newmail@example.com"
    And I fill in "address" with "newaddress"
    And I fill in "country" with "BE"
    And I fill in "memo" with "newmemo"
    And I press "Edit customer"
    Then I should see "newcompany" in the "#companynamefield" element
    And I should see "newcontact" in the "#contactnamefield" element
    And I should see "newmail@example.com" in the "#contactmailfield" element
    And I should see "newaddress" in the "#addressfield" element
    And I should see "BE" in the "#countryfield" element
    And I should see "newmemo" in the "#memofield" element

  Scenario: User can delete customers
    Given I sign in with 'user@example.com' '234567' successfully
    When I am on "/customer"
    Then I should see "newcompany"
    When I follow "newcompany"
    And I follow "Delete customer"
    Then I should see "Are you sure"
    When I press "Delete customer"
    Then I should be on "/customer"
    And I should not see "newcompany"

