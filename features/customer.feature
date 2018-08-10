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
    When I fill in "companyname" with "<companyname>"
    And I fill in "contactname" with "<contactname>"
    And I fill in "contactmail" with "<contactmail>"
    And I fill in "address" with "<address>"
    And I fill in "country" with "<country>"
    And I press "Create customer"
    Then I should be on "/customer"
    And I should see "<companyname>"
    When I follow "<companyname>"
    Then I should see "<companyname>" in the "companynamefield" element
    And I should see "<contactname>" in the "contactnamefield" element
    And I should see "<address>" in the "addressfield" element
    And I should see "<country>" in the "countryfield" element

    Examples:
      | username         | password | companyname  | contactname  | address      | country | memo      |
      | user@example.com | 234567   | behatcompany | behatcontact | behataddress | NL      | behatmemo |

  Scenario Outline: User can modify customers
    Given I sign in with '<username>' '<password>' successfully
    When I am on "/customer"
    Then I should see "<oldcompanyname>"
    When I follow "<oldcompanyname>"
    And I follow "Modify customer"
    And I fill in "contactname" with "<contactname>"
    And I fill in "contactmail" with "<contactmail>"
    And I fill in "address" with "<address>"
    And I fill in "country" with "<country>"
    And I press "Modify customer"
    Then I should see "<companyname>" in the "companynamefield" element
    And I should see "<contactname>" in the "contactnamefield" element
    And I should see "<address>" in the "addressfield" element
    And I should see "<country>" in the "country" element

    Examples:
      | username         | password | oldcompanyname | companyname  | contactname  | address      | country | 
      | user@example.com | 234567   | behatcompany   | newcompany   | newcontact   | newaddress   | BE      | 
