<?php
namespace SolasMatch\Common\Protobufs\Models;

// @@protoc_insertion_point(namespace:.SolasMatch.Common.Protobufs.Models.ArchivedProject)

/**
 * Generated by the protocol buffer compiler.  DO NOT EDIT!
 * source: ArchivedProject.proto
 *
 * -*- magic methods -*-
 *
 * @method string getId()
 * @method void setId(\string $value)
 * @method string getTitle()
 * @method void setTitle(\string $value)
 * @method string getDescription()
 * @method void setDescription(\string $value)
 * @method string getImpact()
 * @method void setImpact(\string $value)
 * @method string getDeadline()
 * @method void setDeadline(\string $value)
 * @method string getOrganisationId()
 * @method void setOrganisationId(\string $value)
 * @method string getReference()
 * @method void setReference(\string $value)
 * @method string getWordCount()
 * @method void setWordCount(\string $value)
 * @method string getCreatedTime()
 * @method void setCreatedTime(\string $value)
 * @method \SolasMatch\Common\Protobufs\Models\Locale getSourceLocale()
 * @method void setSourceLocale(\SolasMatch\Common\Protobufs\Models\Locale $value)
 * @method string getUserIdArchived()
 * @method void setUserIdArchived(\string $value)
 * @method string getUserIdProjectCreator()
 * @method void setUserIdProjectCreator(\string $value)
 * @method string getFileName()
 * @method void setFileName(\string $value)
 * @method string getFileToken()
 * @method void setFileToken(\string $value)
 * @method string getMimeType()
 * @method void setMimeType(\string $value)
 * @method string getArchivedDate()
 * @method void setArchivedDate(\string $value)
 * @method string getTags()
 * @method void setTags(\string $value)
 * @method bool getImageUploaded()
 * @method void setImageUploaded(bool $value)
 * @method bool getImageApproved()
 * @method void setImageApproved(bool $value)
 */
class ArchivedProject extends \ProtocolBuffers\Message
{
  // @@protoc_insertion_point(traits:.SolasMatch.Common.Protobufs.Models.ArchivedProject)
  
  /**
   * @var string $id
   * @tag 1
   * @label optional
   * @type \ProtocolBuffers::TYPE_INT32
   **/
  protected $id;
  
  /**
   * @var string $title
   * @tag 2
   * @label optional
   * @type \ProtocolBuffers::TYPE_STRING
   **/
  protected $title;
  
  /**
   * @var string $description
   * @tag 3
   * @label optional
   * @type \ProtocolBuffers::TYPE_STRING
   **/
  protected $description;
  
  /**
   * @var string $impact
   * @tag 4
   * @label optional
   * @type \ProtocolBuffers::TYPE_STRING
   **/
  protected $impact;
  
  /**
   * @var string $deadline
   * @tag 5
   * @label optional
   * @type \ProtocolBuffers::TYPE_STRING
   **/
  protected $deadline;
  
  /**
   * @var string $organisationId
   * @tag 6
   * @label optional
   * @type \ProtocolBuffers::TYPE_INT32
   **/
  protected $organisationId;
  
  /**
   * @var string $reference
   * @tag 7
   * @label optional
   * @type \ProtocolBuffers::TYPE_STRING
   **/
  protected $reference;
  
  /**
   * @var string $wordCount
   * @tag 8
   * @label optional
   * @type \ProtocolBuffers::TYPE_INT32
   **/
  protected $wordCount;
  
  /**
   * @var string $createdTime
   * @tag 9
   * @label optional
   * @type \ProtocolBuffers::TYPE_STRING
   **/
  protected $createdTime;
  
  /**
   * @var \SolasMatch\Common\Protobufs\Models\Locale $sourceLocale
   * @tag 10
   * @label optional
   * @type \ProtocolBuffers::TYPE_MESSAGE
   **/
  protected $sourceLocale;
  
