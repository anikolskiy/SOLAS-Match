<?php
// DO NOT EDIT! Generated by Protobuf-PHP protoc plugin 0.9.4
// Source: UserPersonalInformation.proto
//   Date: 2013-04-16 15:58:05

namespace  {

  class UserPersonalInformation extends \DrSlump\Protobuf\Message {

    /**  @var int */
    public $id = null;
    
    /**  @var int */
    public $userId = null;
    
    /**  @var string */
    public $firstName = null;
    
    /**  @var string */
    public $lastName = null;
    
    /**  @var int */
    public $mobileNumber = null;
    
    /**  @var int */
    public $businessNumber = null;
    
    /**  @var string */
    public $sip = null;
    
    /**  @var string */
    public $jobTitle = null;
    
    /**  @var string */
    public $address = null;
    
    /**  @var string */
    public $city = null;
    
    /**  @var string */
    public $country = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, '.UserPersonalInformation');

      // OPTIONAL INT32 id = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "id";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL INT32 userId = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "userId";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL STRING firstName = 3
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 3;
      $f->name      = "firstName";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL STRING lastName = 4
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 4;
      $f->name      = "lastName";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL INT32 mobileNumber = 5
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 5;
      $f->name      = "mobileNumber";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL INT32 businessNumber = 6
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 6;
      $f->name      = "businessNumber";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL STRING sip = 7
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 7;
      $f->name      = "sip";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL STRING jobTitle = 8
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 8;
      $f->name      = "jobTitle";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL STRING address = 9
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 9;
      $f->name      = "address";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL STRING city = 10
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 10;
      $f->name      = "city";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL STRING country = 11
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 11;
      $f->name      = "country";
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
     * @return \UserPersonalInformation
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
     * @return \UserPersonalInformation
     */
    public function setId( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <userId> has a value
     *
     * @return boolean
     */
    public function hasUserId(){
      return $this->_has(2);
    }
    
    /**
     * Clear <userId> value
     *
     * @return \UserPersonalInformation
     */
    public function clearUserId(){
      return $this->_clear(2);
    }
    
    /**
     * Get <userId> value
     *
     * @return int
     */
    public function getUserId(){
      return $this->_get(2);
    }
    
    /**
     * Set <userId> value
     *
     * @param int $value
     * @return \UserPersonalInformation
     */
    public function setUserId( $value){
      return $this->_set(2, $value);
    }
    
    /**
     * Check if <firstName> has a value
     *
     * @return boolean
     */
    public function hasFirstName(){
      return $this->_has(3);
    }
    
    /**
     * Clear <firstName> value
     *
     * @return \UserPersonalInformation
     */
    public function clearFirstName(){
      return $this->_clear(3);
    }
    
    /**
     * Get <firstName> value
     *
     * @return string
     */
    public function getFirstName(){
      return $this->_get(3);
    }
    
    /**
     * Set <firstName> value
     *
     * @param string $value
     * @return \UserPersonalInformation
     */
    public function setFirstName( $value){
      return $this->_set(3, $value);
    }
    
    /**
     * Check if <lastName> has a value
     *
     * @return boolean
     */
    public function hasLastName(){
      return $this->_has(4);
    }
    
    /**
     * Clear <lastName> value
     *
     * @return \UserPersonalInformation
     */
    public function clearLastName(){
      return $this->_clear(4);
    }
    
    /**
     * Get <lastName> value
     *
     * @return string
     */
    public function getLastName(){
      return $this->_get(4);
    }
    
    /**
     * Set <lastName> value
     *
     * @param string $value
     * @return \UserPersonalInformation
     */
    public function setLastName( $value){
      return $this->_set(4, $value);
    }
    
    /**
     * Check if <mobileNumber> has a value
     *
     * @return boolean
     */
    public function hasMobileNumber(){
      return $this->_has(5);
    }
    
    /**
     * Clear <mobileNumber> value
     *
     * @return \UserPersonalInformation
     */
    public function clearMobileNumber(){
      return $this->_clear(5);
    }
    
    /**
     * Get <mobileNumber> value
     *
     * @return int
     */
    public function getMobileNumber(){
      return $this->_get(5);
    }
    
    /**
     * Set <mobileNumber> value
     *
     * @param int $value
     * @return \UserPersonalInformation
     */
    public function setMobileNumber( $value){
      return $this->_set(5, $value);
    }
    
    /**
     * Check if <businessNumber> has a value
     *
     * @return boolean
     */
    public function hasBusinessNumber(){
      return $this->_has(6);
    }
    
    /**
     * Clear <businessNumber> value
     *
     * @return \UserPersonalInformation
     */
    public function clearBusinessNumber(){
      return $this->_clear(6);
    }
    
    /**
     * Get <businessNumber> value
     *
     * @return int
     */
    public function getBusinessNumber(){
      return $this->_get(6);
    }
    
    /**
     * Set <businessNumber> value
     *
     * @param int $value
     * @return \UserPersonalInformation
     */
    public function setBusinessNumber( $value){
      return $this->_set(6, $value);
    }
    
    /**
     * Check if <sip> has a value
     *
     * @return boolean
     */
    public function hasSip(){
      return $this->_has(7);
    }
    
    /**
     * Clear <sip> value
     *
     * @return \UserPersonalInformation
     */
    public function clearSip(){
      return $this->_clear(7);
    }
    
    /**
     * Get <sip> value
     *
     * @return string
     */
    public function getSip(){
      return $this->_get(7);
    }
    
    /**
     * Set <sip> value
     *
     * @param string $value
     * @return \UserPersonalInformation
     */
    public function setSip( $value){
      return $this->_set(7, $value);
    }
    
    /**
     * Check if <jobTitle> has a value
     *
     * @return boolean
     */
    public function hasJobTitle(){
      return $this->_has(8);
    }
    
    /**
     * Clear <jobTitle> value
     *
     * @return \UserPersonalInformation
     */
    public function clearJobTitle(){
      return $this->_clear(8);
    }
    
    /**
     * Get <jobTitle> value
     *
     * @return string
     */
    public function getJobTitle(){
      return $this->_get(8);
    }
    
    /**
     * Set <jobTitle> value
     *
     * @param string $value
     * @return \UserPersonalInformation
     */
    public function setJobTitle( $value){
      return $this->_set(8, $value);
    }
    
    /**
     * Check if <address> has a value
     *
     * @return boolean
     */
    public function hasAddress(){
      return $this->_has(9);
    }
    
    /**
     * Clear <address> value
     *
     * @return \UserPersonalInformation
     */
    public function clearAddress(){
      return $this->_clear(9);
    }
    
    /**
     * Get <address> value
     *
     * @return string
     */
    public function getAddress(){
      return $this->_get(9);
    }
    
    /**
     * Set <address> value
     *
     * @param string $value
     * @return \UserPersonalInformation
     */
    public function setAddress( $value){
      return $this->_set(9, $value);
    }
    
    /**
     * Check if <city> has a value
     *
     * @return boolean
     */
    public function hasCity(){
      return $this->_has(10);
    }
    
    /**
     * Clear <city> value
     *
     * @return \UserPersonalInformation
     */
    public function clearCity(){
      return $this->_clear(10);
    }
    
    /**
     * Get <city> value
     *
     * @return string
     */
    public function getCity(){
      return $this->_get(10);
    }
    
    /**
     * Set <city> value
     *
     * @param string $value
     * @return \UserPersonalInformation
     */
    public function setCity( $value){
      return $this->_set(10, $value);
    }
    
    /**
     * Check if <country> has a value
     *
     * @return boolean
     */
    public function hasCountry(){
      return $this->_has(11);
    }
    
    /**
     * Clear <country> value
     *
     * @return \UserPersonalInformation
     */
    public function clearCountry(){
      return $this->_clear(11);
    }
    
    /**
     * Get <country> value
     *
     * @return string
     */
    public function getCountry(){
      return $this->_get(11);
    }
    
    /**
     * Set <country> value
     *
     * @param string $value
     * @return \UserPersonalInformation
     */
    public function setCountry( $value){
      return $this->_set(11, $value);
    }
  }
}

