<?php
// DO NOT EDIT! Generated by Protobuf-PHP protoc plugin 0.9.4
// Source: PasswordResetRequest.proto
//   Date: 2013-04-16 15:58:01

namespace  {

  class PasswordResetRequest extends \DrSlump\Protobuf\Message {

    /**  @var int */
    public $user_id = null;
    
    /**  @var string */
    public $key = null;
    
    /**  @var string */
    public $requestTime = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, '.PasswordResetRequest');

      // OPTIONAL INT32 user_id = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "user_id";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // REQUIRED STRING key = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "key";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_REQUIRED;
      $descriptor->addField($f);

      // OPTIONAL STRING requestTime = 3
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 3;
      $f->name      = "requestTime";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <user_id> has a value
     *
     * @return boolean
     */
    public function hasUserId(){
      return $this->_has(1);
    }
    
    /**
     * Clear <user_id> value
     *
     * @return \PasswordResetRequest
     */
    public function clearUserId(){
      return $this->_clear(1);
    }
    
    /**
     * Get <user_id> value
     *
     * @return int
     */
    public function getUserId(){
      return $this->_get(1);
    }
    
    /**
     * Set <user_id> value
     *
     * @param int $value
     * @return \PasswordResetRequest
     */
    public function setUserId( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <key> has a value
     *
     * @return boolean
     */
    public function hasKey(){
      return $this->_has(2);
    }
    
    /**
     * Clear <key> value
     *
     * @return \PasswordResetRequest
     */
    public function clearKey(){
      return $this->_clear(2);
    }
    
    /**
     * Get <key> value
     *
     * @return string
     */
    public function getKey(){
      return $this->_get(2);
    }
    
    /**
     * Set <key> value
     *
     * @param string $value
     * @return \PasswordResetRequest
     */
    public function setKey( $value){
      return $this->_set(2, $value);
    }
    
    /**
     * Check if <requestTime> has a value
     *
     * @return boolean
     */
    public function hasRequestTime(){
      return $this->_has(3);
    }
    
    /**
     * Clear <requestTime> value
     *
     * @return \PasswordResetRequest
     */
    public function clearRequestTime(){
      return $this->_clear(3);
    }
    
    /**
     * Get <requestTime> value
     *
     * @return string
     */
    public function getRequestTime(){
      return $this->_get(3);
    }
    
    /**
     * Set <requestTime> value
     *
     * @param string $value
     * @return \PasswordResetRequest
     */
    public function setRequestTime( $value){
      return $this->_set(3, $value);
    }
  }
}

