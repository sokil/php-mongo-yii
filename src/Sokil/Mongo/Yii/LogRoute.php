<?php

namespace Sokil\Mongo\Yii;

class LogRoute extends \CLogRoute 
{
    public $collectionName = 'log';
    
    public $serviceName = 'mongo';
    
    /**
     * Convert time in different formats to mongo date
     * @param mixed $time
     * @return \MongoDate
     */
    protected function _timeToMongoDate($time)
    {
        if(!is_numeric($time)) {
            $time = strtotime($time);
            if(!$time) {
                $time = time();
            }
        }
        
        return new \MongoDate($time);
    }
    
    /**
     * Write log messages
     * @param array $logs list of messages
     */
    protected function processLogs($logs) 
    {
        $logCollection = \Yii::app()
            ->{$this->serviceName}
            ->getCollection($this->collectionName);
        
        foreach ($logs as $log) {
            
            // time
            $logCollection
                ->createDocument(array(
                    'level'         => $log[1],
                    'category'      => $log[2],
                    'logtime'       => $this->_timeToMongoDate($log[3]),
                    'message'       => $log[0],
                    'requestUri'    => isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : null,
                    'userAgent'     => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null,
                ))
                ->save();
        }
    }

}
