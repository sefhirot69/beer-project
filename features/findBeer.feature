Feature:
  Quiero que me devuelva una cerveza

  Scenario: Find Beer By Food
    When I send a 'GET' request to "/beer":
    Then response code should be 200