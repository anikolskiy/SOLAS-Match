<?php

/**
 * Description of Users
 *
 * @author sean
 */

require_once __DIR__."/../DataAccessObjects/UserDao.class.php";
require_once __DIR__."/../DataAccessObjects/TaskDao.class.php";
require_once __DIR__."/../lib/Notify.class.php";
require_once __DIR__."/../lib/NotificationTypes.class.php";

class Users {
    
    public static function init()
    {
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/users(:format)/',
                                                        function ($format = ".json") {
            
            Dispatcher::sendResponce(null, "display all users", null, $format);
        }, 'getUsers');
        
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/users/:id/',
                                                        function ($id, $format = ".json") {
            
            if (!is_numeric($id) && strstr($id, '.')) {
                $id = explode('.', $id);
                $format = '.'.$id[1];
                $id = $id[0];
            }

            $data = UserDao::getUser($id);

            if (is_array($data)) {
                $data = $data[0];
            }
           
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'getUser');
        
        
        Dispatcher::registerNamed(HttpMethodEnum::DELETE, '/v0/users/leaveOrg/:id/:org/',
                                                           function ($id, $org, $format = ".json") {
            if (!is_numeric($org) && strstr($org, '.')) {
                $org = explode('.', $org);
                $format = '.'.$org[1];
                $org = $org[0];
            }
            $data = OrganisationDao::revokeMembership($org, $id);
            if (is_array($data)) {
                $data = $data[0];
            }
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'userLeaveOrg');        
        
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/users/getByEmail/:email/',
                                                        function ($email, $format = ".json") {
            
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
            $data = UserDao::getUser(null, $email);
            if (is_array($data)) {
                $data = $data[0];
            }
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'getUserByEmail');

        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/users/:user_id/org/:org_id/admin(:format)/',
                function ($userId, $orgId, $format = '.json')
                {
                    $ret = false;
                    $ret = UserDao::isAdmin($userId, $orgId);
                    Dispatcher::sendResponce(null, $ret, null, $format);
                }, 'isAdmin');
       
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/users/subscribedToTask/:id/:taskID/',
                                                        function ($id, $taskID, $format = ".json") {

            if (!is_numeric($taskID) && strstr($taskID, '.')) {
                $taskID = explode('.', $taskID);
                $format = '.'.$taskID[1];
                $taskID = $taskID[0];
            }
            Dispatcher::sendResponce(null, UserDao::isSubscribedToTask($id, $taskID), null, $format);
        }, 'userSubscribedToTask');        
        
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/users/subscribedToProject/:id/:projectID/',
                                                        function ($id, $projectID, $format = ".json") {

            if (!is_numeric($projectID) && strstr($projectID, '.')) {
                $projectID = explode('.', $projectID);
                $format = '.'.$projectID[1];
                $projectID = $projectID[0];
            }
            Dispatcher::sendResponce(null, UserDao::isSubscribedToProject($id, $projectID), null, $format);
        }, 'userSubscribedToProject');  
        
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/users/:id/orgs(:format)/',
                                                        function ($id, $format = ".json") {
            Dispatcher::sendResponce(null, UserDao::findOrganisationsUserBelongsTo($id), null, $format);
        }, 'getUserOrgs');
       
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/users/:id/badges(:format)/',
                                                        function ($id, $format = ".json") {
            Dispatcher::sendResponce(null, UserDao::getUserBadges($id), null, $format);
        }, 'getUserbadges');
        
        Dispatcher::registerNamed(HttpMethodEnum::POST, '/v0/users/:id/badges(:format)/',
                                                        function ($id, $format=".json") {
            
            $data = Dispatcher::getDispatcher()->request()->getBody();
            $client = new APIHelper($format);
            $data = $client->deserialize($data,'Badge');
//            $data = $client->cast('Badge', $data);
            Dispatcher::sendResponce(null, BadgeDao::assignBadge($id, $data->getId()), null, $format);
        }, 'addUserbadges');
        
        Dispatcher::registerNamed(HttpMethodEnum::PUT, '/v0/users/:id/badges/:badge/',
                                                        function ($id, $badge, $format = ".json") {
            
            if (!is_numeric($badge) && strstr($badge, '.')) {
                 $badge = explode('.', $badge);
                 $format = '.'.$badge[1];
                 $badge = $badge[0];
            }
            Dispatcher::sendResponce(null, BadgeDao::assignBadge($id, $badge), null, $format);
        }, 'addUserbadgesByID');
        
        Dispatcher::registerNamed(HttpMethodEnum::DELETE, '/v0/users/:id/badges/:badge/',
                                                            function ($id, $badge, $format = ".json") {
            if (!is_numeric($badge) && strstr($badge, '.')) {
                $badge = explode('.', $badge);
                $format = '.'.$badge[1];
                $badge = $badge[0];
            }
            Dispatcher::sendResponce(null, BadgeDao::removeUserBadge($id, $badge), null, $format);
        }, 'deleteUserbadgesByID');
        
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/users/:id/tags(:format)/',
                                                        function ($id, $format = ".json") {
            $limit = Dispatcher::clenseArgs('limit', HttpMethodEnum::GET, null);
            Dispatcher::sendResponce(null, UserDao::getUserTags($id, $limit), null, $format);
        }, 'getUsertags');

        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/users/:id/taskStreamNotification(:format)/',
                function ($id, $format = ".json")
                {
                    $data = UserDao::getUserTaskStreamNotification($id);
                    Dispatcher::sendResponce(null, $data, null, $format);
                }, 'getUserTaskStreamNotification');

        Dispatcher::registerNamed(HttpMethodEnum::DELETE, '/v0/users/:id/taskStreamNotification(:format)/',
                function ($id, $format = ".json")
                {
                    $ret = UserDao::removeTaskStreamNotification($id);
                    Dispatcher::sendResponce(null, $ret, null, $format);
                }, 'removeUserTaskStreamNotification');

        Dispatcher::registerNamed(HttpMethodEnum::PUT, '/v0/users/:id/interval/:interval/taskStreamNotification(:format)/',
                function ($id, $interval, $format = ".json")
                {
                    $ret = UserDao::requestTaskStreamNotification($id, $interval);
                    Dispatcher::sendResponce(null, $ret, null, $format);
                }, 'updateTaskStreamNotification');
        
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/users/:id/tasks(:format)/',
                                                        function ($id, $format = ".json") {
            Dispatcher::sendResponce(null, TaskDao::getUserTasks($id), null, $format);
        }, 'getUsertasks');
        
        Dispatcher::registerNamed(HttpMethodEnum::POST, '/v0/users/:id/tasks(:format)/',
                                                        function ($id, $format = ".json") {
            
            $data = Dispatcher::getDispatcher()->request()->getBody();
            $client = new APIHelper($format);
            $data = $client->deserialize($data,'Task');
            Dispatcher::sendResponce(null, TaskDao::claimTask($data->getId(), $id), null, $format);
            Notify::notifyUserClaimedTask($id, $data->getId());
            Notify::notifyOrgClaimedTask($id, $data->getId());
        }, 'userClaimTask');
       
        Dispatcher::registerNamed(HttpMethodEnum::DELETE, '/v0/users/:id/tasks/:tID/',
                                                        function ($id, $tID ,$format = ".json") {
             
            if (!is_numeric($tID) && strstr($tID, '.')) {
                 $tID = explode('.', $tID);
                 $format = '.'.$tID[1];
                 $tID = $tID[0];
            }
            Dispatcher::sendResponce(null, TaskDao::unClaimTask($tID,$id), null, $format);
        }, 'userUnClaimTask');

        
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/users/:id/top_tasks(:format)/',
                                                        function ($id, $format = ".json") {
            
            $limit = Dispatcher::clenseArgs('limit', HttpMethodEnum::GET, 5);
            $filter = Dispatcher::clenseArgs('filter', HttpMethodEnum::GET, '');
            $filters = APIHelper::parseFilterString($filter);
            $filter = "";
            if (isset($filters['taskType']) && $filters['taskType'] != '') {
                $filter .= " AND t.`task-type_id`=".$filters['taskType'];
            }
            if (isset($filters['sourceLanguage']) && $filters['sourceLanguage'] != '') {
                $filter .= " AND t.`language_id-source`= (SELECT id FROM Languages WHERE code=\'".
                            $filters['sourceLanguage']."\')";
            }
            if (isset($filters['targetLanguage']) && $filters['targetLanguage'] != '') {
                $filter .= " AND t.`language_id-target`= (SELECT id FROM Languages WHERE code=\'".
                            $filters['targetLanguage']."\')";
            }

            $dao = new TaskDao();
            $data = $dao->getUserTopTasks($id, $limit, $filter);
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'getUserTopTasks');
        
        
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/users/:id/archived_tasks(:format)/',
                                                        function ($id, $format = ".json") {
            
            $limit = Dispatcher::clenseArgs('limit', HttpMethodEnum::GET, 5);
            $data = TaskDao::getUserArchivedTasks($id, $limit);
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'getUserArchivedTasks');
        
        
        Dispatcher::registerNamed(HttpMethodEnum::PUT, '/v0/users/:id/',
                                                        function ($id, $format = ".json") {
            if (!is_numeric($id) && strstr($id, '.')) {
                $id = explode('.', $id);
                $format = '.'.$id[1];
                $id = $id[0];
            }
            $data = Dispatcher::getDispatcher()->request()->getBody();
            $client = new APIHelper($format);
            $data = $client->deserialize($data,'User');
//            $data = $client->cast('User', $data);
            $data->setId($id);
            $data = UserDao::save($data);
//            $data = $client->cast("User", $data);
//            if (is_array($data)) {
//                $data = $data[0];
//            }
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'updateUser');
        
        Dispatcher::registerNamed(HttpMethodEnum::POST, '/v0/users/:id/tags(:format)/',
                                                        function ($id, $format = ".json"){
            $data = Dispatcher::getDispatcher()->request()->getBody();
            $client = new APIHelper($format);
            $data = $client->deserialize($data,'Tag');
//            $data = $client->cast('Tag', $data);
            $data = UserDao::likeTag($id, $data->getId());
            if (is_array($data)) {
                $data = $data[0];
            }
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'addUsertag');
        
        Dispatcher::registerNamed(HttpMethodEnum::PUT, '/v0/users/:id/tags/:tagId/',
                                                        function ($id, $tagId, $format = ".json") {
            if (!is_numeric($tagId) && strstr($tagId, '.')) {
                $tagId = explode('.', $tagId);
                $format = '.'.$tagId[1];
                $tagId = $tagId[0];
            }
            $data = UserDao::likeTag($id, $tagId);
            if (is_array($data)) {
                $data = $data[0];
            }
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'addUserTagById');
        
        Dispatcher::registerNamed(HttpMethodEnum::DELETE, '/v0/users/:id/tags/:tagId/',
                                                            function ($id, $tagId, $format = ".json") {
            if (!is_numeric($tagId) && strstr($tagId, '.')) {
                $tagId = explode('.', $tagId);
                $format = '.'.$tagId[1];
                $tagId = $tagId[0];
            }
            $data = UserDao::removeTag($id, $tagId);
            if (is_array($data)) {
                $data = $data[0];
            }
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'deleteUserTagById');
        
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/users/:id/tracked_tasks(:format)/',
                                                        function ($id, $format = ".json") {
            
            $data=UserDao::getTrackedTasks($id);
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'getUserTrackedTasks');
        
        Dispatcher::registerNamed(HttpMethodEnum::POST, '/v0/users/:id/tracked_tasks(:format)/',
                                                        function ($id, $format=".json"){
            $data = Dispatcher::getDispatcher()->request()->getBody();
            $client = new APIHelper($format);
            $data = $client->deserialize($data,'Task');
//            $data = $client->cast('Task', $data);
            $data = UserDao::trackTask($id, $data->getId());
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'addUserTrackedTasks');
        
        Dispatcher::registerNamed(HttpMethodEnum::PUT, '/v0/users/:id/tracked_tasks/:taskID/',
                                                        function ($id, $taskID, $format = ".json") {
            
            if (!is_numeric($taskID) && strstr($taskID, '.')) {
                $taskID = explode('.', $taskID);
                $format = '.'.$taskID[1];
                $taskID = $taskID[0];
            }
            $data = UserDao::trackTask($id, $taskID);
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'addUserTrackedTasksById');
        
        Dispatcher::registerNamed(HttpMethodEnum::DELETE, '/v0/users/:id/tracked_tasks/:taskID/',
                                                            function ($id, $taskID, $format = ".json") {
            
            if (!is_numeric($taskID) && strstr($taskID, '.')) {
                $taskID = explode('.', $taskID);
                $format = '.'.$taskID[1];
                $taskID = $taskID[0];
            }
            $data=UserDao::ignoreTask($id, $taskID);
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'deleteUserTrackedTasksById');
        
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/users/:id/passwordResetRequest(:format)/',
                                                        function ($id, $format = ".json") {
            $data = UserDao::hasRequestedPasswordReset($id) ? 1 : 0;
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'hasUserRequestedPasswordReset');

        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/users/:id/passwordResetRequest/time(:format)/',
                                                        function ($id, $format = ".json"){
            $resetRequest = UserDao::getPasswordResetRequests($id);
            Dispatcher::sendResponce(null, $resetRequest->getRequestTime(), null, $format);
        }, "PasswordResetRequestTime");
        
        Dispatcher::registerNamed(HttpMethodEnum::POST, '/v0/users/:id/passwordResetRequest(:format)/',
                                                        function ($id, $format=".json"){
            Dispatcher::sendResponce(null, UserDao::createPasswordReset($id), null, $format);
            Notify::sendPasswordResetEmail($id);
        }, 'createPasswordResetRequest');   
        
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/users/:id/projects(:format)/',
                                                        function ($id, $format=".json"){
            $data = UserDao::getTrackedProjects($id);
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'getUserTrackedProjects'); 
        
        Dispatcher::registerNamed(HttpMethodEnum::PUT, '/v0/users/:id/projects/:pID/',
                                                        function ($id,$pID, $format=".json"){
            if (!is_numeric($pID) && strstr($pID, '.')) {
                $pID = explode('.', $pID);
                $format = '.'.$pID[1];
                $pID = $pID[0];
            }
            $data = UserDao::trackProject($pID,$id);
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'userTrackProject'); 
        
        Dispatcher::registerNamed(HttpMethodEnum::DELETE, '/v0/users/:id/projects/:pID/',
                                                        function ($id,$pID, $format=".json"){
            if (!is_numeric($pID) && strstr($pID, '.')) {
                $pID = explode('.', $pID);
                $format = '.'.$pID[1];
                $pID = $pID[0];
            }
            $data = UserDao::unTrackProject($pID,$id);
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'userUnTrackProject'); 
        
        
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/users/:id/personalInfo(:format)/',
                                                        function ($id, $format = ".json") {
            
            if (!is_numeric($id) && strstr($id, '.')) {
                $id = explode('.', $id);
                $format = '.'.$id[1];
                $id = $id[0];
            }

            $data = UserDao::getPersonalInfo(null,$id);
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'getUserPersonalInfo');
        
        Dispatcher::registerNamed(HttpMethodEnum::POST, '/v0/users/:id/personalInfo(:format)/',
                                                        function ($id, $format = ".json") {
            
            if (!is_numeric($id) && strstr($id, '.')) {
                $id = explode('.', $id);
                $format = '.'.$id[1];
                $id = $id[0];
            }
            
            $data = Dispatcher::getDispatcher()->request()->getBody();
            $client = new APIHelper($format);
            $data = $client->deserialize($data, "UserPersonalInformation");    
            
            Dispatcher::sendResponce(null, UserDao::createPersonalInfo($data), null, $format);

        }, 'createUserPersonalInfo');
        
        Dispatcher::registerNamed(HttpMethodEnum::PUT, '/v0/users/:id/personalInfo(:format)/',
                                                        function ($id, $format = ".json") {
            if (!is_numeric($id) && strstr($id, '.')) {
                $id = explode('.', $id);
                $format = '.'.$id[1];
                $id = $id[0];
            }
            $data = Dispatcher::getDispatcher()->request()->getBody();
            $client = new APIHelper($format);
            $data = $client->deserialize($data,'UserPersonalInformation');
            $data = UserDao::updatePersonalInfo($data);

            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'updateUserPersonalInfo');
        
        
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/users/:id/secondaryLanguages(:format)/',
                                                        function ($id, $format = ".json") {
            
            if (!is_numeric($id) && strstr($id, '.')) {
                $id = explode('.', $id);
                $format = '.'.$id[1];
                $id = $id[0];
            }

            $data = UserDao::getSecondaryLanguages($id);
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'getSecondaryLanguages');
        
        Dispatcher::registerNamed(HttpMethodEnum::POST, '/v0/users/:id/secondaryLanguages(:format)/',
                                                        function ($id, $format = ".json") {
            
            if (!is_numeric($id) && strstr($id, '.')) {
                $id = explode('.', $id);
                $format = '.'.$id[1];
                $id = $id[0];
            }
            
            $data = Dispatcher::getDispatcher()->request()->getBody();
            $client = new APIHelper($format);
            $data = $client->deserialize($data, "Locale");    
            
            Dispatcher::sendResponce(null, UserDao::createSecondaryLanguage($id, $data), null, $format);

        }, 'createSecondaryLanguage');
        
        Dispatcher::registerNamed(HttpMethodEnum::DELETE, '/v0/users/removeSecondaryLanguage/:userId/:languageCode/:countryCode/',
                                                        function ($userId,$languageCode,$countryCode, $format=".json"){
            if (strstr($countryCode, '.')) {
                $countryCode = explode('.', $countryCode);
                $format = '.'.$countryCode[1];
                $countryCode = $countryCode[0];
            }
            $data = UserDao::deleteSecondaryLanguage($userId, $languageCode, $countryCode);
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'deleteSecondaryLanguage'); 
    }
}
Users::init();