  /**
   * @var string $userIdArchived
   * @tag 11
   * @label optional
   * @type \ProtocolBuffers::TYPE_INT32
   **/
  protected $userIdArchived;
  
  /**
   * @var string $userIdProjectCreator
   * @tag 12
   * @label optional
   * @type \ProtocolBuffers::TYPE_INT32
   **/
  protected $userIdProjectCreator;
  
  /**
   * @var string $fileName
   * @tag 13
   * @label optional
   * @type \ProtocolBuffers::TYPE_STRING
   **/
  protected $fileName;
  
  /**
   * @var string $fileToken
   * @tag 14
   * @label optional
   * @type \ProtocolBuffers::TYPE_STRING
   **/
  protected $fileToken;
  
  /**
   * @var string $mimeType
   * @tag 15
   * @label optional
   * @type \ProtocolBuffers::TYPE_STRING
   **/
  protected $mimeType;
  
  /**
   * @var string $archivedDate
   * @tag 16
   * @label optional
   * @type \ProtocolBuffers::TYPE_STRING
   **/
  protected $archivedDate;
  
  /**
   * @var string $tags
   * @tag 17
   * @label optional
   * @type \ProtocolBuffers::TYPE_STRING
   **/
  protected $tags;
  
  /**
   * @var bool $imageUploaded
   * @tag 18
   * @label optional
   * @type \ProtocolBuffers::TYPE_BOOL
   **/
  protected $imageUploaded;
  
  /**
   * @var bool $imageApproved
   * @tag 19
   * @label optional
   * @type \ProtocolBuffers::TYPE_BOOL
   **/
  protected $imageApproved;
  
  
  // @@protoc_insertion_point(properties_scope:.SolasMatch.Common.Protobufs.Models.ArchivedProject)

  // @@protoc_insertion_point(class_scope:.SolasMatch.Common.Protobufs.Models.ArchivedProject)

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
        "type"     => \ProtocolBuffers::TYPE_STRING,
        "name"     => "title",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => "",
      )));
      $desc->addField(3, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_STRING,
        "name"     => "description",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => "",
      )));
      $desc->addField(4, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_STRING,
        "name"     => "impact",
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
        "name"     => "organisationId",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => null,
      )));
      $desc->addField(7, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_STRING,
        "name"     => "reference",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => "",
      )));
      $desc->addField(8, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_INT32,
        "name"     => "wordCount",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => null,
      )));
      $desc->addField(9, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_STRING,
        "name"     => "createdTime",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => "",
      )));
      $desc->addField(10, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_MESSAGE,
        "name"     => "sourceLocale",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => null,
        "message" => '\SolasMatch\Common\Protobufs\Models\Locale',
      )));
      $desc->addField(11, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_INT32,
        "name"     => "userIdArchived",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => null,
      )));
      $desc->addField(12, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_INT32,
        "name"     => "userIdProjectCreator",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => null,
      )));
      $desc->addField(13, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_STRING,
        "name"     => "fileName",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => "",
      )));
      $desc->addField(14, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_STRING,
        "name"     => "fileToken",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => "",
      )));
      $desc->addField(15, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_STRING,
        "name"     => "mimeType",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => "",
      )));
      $desc->addField(16, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_STRING,
        "name"     => "archivedDate",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => "",
      )));
      $desc->addField(17, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_STRING,
        "name"     => "tags",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => "",
      )));
      $desc->addField(18, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_BOOL,
        "name"     => "imageUploaded",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => false,
      )));
      $desc->addField(19, new \ProtocolBuffers\FieldDescriptor(array(
        "type"     => \ProtocolBuffers::TYPE_BOOL,
        "name"     => "imageApproved",
        "required" => false,
        "optional" => true,
        "repeated" => false,
        "packable" => false,
        "default"  => false,
      )));
      // @@protoc_insertion_point(builder_scope:.SolasMatch.Common.Protobufs.Models.ArchivedProject)

      $descriptor = $desc->build();
    }
    return $descriptor;
  }

}
