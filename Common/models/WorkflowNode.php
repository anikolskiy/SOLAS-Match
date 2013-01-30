<?php
// DO NOT EDIT! Generated by Protobuf-PHP protoc plugin 0.9.4
// Source: WorkflowNode.proto
//   Date: 2013-01-29 17:09:16

namespace  {

  class WorkflowNode extends \DrSlump\Protobuf\Message {

    /**  @var int */
    public $taskId = null;
    
    /**  @var \Task */
    public $task = null;
    
    /**  @var \WorkflowNode[]  */
    public $next = array();
    
    /**  @var \WorkflowNode[]  */
    public $previous = array();
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, '.WorkflowNode');

      // REQUIRED INT32 taskId = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "taskId";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_REQUIRED;
      $descriptor->addField($f);

      // OPTIONAL MESSAGE task = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "task";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\Task';
      $descriptor->addField($f);

      // REPEATED MESSAGE next = 3
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 3;
      $f->name      = "next";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_REPEATED;
      $f->reference = '\WorkflowNode';
      $descriptor->addField($f);

      // REPEATED MESSAGE previous = 4
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 4;
      $f->name      = "previous";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_REPEATED;
      $f->reference = '\WorkflowNode';
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <taskId> has a value
     *
     * @return boolean
     */
    public function hasTaskId(){
      return $this->_has(1);
    }
    
    /**
     * Clear <taskId> value
     *
     * @return \WorkflowNode
     */
    public function clearTaskId(){
      return $this->_clear(1);
    }
    
    /**
     * Get <taskId> value
     *
     * @return int
     */
    public function getTaskId(){
      return $this->_get(1);
    }
    
    /**
     * Set <taskId> value
     *
     * @param int $value
     * @return \WorkflowNode
     */
    public function setTaskId( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <task> has a value
     *
     * @return boolean
     */
    public function hasTask(){
      return $this->_has(2);
    }
    
    /**
     * Clear <task> value
     *
     * @return \WorkflowNode
     */
    public function clearTask(){
      return $this->_clear(2);
    }
    
    /**
     * Get <task> value
     *
     * @return \Task
     */
    public function getTask(){
      return $this->_get(2);
    }
    
    /**
     * Set <task> value
     *
     * @param \Task $value
     * @return \WorkflowNode
     */
    public function setTask(\Task $value){
      return $this->_set(2, $value);
    }
    
    /**
     * Check if <next> has a value
     *
     * @return boolean
     */
    public function hasNext(){
      return $this->_has(3);
    }
    
    /**
     * Clear <next> value
     *
     * @return \WorkflowNode
     */
    public function clearNext(){
      return $this->_clear(3);
    }
    
    /**
     * Get <next> value
     *
     * @param int $idx
     * @return \WorkflowNode
     */
    public function getNext($idx = NULL){
      return $this->_get(3, $idx);
    }
    
    /**
     * Set <next> value
     *
     * @param \WorkflowNode $value
     * @return \WorkflowNode
     */
    public function setNext(\WorkflowNode $value, $idx = NULL){
      return $this->_set(3, $value, $idx);
    }
    
    /**
     * Get all elements of <next>
     *
     * @return \WorkflowNode[]
     */
    public function getNextList(){
     return $this->_get(3);
    }
    
    /**
     * Add a new element to <next>
     *
     * @param \WorkflowNode $value
     * @return \WorkflowNode
     */
    public function addNext(\WorkflowNode $value){
     return $this->_add(3, $value);
    }
    
    /**
     * Check if <previous> has a value
     *
     * @return boolean
     */
    public function hasPrevious(){
      return $this->_has(4);
    }
    
    /**
     * Clear <previous> value
     *
     * @return \WorkflowNode
     */
    public function clearPrevious(){
      return $this->_clear(4);
    }
    
    /**
     * Get <previous> value
     *
     * @param int $idx
     * @return \WorkflowNode
     */
    public function getPrevious($idx = NULL){
      return $this->_get(4, $idx);
    }
    
    /**
     * Set <previous> value
     *
     * @param \WorkflowNode $value
     * @return \WorkflowNode
     */
    public function setPrevious(\WorkflowNode $value, $idx = NULL){
      return $this->_set(4, $value, $idx);
    }
    
    /**
     * Get all elements of <previous>
     *
     * @return \WorkflowNode[]
     */
    public function getPreviousList(){
     return $this->_get(4);
    }
    
    /**
     * Add a new element to <previous>
     *
     * @param \WorkflowNode $value
     * @return \WorkflowNode
     */
    public function addPrevious(\WorkflowNode $value){
     return $this->_add(4, $value);
    }
  }
}

