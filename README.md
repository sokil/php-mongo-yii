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

Configuration of Client
-----------------------

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
                    'collectionName1' => '\Collection\Class1',
                    'collectionName2' => '\Collection\Class2',
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

Using mongo in code:

```php
<?php
// get client
$client = \Yii::app()->mongo->getClient();
// get database
$database = \Yii::app()->mongo->getDatabase('database_name');
// get collection of default database
$collection = \Yii::app()->mongo->getCollection('collectionName1');
```

Routing Yii logs to mongo
-------------------------

Configure logger to use mongo:

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

Data Provider
-------------

```php
<?php

// get cursor
$cursor = Yii::app()->mongo->getCollection('collName')->find()->where('type', 10);

// get data provider
$dataProvider = new \Sokil\Mongo\Yii\DataProvider($cursor, array(
    'attributes' => array('name', 'type'),
    'pagination' => array('pageSize' => 30)
));
```
