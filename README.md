# 🍺 Catálogo Cervezas 

---
![Composer](https://github.com/sefhirot69/beer-project/actions/workflows/php.yml/badge.svg)
<a href="#"><img alt="Symfony 4.4" src="https://img.shields.io/badge/Symfony-4.4-purple.svg?style=flat-square&amp;logo=symfony"/></a>
![PHP Coding Standar](https://github.com/sefhirot69/beer-project/actions/workflows/style_standard.yml/badge.svg)
![CI](https://github.com/sefhirot69/beer-project/actions/workflows/tests.yml/badge.svg)
---

## 🚀 Instalación

### 🐳 Herramientas necesarias

1. [Instalar Docker](https://www.docker.com/get-started)
2. Clona este proyecto: `git clone https://github.com/sefhirot69/beer-project.git`
3. __Opcional__: Instalar el comando `make` para mejorar el punto de entrada a nuestra aplicación.
    1. [Instalar en OSX](https://formulae.brew.sh/formula/make)
    2. [Instalar en Window](https://parzibyte.me/blog/2020/12/30/instalar-make-windows/#Descargar_make)
    
### 🛠️ Configuración de variables de entorno

1. Create una variable de entorno local (`cp .env .env.local`) si quieres modificar cualquier variable de entorno.

### 🔥 Ejecutar aplicación

1. Escribe por terminal el comando `make`. Este comando instalara todo lo necesario para arrancar la aplicación.
   1. ***Opcional*** - Si no tenéis el comando `make`, ejecuta `docker-compose up -d` y luego instala las dependencias dentro del contenedor generado `composer install`.
2. Tienes 3 urls disponibles:
   1. App - http://localhost:8081
   2. Swagger API - http://localhost:8080
      1. ***Opcional*** - Puedes importar el fichero raíz `api_documentation.postman_collection.json` a tu aplicación de **Postman**, para ver los endpoints disponibles.
   3. Swagger Editor - http://localhost:8082

### ✅ Ejecución de Tests

1. Para ejecutar todos los tests `make test`

### 🦌 Comandos útiles __Makefile__ ###
* Comandos útiles:
    * Este comando `make update-deps` actualiza la aplicación mediante composer.
    * Este comando `make install-deps` instala las últimas dependencias del `composer.lock`.
* Comandos composer:
    * `make composer-install`
    * `make composer-update`
    * `make composer-require module="[paquete]"` o `make composer-require module="[paquete] --dev"`
* Comandos symfony:
    * Limpiar cache `make clear`

## 🏘 Estructura

### 🌳 Estructura de la app

```
.
├── BeerCatalog
│   ├── Beer
│   │   ├── Application
│   │   │   └── Find
│   │   │       ├── FindBeerByFoodQueryHandler.php
│   │   │       ├── FindBeerByFoodQueryHandlerInterface.php
│   │   │       └── Query
│   │   │           └── FindBeerByFoodQuery.php
│   │   ├── Domain
│   │   │   ├── Beer.php
│   │   │   ├── BeerDetails.php
│   │   │   ├── CatalogBeer.php
│   │   │   ├── DataSource
│   │   │   │   └── FinderBeerDataSource.php
│   │   │   ├── Dto
│   │   │   │   ├── BeerDetailsDto.php
│   │   │   │   ├── BeerDto.php
│   │   │   │   └── CatalogBeerDto.php
│   │   │   └── Exceptions
│   │   │       └── BeersNotFoundException.php
│   │   └── Infrastructure
│   │       └── ApiPunkFinderBeerRepository.php
│   └── Shared
│       ├── Domain
│       │   ├── Exceptions
│       │   │   └── HttpClientException.php
│       │   └── HttpClientDataSource.php
│       └── Infrastructure
│           ├── Exceptions
│           │   └── GuzzleHttpClientException.php
│           └── GuzzleHttpClientRepository.php
├── Controller
│   ├── Finder
│   │   ├── FindBeerByFoodController.php
│   │   └── FindBeerByFoodWithDetailController.php
│   └── HealthCheck.php
└── Kernel.php

```

### ✅  Estructura de los test

```
.
├── EndToEnd
│   └── ApiBaseContext.php
├── Functional
│   └── Controller
│       └── Finder
│           ├── FindBeerByFoodControllerFunctionalTest.php
│           └── FindBeerByFoodWithDetailControllerFunctionalTest.php
├── Shared
│   ├── DataMock
│   │   ├── ApiPunkResponse.php
│   │   └── HttpClientResponse.php
│   └── ObjectMother
│       └── MotherCreator.php
├── Unitary
│   ├── BeerCatalog
│   │   ├── Beer
│   │   │   ├── Application
│   │   │   │   └── Find
│   │   │   │       └── FindBeerByFoodQueryHandlerTest.php
│   │   │   ├── Domain
│   │   │   │   ├── BeerDetailsMother.php
│   │   │   │   ├── BeerMother.php
│   │   │   │   └── CatalogBeerMother.php
│   │   │   └── Infrastructure
│   │   │       └── ApiPunkFinderBeerRepositoryTest.php
│   │   └── Shared
│   │       └── Infrastructure
│   │           └── GuzzleHttpClientRepositoryTest.php
│   └── Controller
│       └── Finder
│           ├── FindBeerByFoodControllerTest.php
│           └── FindBeerByFoodWithDetailControllerTest.php
└── bootstrap.php

```