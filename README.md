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
