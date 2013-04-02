<?php

/**
 * Description of Register
 *
 * @author sean
 */

require_once __DIR__."/../../Common/models/Register.php";

class RegisterAPI {
    
    public  $email;
    public  $pass;
    
    public function __construct($e = "", $p = "")
    {         
        $this->email = $e;
        $this->pass = $p;
    }
    
    public static function init()
    {
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/register(:format)/',
                                                        function ($format = ".json") {
            
            $data = new Register();
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'getRegisterTemplate');
        
        Dispatcher::registerNamed(HttpMethodEnum::POST, '/v0/register(:format)/',
                                                        function ($format = ".json") {
            
            $data = Dispatcher::getDispatcher()->request()->getBody();
            $client = new APIHelper($format);
            $data = $client->deserialize($data);
            $data = $client->cast("Register", $data);
            $data = UserDao::apiRegister($data->getEmail(), $data->getPassword());
            if (is_array($data) && isset($data[0])) {
                $data=$data[0];
            }
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'register');
    }    
}
RegisterAPI::init();
