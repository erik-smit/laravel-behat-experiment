Feature: Invoice
  As a user
  I want to be able to create and modify invoice orders
  and be able to process invoice orders into invoices
  So that I can create invoices for the customers

  Background:
    Given there are users:
    | name        | email                   | password | role  |
    | useraccount | user@example.com        | 234567   | user  |

    Given there are customers:
    | companyname | contactname | contactmail      | address    | country | memo |
    | 1stcompany  | 1stcontact  | 1st@example.com  | newaddress | NL      | memo | 
    | 2ndcompany  | 2ndcontact  | 2nd@example.com  | newaddress | NL      | memo | 

  Scenario: User can create invoice orders
    Given I sign in with 'user@example.com' '234567' successfully
    When I am on "/invoiceorder"
    When I follow "Create new invoice order"
    Then I should be on "/invoiceorder/create"
    When I fill in the following:
    | customer  | 1           |
    | product[] | 1stproduct  |
    | number[]  | 10          |
    | price[]   | 123         |
    And I press "Create invoice order"
    And I should see "1stproduct"
    And I should see "1stcompany"

  Scenario: User can modify invoice order
    Given I sign in with 'user@example.com' '234567' successfully
    When I am on "/invoiceorder"
    Then I should see "1"
    When I follow "1"
    And I follow "Edit invoice order"
    When I fill in the following:
    | customer  | 2           |
    | product[] | 2ndproduct  |
    | number[]  | 10          |
    | price[]   | 123         |
    And I press "Edit invoice order"
    Then I should see "2ndcompany"
    And I should see "2ndproduct"

  Scenario: User can delete invoice order
    Given I sign in with 'user@example.com' '234567' successfully
    When I am on "/invoiceorder"
    Then I should see "1"
    When I follow "1"
    And I follow "Delete invoice order"
    Then I should see "Are you sure"
    When I press "Delete invoice order"
    Then I should be on "/invoiceorder"
    And I should not see "1"

