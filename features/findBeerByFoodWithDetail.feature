Feature:
  Quiero que, dado una comida o tipo de comida
  me devuelva una cerveza que guarde relación con la comida.


  Scenario: Find Beer By Food With Detail
    When I send a 'GET' request to "/beer/food/pineapple/detail":
    Then response code should be 200
    And the response should contain json:
      """
            [
        {
          "id": 39,
          "name": "Kohatu - IPA Is Dead",
          "description": "As you’d expect from a New Zealand hop variety, Kohatu contributes bags of tropical fruit, but with loads of lime notes, & pineapple hits. Seriously fruity, with sweet, juicy melon and stonefruit notes.",
          "details": {
            "imageUrl": "https://images.punkapi.com/v2/39.png",
            "tagLine": "Single Hop India Pale Ale.",
            "firstBrewed": "02/2014"
          }
        },
        {
          "id": 178,
          "name": "Simcoe",
          "description": "A special release of our IPA is Dead series - IPA is Dead Simoce. Hopped to hell with citrusy bitter and aroma hops from the West Coast of the USA. Bitter, orange, mandarin, floral, this IPA showcases the best the west has to offer.",
          "details": {
            "imageUrl": "https://images.punkapi.com/v2/178.png",
            "tagLine": "Single Hop India Pale Ale.",
            "firstBrewed": "01/2012"
          }
        },
        {
          "id": 232,
          "name": "Ace Of Equinox",
          "description": "We love hops. We adore and worship their profile ability to transform beer. You could say that we have a terminal addiction. To celebrate this fetish we’re heroing our favourites in single hopped limited releases. No also starring, no extras, no compromise. The Hop is the Hero. A biscuity malty backbone builds to intense tropical fruit, with bitter resin notes, culminating with an explosive papya hit and a long bitter finish. Our Ace in the hole, devastatingly singular, deliciously bitter. Serving up an Ace each and every time.",
          "details": {
            "imageUrl": "https://images.punkapi.com/v2/232.png",
            "tagLine": "Single-Hopped Session IPA.",
            "firstBrewed": "01/2016"
          }
        },
        {
          "id": 245,
          "name": "Beatnik",
          "description": "We gave our Equity Punks the keys to the brewery and let them brew the beer, as well as join Q&As and tour our HQ. The beer was voted on exclusively by Equity Punks.",
          "details": {
            "imageUrl": null,
            "tagLine": "Imperial Red Ale",
            "firstBrewed": "2016"
          }
        },
        {
          "id": 248,
          "name": "Twin Atlantic",
          "description": "Brewed in collaboration with our AGM-headlining band, Twin Atlantic, this US style pale features some of our favourite hops and is loaded with tropical fruit.",
          "details": {
            "imageUrl": "https://images.punkapi.com/v2/keg.png",
            "tagLine": "Mango & Pineapple Pale",
            "firstBrewed": "2016"
          }
        }
      ]
      """