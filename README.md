php-mongo-yii
=============

Yii PHPMongo Adapter

Installation
------------

You can install library through Composer:
```javascript
{
    "require": {
        "sokil/php-mongo-yii": "dev-master"
    }
}
```

Configuration
-------------

```php
<?php

return array(
    'components' => array(
        // configure mongo service
        'mongo' => array(
            'class' => '\Sokil\Mongo\Yii\ClientAdapter',
            'dsn' => 'mongodb://127.0.0.1',
            'options' => array(
                'connect' => true,
                'readPreference' => \MongoClient::RP_SECONDARY_PREFERRED,
            ),
            'defaultDatabase' => 'database_name',
            'map' => array(
                'database_name' => array(
                    'tableName1' => '\Collection\Class1',
                    'tableName2' => '\Collection\Class2',
                )
            ),
            'logger' => 'somePsrCompartibleLogService',
        ),
    ),
    
    // define log
    'somePsrCompartibleLogService' => array(
        'class' => '\SomePSRLogger',
    ),
);
```

For PSR compartible logger you can use adapter to Yii's log https://gist.github.com/sokil/56654a5abdfbcce411ea or [Monolog](https://github.com/Seldaek/monolog)

Routing Yii logs to mongo
-------------------------

```php
<?php

return array(
    'components' => array(
        // configure log service
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => '\Sokil\Mongo\Yii\LogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),
);
        
```
