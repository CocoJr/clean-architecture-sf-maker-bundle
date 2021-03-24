*Work in progress*

### Installation

`composer require cocojr/clean-architecture-sf-maker-bundle`  
  
If you don't use Symfony flex, register the bundle for all the environments.

### Configuration

 - You need to create one folder in your root directory: `business`.
 - Update your `composer.json` to configure the `autoload` section:
```
"autoload": {
    "psr-4": {
        "App\\": "src/",
        "Business\\": "business/"
    }
}
```
 - Register the Business service:
```
Business\:
    resource: '../Business/*'
```
 - Register the messengers (Only the event use an async transport. You can change this as you wants, but keep the `buses` section intact.):
```
framework:
    messenger:
        default_bus: command.bus
        buses:
            usecase.bus:
                default_middleware: true
            command.bus:
                default_middleware: true
            query.bus:
                default_middleware: true
            event.bus:
                default_middleware: true
        transports:
            async:
                dsn: '%env(resolve:MESSENGER_ASYNC_DSN)%'
                retry_strategy:
                    max_retries: 3
                    delay: 1000
                    multiplier: 2
                    max_delay: 0
            sync: 'sync://'

        routing:
            'CocoJr\CleanArchitecture\Business\Message\AbstractUseCaseMessage': sync
            'CocoJr\CleanArchitecture\Business\Message\AbstractCommandMessage': sync
            'CocoJr\CleanArchitecture\Business\Message\AbstractQueryMessage': sync
            'CocoJr\CleanArchitecture\Business\Message\AbstractEventMessage': async
```

### Usage

 -  `./bin/console make:business:template` and answer the question.
 - Inject the `UseCaseDispatcher` in your controller and dispatch a message: 
```
$dispatcher->dispatch(
    YourMessage::createMessage()
)
```
OR
```
$response = $dispatcher->dispatchAndGetResult(
    YourMessage::createMessage()
)
```

### Roadmap

 - Generate entity, repository, service.
