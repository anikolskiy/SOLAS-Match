<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Middleware
 *
 * @author sean
 */
require_once __DIR__."/../DataAccessObjects/AdminDao.class.php";
require_once __DIR__."/../DataAccessObjects/TaskDao.class.php";
require_once __DIR__."/../DataAccessObjects/OrganisationDao.class.php";
require_once __DIR__."/../DataAccessObjects/ProjectDao.class.php";

class Middleware
{
   
    
    
    public static function isloggedIn ($request, $response, $route){
         $resource = new League\OAuth2\Server\Resource(new League\OAuth2\Server\Storage\PDO\Session());
        // Test for token existance and validity
        try {
            $resource->isValid(true);
            $parts =explode(" ",$_SERVER['HTTP_AUTHORIZATION']);
            return UserDao::getByOauthToken($parts[1]);
        }

        // The access token is missing or invalid...
        catch (League\OAuth2\Server\Exception\InvalidAccessTokenException $e)
        {
//            print_r($response);
            Dispatcher::getDispatcher()->halt(HttpStatusEnum::UNAUTHORIZED, $e->getMessage());
        }
//        $params = $route->getParams();
//      
//        
//       
//            if(isset ($params['email'])&& isset($_SERVER['HTTP_X_CUSTOM_AUTHORIZATION'])){
//                $headerHash = $_SERVER['HTTP_X_CUSTOM_AUTHORIZATION'];
//                $email =$params['email'];
//                 if (!is_numeric($email) && strstr($email, '.')) {
//                    $temp = array();
//                    $temp = explode('.', $email);
//                    $lastIndex = sizeof($temp)-1;
//                    if ($lastIndex > 1) {
//                        $format='.'.$temp[$lastIndex];
//                        $email = $temp[0];
//                        for ($i = 1; $i < $lastIndex; $i++) {
//                            $email = "{$email}.{$temp[$i]}";
//                        }
//                    }
//                }
//                $openidHash = md5($email.substr(Settings::get("session.site_key"),0,20));
//                if ($headerHash!=$openidHash) {
//                    Dispatcher::getDispatcher()->halt(HttpStatusEnum::FORBIDDEN, "The Autherization header does not match the current user or the user does not have permission to acess the current resource");
//                } 
//            }
        
    } 
    
    
    public static function Registervalidation ($request, $response, $route) {
            $params = $route->getParams();
            if(isset ($params['email'])&& isset($_SERVER['HTTP_X_CUSTOM_AUTHORIZATION'])){
                $headerHash = $_SERVER['HTTP_X_CUSTOM_AUTHORIZATION'];
                $email =$params['email'];
                 if (!is_numeric($email) && strstr($email, '.')) {
                    $temp = array();
                    $temp = explode('.', $email);
                    $lastIndex = sizeof($temp)-1;
                    if ($lastIndex > 1) {
                        $format='.'.$temp[$lastIndex];
                        $email = $temp[0];
                        for ($i = 1; $i < $lastIndex; $i++) {
                            $email = "{$email}.{$temp[$i]}";
                        }
                    }
                }
                $openidHash = md5($email.substr(Settings::get("session.site_key"),0,20));
                if ($headerHash!=$openidHash) {
                    
                    Dispatcher::getDispatcher()->halt(HttpStatusEnum::FORBIDDEN, "The Autherization header does not match the current user or the user does not have permission to acess the current resource");
                } 
            }else self::authUserOwnsResource ($request, $response, $route);
    }
  
    
    
     public static function authUserOwnsResource($request, $response, $route)
    {
         $user =self::isloggedIn ($request, $response, $route);
         if (self::isSiteAdmin($user->getId())) {
            return true;
        }
        $params = $route->getParams();
        $id=$params['id'];
        if (!is_numeric($id) && strstr($id, '.')) {
                $id = explode('.', $id);
                $format = '.'.$id[1];
                $id = $id[0];
            }
        if($id!=$user->getId()) Dispatcher::getDispatcher()->halt(HttpStatusEnum::FORBIDDEN, "The Autherization header does not match the current user or the user does not have permission to acess the current resource");

    }    
    
    
    public static function notFound()
    {
        Dispatcher::getDispatcher()->redirect(Dispatcher::getDispatcher()->urlFor('getLoginTemplate'));
    }
    
