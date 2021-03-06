<?php
namespace SolasMatch\Common\Protobufs\Models;

// @@protoc_insertion_point(namespace:.SolasMatch.Common.Protobufs.Models.WorkflowGraph)

/**
 * Generated by the protocol buffer compiler.  DO NOT EDIT!
 * source: WorkflowGraph.proto
 *
 * -*- magic methods -*-
 *
 * @method array getRootNode()
 * @method void appendRootNode(\string $value)
 * @method string getProjectId()
 * @method void setProjectId(\string $value)
 * @method array getAllNodes()
 * @method void appendAllNodes(\SolasMatch\Common\Protobufs\Models\WorkflowNode $value)
 */
class WorkflowGraph extends \ProtocolBuffers\Message
{
  // @@protoc_insertion_point(traits:.SolasMatch.Common.Protobufs.Models.WorkflowGraph)
  
  /**
   * @var array $rootNode
   * @tag 1
   * @label optional
   * @type \ProtocolBuffers::TYPE_INT32
   **/
  protected $rootNode;
  
  /**
   * @var string $projectId
   * @tag 2
   * @label optional
   * @type \ProtocolBuffers::TYPE_INT32
   **/
  protected $projectId;
  
  /**
   * @var array $allNodes
   * @tag 3
   * @label optional
   * @type \ProtocolBuffers::TYPE_MESSAGE
   * @see \SolasMatch\Common\Protobufs\Models\WorkflowNode
   **/
  protected $allNodes;
  
  
  // @@protoc_insertion_point(properties_scope:.SolasMatch.Common.Protobufs.Models.WorkflowGraph)

  // @@protoc_insertion_point(class_scope:.SolasMatch.Common.Protobufs.Models.WorkflowGraph)

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
        "name"     => "rootNode",
        "required" => false,
        "optional" => false,
        "repeated" => true,
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
        "type"     => \ProtocolBuffers::TYPE_MESSAGE,
        "name"     => "allNodes",
        "required" => false,
        "optional" => false,
        "repeated" => true,
        "packable" => false,
        "default"  => null,
        "message" => '\SolasMatch\Common\Protobufs\Models\WorkflowNode',
      )));
      // @@protoc_insertion_point(builder_scope:.SolasMatch.Common.Protobufs.Models.WorkflowGraph)

      $descriptor = $desc->build();
    }
    return $descriptor;
  }
  
  public function clearRootNode()
  {
      $this->rootNode = array();
  }
  
  public function setAllNodes(\SolasMatch\Common\Protobufs\Models\WorkflowNode $node, $index)
  {
      $this->allNodes[$index] = $node;
  }
  
  public function hasRootNode()
  {
      return count($this->rootNode) > 0;
  }

}
