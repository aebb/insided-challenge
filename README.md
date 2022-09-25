### Technical Assessment

#### Tech Stack:
- Docker
- PHP 8.1

#### Install and Run:

Inside the app folder ```docker-compose up -d```

PHP Container access: ```docker exec -it task-insided /bin/bash```

##### Install dependencies

```composer update -vvv```

#### Tests:

##### To run the tests

```vendor/bin/phpunit -c phpunit.xml ./tests```

#### Quality Tools:

##### Run code beautifier

```vendor/bin/phpcbf```

##### Run code sniffer

```vendor/bin/phpcs```

##### Run mess detector

```vendor/bin/phpmd ./src text ./phpmd.xml```

composer.json also contains shortcuts for these commands

        "test-unit": "vendor/bin/phpunit -c phpunit.xml ./tests/Unit",
        "run-tests": [
            "@test-unit",
        ],
        "phpcs": "vendor/bin/phpcs",
        "phpcbf": "vendor/bin/phpcbf",
        "phpmd": "vendor/bin/phpmd ./src text ./phpmd.xml"

#### Solution:

##### PHP:
- PSR-12 Standard
- src/Controller: endpoints
- src/Entity: domain objects related to the business
- src/Repository: storage layer
- src/Request: command/action and factories for the business layer functionalities 
- src/Service: domain/business logic 
- src/Utils: common operations and functions that are not related to the business layer
- tests: application tests

##### Tests:
- PHPUnit for tests (code coverage ~100%):
- Unit: PHPUnit with mocks for the dependencies

### Remarks and future work:

- consider adding query parameters to the list endpoints, so it can be filtered, paginated and ordered (see api-contracts and Hyrum’s Law)
- consider using middlewares or argument resolvers as a mean to remove the request concept from the application (this would improve performance and reduce the amount of LoC)
- consider using cache contracts on common actions (get post/community)
- consider using tools like autowiring for dependency injection
- consider using tools like JSR303 for data validation
- consider using existing server request handlers
- consider using events to log information about certain actions
- consider segregating factory interfaces even more, if the business model requires it do so (over engineering/interface segregation balance)
- consider using a library like symfony firewall to authorize certain endpoint tasks
- consider using actual libraries and frameworks so integration tests can be performed (when everything is a mock, the app will behave exactly like you want)