    private static function isSiteAdmin($id)
    {
        
        return AdminDao::isAdmin($id,null);
    }

    public static function authenticateUserForTask($request, $response, $route) 
    {
        if (self::isSiteAdmin()) {
            return true;
        }

        
        
        $params = $route->getParams(); 

        self::authUserIsLoggedIn();
        $user_id = UserSession::getCurrentUserID();
        $claimant = null;
        if ($params !== null) {
            $task_id = $params['task_id'];
            $claimant =TaskDao::getUserClaimedTask($task_id);             
        }
        return !$claimant || $user_id == $claimant->getId();
    }

    public static function authUserForOrg($request, $response, $route) 
    {
        if (self::isSiteAdmin()) {
            return true;
        }

       

        $user_id = UserSession::getCurrentUserID();
        $params = $route->getParams();
        if ($params !== null) {
            $org_id = $params['org_id'];
            if ($user_id) {
                $user_orgs =OrganisationDao::getOrgByUser($user_id);
                if (!is_null($user_orgs)) {
                    foreach ($user_orgs as $orgObject) {
                        if ($orgObject->getId() == $org_id) {
                            return true;
                        }
                    }
                }
            }
        }
        
        self::notFound();
    }

    /*
     *  Middleware for ensuring the current user belongs to the Org that uploaded the associated Task
     *  Used for altering task details
     */
    public static function authUserForOrgTask($request, $response, $route) 
    {
        if (self::isSiteAdmin()) {
            return true;
        }

        
        $params= $route->getParams();
        if ($params != null) {
            $task_id = $params['task_id'];
            $task = TaskDao::getTask($task_id);
            $task = is_array($task)?$task[0]:$task;
            $project =ProjectDao::getProject($task->getProjectId());
            $project = is_array($project)?$project[0]:$project;
            $org_id = $project->getOrganisationId();
            $user_id = UserSession::getCurrentUserID();

            if ($user_id && OrganisationDao::isMember($org_id, $user_id)) {
                return true;
            }
        }
       
        self::notFound();
    } 
//    
//    public static function authUserForOrgProject($request, $response, $route) 
//    {                        
//        if ($this->isSiteAdmin()) {
//            return true;
//        }
//
//        $params = $route->getParams();
//        $userDao = new UserDao();
//        $projectDao = new ProjectDao();
//        
//        if ($params != null) {
//            $user_id = UserSession::getCurrentUserID();
//            $project_id = $params['project_id'];   
//            $userOrgs = $userDao->getUserOrgs($user_id);
//            $project = $projectDao->getProject($project_id); 
//            $project_orgid = $project->getOrganisationId();
//
//            if($userOrgs) {
//                foreach($userOrgs as $org)
//                {                
//                    if($org->getId() == $project_orgid) {
//                        return true;
//                    }
//                }
//            }
//        }
//        self::notFound();
//    }    
//
//    public static function authUserForTaskDownload($request, $response, $route)
//    {
//        if ($this->isSiteAdmin()) {
//            return true;
//        }
//
//        $taskDao = new TaskDao();
//        $projectDao = new ProjectDao();
//        $userDao = new UserDao();
//
//        $params= $route->getParams();
//        if ($params != null) {
//            $task_id = $params['task_id'];
//            $task = $taskDao->getTask($task_id);
////            if($taskDao->getUserClaimedTask($task_id) && $task->getStatus() != TaskStatusEnum::COMPLETE) return true;
//            if($taskDao->getUserClaimedTask($task_id)) return true;
//
//            $project = $projectDao->getProject($task->getProjectId());
//            
//            $org_id = $project->getOrganisationId();
//            $user_id = UserSession::getCurrentUserID();
//
//            if ($user_id) {
//                $user_orgs = $userDao->getUserOrgs($user_id);
//                if (!is_null($user_orgs)) {
//                    foreach ($user_orgs as $orgObject) {
//                        if ($orgObject->getId() == $org_id) {
//                            return true;
//                        }
//                    }
//                }                
//            }
//        }
//       
//        self::notFound();
//    }
    
   
    
    
    
}

?>
