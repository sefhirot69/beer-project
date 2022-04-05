Feature:
  Quiero que me devuelva una cerveza

  Scenario: Get Beer Randon
    When I send a 'GET' request to "/beer":
    Then response code should be 200

  Scenario: Get Beer Random With Detail
    When I send a 'GET' request to "/beer/detail":
    Then response code should be 200