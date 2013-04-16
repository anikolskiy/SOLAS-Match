<?php
// DO NOT EDIT! Generated by Protobuf-PHP protoc plugin 0.9.4
// Source: Register.proto
//   Date: 2013-04-16 15:58:01

namespace  {

  class Register extends \DrSlump\Protobuf\Message {

    /**  @var string */
    public $email = null;
    
    /**  @var string */
    public $password = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, '.Register');

      // REQUIRED STRING email = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "email";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_REQUIRED;
      $descriptor->addField($f);

      // REQUIRED STRING password = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "password";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_REQUIRED;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <email> has a value
     *
     * @return boolean
     */
    public function hasEmail(){
      return $this->_has(1);
    }
    
    /**
     * Clear <email> value
     *
     * @return \Register
     */
    public function clearEmail(){
      return $this->_clear(1);
    }
    
    /**
     * Get <email> value
     *
     * @return string
     */
    public function getEmail(){
      return $this->_get(1);
    }
    
    /**
     * Set <email> value
     *
     * @param string $value
     * @return \Register
     */
    public function setEmail( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <password> has a value
     *
     * @return boolean
     */
    public function hasPassword(){
      return $this->_has(2);
    }
    
    /**
     * Clear <password> value
     *
     * @return \Register
     */
    public function clearPassword(){
      return $this->_clear(2);
    }
    
    /**
     * Get <password> value
     *
     * @return string
     */
    public function getPassword(){
      return $this->_get(2);
    }
    
    /**
     * Set <password> value
     *
     * @param string $value
     * @return \Register
     */
    public function setPassword( $value){
      return $this->_set(2, $value);
    }
  }
}

