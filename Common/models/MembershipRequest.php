<?php
// DO NOT EDIT! Generated by Protobuf-PHP protoc plugin 0.9.4
// Source: MembershipRequest.proto
//   Date: 2012-11-28 13:39:33

namespace  {

  class MembershipRequest extends \DrSlump\Protobuf\Message {

    /**  @var int */
    public $id = null;
    
    /**  @var int */
    public $user_id = null;
    
    /**  @var int */
    public $org_id = null;
    
    /**  @var string */
    public $request_time = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, '.MembershipRequest');

      // REQUIRED INT32 id = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "id";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_REQUIRED;
      $descriptor->addField($f);

      // REQUIRED INT32 user_id = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "user_id";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_REQUIRED;
      $descriptor->addField($f);

      // REQUIRED INT32 org_id = 3
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 3;
      $f->name      = "org_id";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_REQUIRED;
      $descriptor->addField($f);

      // OPTIONAL STRING request_time = 4
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 4;
      $f->name      = "request_time";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <id> has a value
     *
     * @return boolean
     */
    public function hasId(){
      return $this->_has(1);
    }
    
    /**
     * Clear <id> value
     *
     * @return \MembershipRequest
     */
    public function clearId(){
      return $this->_clear(1);
    }
    
    /**
     * Get <id> value
     *
     * @return int
     */
    public function getId(){
      return $this->_get(1);
    }
    
    /**
     * Set <id> value
     *
     * @param int $value
     * @return \MembershipRequest
     */
    public function setId( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <user_id> has a value
     *
     * @return boolean
     */
    public function hasUserId(){
      return $this->_has(2);
    }
    
    /**
     * Clear <user_id> value
     *
     * @return \MembershipRequest
     */
    public function clearUserId(){
      return $this->_clear(2);
    }
    
    /**
     * Get <user_id> value
     *
     * @return int
     */
    public function getUserId(){
      return $this->_get(2);
    }
    
    /**
     * Set <user_id> value
     *
     * @param int $value
     * @return \MembershipRequest
     */
    public function setUserId( $value){
      return $this->_set(2, $value);
    }
    
    /**
     * Check if <org_id> has a value
     *
     * @return boolean
     */
    public function hasOrgId(){
      return $this->_has(3);
    }
    
    /**
     * Clear <org_id> value
     *
     * @return \MembershipRequest
     */
    public function clearOrgId(){
      return $this->_clear(3);
    }
    
    /**
     * Get <org_id> value
     *
     * @return int
     */
    public function getOrgId(){
      return $this->_get(3);
    }
    
    /**
     * Set <org_id> value
     *
     * @param int $value
     * @return \MembershipRequest
     */
    public function setOrgId( $value){
      return $this->_set(3, $value);
    }
    
    /**
     * Check if <request_time> has a value
     *
     * @return boolean
     */
    public function hasRequestTime(){
      return $this->_has(4);
    }
    
    /**
     * Clear <request_time> value
     *
     * @return \MembershipRequest
     */
    public function clearRequestTime(){
      return $this->_clear(4);
    }
    
    /**
     * Get <request_time> value
     *
     * @return string
     */
    public function getRequestTime(){
      return $this->_get(4);
    }
    
    /**
     * Set <request_time> value
     *
     * @param string $value
     * @return \MembershipRequest
     */
    public function setRequestTime( $value){
      return $this->_set(4, $value);
    }
  }
}

