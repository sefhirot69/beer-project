# This file contains a user story for demonstration only.
# Learn how to get started with Behat and BDD on Behat's website:
# http://behat.org/en/latest/quick_start.html

Feature:
  Comprobamos el estado de la aplicación

  Scenario: Esto recibe un codigo de estado 200
    When I send a 'GET' request to "/healthcheck"
    Then response code should be 200
