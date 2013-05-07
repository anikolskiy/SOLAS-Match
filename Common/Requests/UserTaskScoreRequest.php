<?php
// DO NOT EDIT! Generated by Protobuf-PHP protoc plugin 0.9.4
// Source: UserTaskScoreRequest.proto
//   Date: 2013-05-07 16:22:27

namespace  {

  class UserTaskScoreRequest extends \DrSlump\Protobuf\Message {

    /**  @var string */
    public $name = "UserTaskScoreRequest";
    
    /**  @var int */
    public $task_id = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, '.UserTaskScoreRequest');

      // REQUIRED STRING name = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "name";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_REQUIRED;
      $f->default   = "UserTaskScoreRequest";
      $descriptor->addField($f);

      // OPTIONAL INT32 task_id = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "task_id";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <name> has a value
     *
     * @return boolean
     */
    public function hasName(){
      return $this->_has(1);
    }
    
    /**
     * Clear <name> value
     *
     * @return \UserTaskScoreRequest
     */
    public function clearName(){
      return $this->_clear(1);
    }
    
    /**
     * Get <name> value
     *
     * @return string
     */
    public function getName(){
      return $this->_get(1);
    }
    
    /**
     * Set <name> value
     *
     * @param string $value
     * @return \UserTaskScoreRequest
     */
    public function setName( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <task_id> has a value
     *
     * @return boolean
     */
    public function hasTaskId(){
      return $this->_has(2);
    }
    
    /**
     * Clear <task_id> value
     *
     * @return \UserTaskScoreRequest
     */
    public function clearTaskId(){
      return $this->_clear(2);
    }
    
    /**
     * Get <task_id> value
     *
     * @return int
     */
    public function getTaskId(){
      return $this->_get(2);
    }
    
    /**
     * Set <task_id> value
     *
     * @param int $value
     * @return \UserTaskScoreRequest
     */
    public function setTaskId( $value){
      return $this->_set(2, $value);
    }
  }
}

