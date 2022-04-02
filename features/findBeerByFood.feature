Feature:
  Quiero que, dado una comida o tipo de comida
  me devuelva una cerveza que guarde relación con la comida.

  Scenario: Find Beer By Food
    When I send a 'GET' request to "/beer" with values:
      | name | value |
      | food | beer  |
    Then response code should be 200
    And the response should contain json:
      """
      [
        {
          "id": 178,
          "name": "Simcoe",
          "description": "A special release of our IPA is Dead series - IPA is Dead Simoce. Hopped to hell with citrusy bitter and aroma hops from the West Coast of the USA. Bitter, orange, mandarin, floral, this IPA showcases the best the west has to offer.",
          "details": null
        },
        {
          "id": 188,
          "name": "Paradox Jura",
          "description": "Paradox. Reloaded. In 2011 we put Paradox into high gear to create an Imperial Stout destined for ageing. Loaded with dark roasted malts for a full bodied, toasted background, an array of bitter, earthy and resinous hops, and brewed with oats for a bold mouthfeel. This beer is the perfect canvas for barrel ageing.",
          "details": null
        },
        {
          "id": 218,
          "name": "Monk Hammer",
          "description": "Jack Hammer has been single handedly ripping it up for quite some time. Now, the definitive bitter and twisted IPA, has spawned four Hammer Head off-springs. Monk Hammer is the first of our super-charge hyped up hybrids. A dark cloaked holy man packing an unholy punch. Belgian yeast and American hops untie on a cardinal scale. Steel yourself for biblical volumes of grapefruit, bow your head for a wave of spicy, fruity yeast character, then cross yourself for the bitterest of bitter finishes. Let your senses succumb to this 21st century incarnation. Monk Hammer – worship daily.",
          "details": null
        },
        {
          "id": 267,
          "name": "AB:22",
          "description": "An imperial stout brewed with cacao and coffee, AB22 has spent two years in darkness, drawing complex and indulgent flavours from the Speyside whisky casks in which it resided.",
          "details": null
        }
      ]
      """