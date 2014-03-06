<?php
// DO NOT EDIT! Generated by Protobuf-PHP protoc plugin 0.9.4
// Source: TaskArchived.proto
//   Date: 2014-03-05 19:32:36

namespace SolasMatch\Common\Protobufs\Emails {

  class TaskArchived extends \DrSlump\Protobuf\Message {

    /**  @var int - \SolasMatch\Common\Protobufs\Emails\EmailMessage\Type */
    public $email_type = \SolasMatch\Common\Protobufs\Emails\EmailMessage\Type::TaskArchived;
    
    /**  @var int */
    public $user_id = null;
    
    /**  @var int */
    public $task_id = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'SolasMatch.Common.Protobufs.Emails.TaskArchived');

      // REQUIRED ENUM email_type = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "email_type";
      $f->type      = \DrSlump\Protobuf::TYPE_ENUM;
      $f->rule      = \DrSlump\Protobuf::RULE_REQUIRED;
      $f->reference = '\SolasMatch\Common\Protobufs\Emails\EmailMessage\Type';
      $f->default   = \SolasMatch\Common\Protobufs\Emails\EmailMessage\Type::TaskArchived;
      $descriptor->addField($f);

      // REQUIRED INT32 user_id = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "user_id";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_REQUIRED;
      $descriptor->addField($f);

      // REQUIRED INT32 task_id = 3
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 3;
      $f->name      = "task_id";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_REQUIRED;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <email_type> has a value
     *
     * @return boolean
     */
    public function hasEmailType(){
      return $this->_has(1);
    }
    
    /**
     * Clear <email_type> value
     *
     * @return \SolasMatch\Common\Protobufs\Emails\TaskArchived
     */
    public function clearEmailType(){
      return $this->_clear(1);
    }
    
    /**
     * Get <email_type> value
     *
     * @return int - \SolasMatch\Common\Protobufs\Emails\EmailMessage\Type
     */
    public function getEmailType(){
      return $this->_get(1);
    }
    
    /**
     * Set <email_type> value
     *
     * @param int - \SolasMatch\Common\Protobufs\Emails\EmailMessage\Type $value
     * @return \SolasMatch\Common\Protobufs\Emails\TaskArchived
     */
    public function setEmailType( $value){
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
     * @return \SolasMatch\Common\Protobufs\Emails\TaskArchived
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
     * @return \SolasMatch\Common\Protobufs\Emails\TaskArchived
     */
    public function setUserId( $value){
      return $this->_set(2, $value);
    }
    
    /**
     * Check if <task_id> has a value
     *
     * @return boolean
     */
    public function hasTaskId(){
      return $this->_has(3);
    }
    
    /**
     * Clear <task_id> value
     *
     * @return \SolasMatch\Common\Protobufs\Emails\TaskArchived
     */
    public function clearTaskId(){
      return $this->_clear(3);
    }
    
    /**
     * Get <task_id> value
     *
     * @return int
     */
    public function getTaskId(){
      return $this->_get(3);
    }
    
    /**
     * Set <task_id> value
     *
     * @param int $value
     * @return \SolasMatch\Common\Protobufs\Emails\TaskArchived
     */
    public function setTaskId( $value){
      return $this->_set(3, $value);
    }
  }
}

