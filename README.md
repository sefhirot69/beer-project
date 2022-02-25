
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

Escribe por terminal el comando `make`. Este comando instalara todo lo necesario para arrancar la aplicación.

Si no tenéis el comando `make`, ejecuta `docker-compose up -d` y luego instala las dependencias dentro del contenedor generado `composer install`.

Podéis probar la aplicación en [beer_project](http://localhost:8081)

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
├── Beer
│   ├── Application
│   │   └── Find
│   │       ├── FindBeerByFoodQueryHandler.php
│   │       └── Query
│   │           └── FindBeerByFoodQuery.php
│   ├── Domain
│   │   ├── Beer.php
│   │   ├── BeerDetails.php
│   │   ├── CatalogBeer.php
│   │   ├── DataSource
│   │   │   └── FinderBeerDataSource.php
│   │   └── Dto
│   │       ├── BeerDetailsDto.php
│   │       ├── BeerDto.php
│   │       └── CatalogBeerDto.php
│   └── Infrastructure
│       └── ApiPunkFinderBeerRepository.php
└── Shared
    ├── Domain
    │   ├── Exceptions
    │   │   └── HttpClientException.php
    │   └── HttpClientDataSource.php
    └── Infrastructure
        ├── Exceptions
        │   └── GuzzleHttpClientException.php
        └── GuzzleHttpClientRepository.php
```

### ✅  Estructura de los test

```
├── BeerCatalog
│   ├── Beer
│   │   ├── Application
│   │   │   └── Find
│   │   │       └── FindBeerByFoodQueryHandlerTest.php
│   │   ├── Domain
│   │   │   ├── BeerDetailsMother.php
│   │   │   ├── BeerMother.php
│   │   │   └── CatalogBeerMother.php
│   │   └── Infrastructure
│   │       └── ApiPunkFinderBeerRepositoryTest.php
│   └── Shared
│       └── Infrastructure
│           └── GuzzleHttpClientRepositoryTest.php
├── DataMock
│   ├── ApiPunkResponse.php
│   └── HttpClientResponse.php
├── Shared
│   └── ObjectMother
│       └── MotherCreator.php
└── bootstrap.php

```