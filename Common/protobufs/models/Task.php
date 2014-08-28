<?php
namespace SolasMatch\Common\Protobufs\Models;

// @@protoc_insertion_point(namespace:.SolasMatch.Common.Protobufs.Models.Task)

/**
 * Generated by the protocol buffer compiler.  DO NOT EDIT!
 * source: Task.proto
 *
 * -*- magic methods -*-
 *
 * @method string getId()
 * @method void setId(\string $value)
 * @method string getProjectId()
 * @method void setProjectId(\string $value)
 * @method string getTitle()
 * @method void setTitle(\string $value)
 * @method string getComment()
 * @method void setComment(\string $value)
 * @method string getDeadline()
 * @method void setDeadline(\string $value)
 * @method string getWordCount()
 * @method void setWordCount(\string $value)
 * @method string getCreatedTime()
 * @method void setCreatedTime(\string $value)
 * @method \SolasMatch\Common\Protobufs\Models\Locale getSourceLocale()
 * @method void setSourceLocale(\SolasMatch\Common\Protobufs\Models\Locale $value)
 * @method \SolasMatch\Common\Protobufs\Models\Locale getTargetLocale()
 * @method void setTargetLocale(\SolasMatch\Common\Protobufs\Models\Locale $value)
 * @method string getTaskType()
 * @method void setTaskType(\string $value)
 * @method string getTaskStatus()
 * @method void setTaskStatus(\string $value)
 * @method bool getPublished()
 * @method void setPublished(bool $value)
 */
class Task extends \ProtocolBuffers\Message
{
  // @@protoc_insertion_point(traits:.SolasMatch.Common.Protobufs.Models.Task)
  
  /**
   * @var string $id
   * @tag 1
   * @label optional
   * @type \ProtocolBuffers::TYPE_INT32
   **/
  protected $id;
  
  /**
   * @var string $projectId
   * @tag 2
   * @label optional
   * @type \ProtocolBuffers::TYPE_INT32
   **/
  protected $projectId;
  
  /**
   * @var string $title
   * @tag 3
   * @label optional
   * @type \ProtocolBuffers::TYPE_STRING
   **/
  protected $title;
  
  /**
   * @var string $comment
   * @tag 4
   * @label optional
   * @type \ProtocolBuffers::TYPE_STRING
   **/
  protected $comment;
  
  /**
   * @var string $deadline
   * @tag 5
   * @label optional
   * @type \ProtocolBuffers::TYPE_STRING
   **/
  protected $deadline;
  
  /**
   * @var string $wordCount
   * @tag 6
   * @label optional
   * @type \ProtocolBuffers::TYPE_INT32
   **/
  protected $wordCount;
  
  /**
   * @var string $createdTime
   * @tag 7
   * @label optional
   * @type \ProtocolBuffers::TYPE_STRING
   **/
  protected $createdTime;
  
  /**
   * @var \SolasMatch\Common\Protobufs\Models\Locale $sourceLocale
   * @tag 8
   * @label optional
   * @type \ProtocolBuffers::TYPE_MESSAGE
   **/
  protected $sourceLocale;
  
  /**
   * @var \SolasMatch\Common\Protobufs\Models\Locale $targetLocale
   * @tag 9
   * @label optional
   * @type \ProtocolBuffers::TYPE_MESSAGE
   **/
  protected $targetLocale;
  
  /**
   * @var string $taskType
   * @tag 10
   * @label optional
   * @type \ProtocolBuffers::TYPE_INT32
   **/
  protected $taskType;
  
  /**
   * @var string $taskStatus
   * @tag 11
   * @label optional
   * @type \ProtocolBuffers::TYPE_INT32
   **/
  protected $taskStatus;
  
  /**
   * @var bool $published
   * @tag 12
   * @label optional
   * @type \ProtocolBuffers::TYPE_BOOL
   **/
  protected $published;
  
  
  // @@protoc_insertion_point(properties_scope:.SolasMatch.Common.Protobufs.Models.Task)

  // @@protoc_insertion_point(class_scope:.SolasMatch.Common.Protobufs.Models.Task)

  /**
   * get descriptor for protocol buffers
   * 
   * @return \ProtocolBuffersDescriptor
   */
  public static function getDescriptor()
  {
    static $descriptor;
    
    if (!isset($descriptor)) {
      $desc = new \ProtocolBuffers\DescriptorBuilder();
      $desc->addField(1, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_INT32,
        "name"     => "id",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => null,
      )));
      $desc->addField(2, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_INT32,
        "name"     => "projectId",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => null,
      )));
      $desc->addField(3, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_STRING,
        "name"     => "title",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => "",
      )));
      $desc->addField(4, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_STRING,
        "name"     => "comment",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => "",
      )));
      $desc->addField(5, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_STRING,
        "name"     => "deadline",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => "",
      )));
      $desc->addField(6, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_INT32,
        "name"     => "wordCount",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => null,
      )));
      $desc->addField(7, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_STRING,
        "name"     => "createdTime",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => "",
      )));
      $desc->addField(8, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_MESSAGE,
        "name"     => "sourceLocale",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => null,
        "message" => '\SolasMatch\Common\Protobufs\Models\Locale',
      )));
      $desc->addField(9, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_MESSAGE,
        "name"     => "targetLocale",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => null,
        "message" => '\SolasMatch\Common\Protobufs\Models\Locale',
      )));
      $desc->addField(10, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_INT32,
        "name"     => "taskType",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => null,
      )));
      $desc->addField(11, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_INT32,
        "name"     => "taskStatus",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => null,
      )));
      $desc->addField(12, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_BOOL,
        "name"     => "published",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => false,
      )));
      // @@protoc_insertion_point(builder_scope:.SolasMatch.Common.Protobufs.Models.Task)

      $descriptor = $desc->build();
    }
    return $descriptor;
  }
  
  public function hasTargetLocale()
  {
      return $this->targetLocale != null;
  }

}
