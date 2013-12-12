<?php

/**
 * Description of Tasks
 *
 * @author sean
 */

require_once __DIR__."/../DataAccessObjects/TaskDao.class.php";
require_once __DIR__."/../../Common/models/TaskMetadata.php";
require_once __DIR__."/../../Common/protobufs/emails/UserFeedback.php";
require_once __DIR__."/../../Common/protobufs/emails/OrgFeedback.php";
require_once __DIR__."/../lib/IO.class.php";
require_once __DIR__."/../lib/Upload.class.php";
require_once __DIR__."/../lib/FormatConverter.php";
require_once __DIR__."/../../Common/lib/SolasMatchException.php";

class Tasks {
    
    public static function init()
    {
    	//
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/tasks(:format)/',
                                                        function ($format = ".json") {
            
            Dispatcher::sendResponce(null, TaskDao::getTask(), null, $format);
		}, 'getTasks', null);			
        //}, 'getTasks', 'Middleware::oAuth');        
        
		//
        Dispatcher::registerNamed(HttpMethodEnum::POST, '/v0/tasks(:format)/',
                                                        function ($format = ".json") {
            
            $data=Dispatcher::getDispatcher()->request()->getBody();
            $client = new APIHelper($format);
            $data = $client->deserialize($data, "Task");
            Dispatcher::sendResponce(null, TaskDao::create($data), null, $format);
        }, 'createTask');
        
        //
        Dispatcher::registerNamed(HttpMethodEnum::PUT, '/v0/tasks/:taskId/',
                                                        function ($taskId, $format = ".json") {
            
            if (!is_numeric($taskId) && strstr($taskId, '.')) {
                $taskId = explode('.', $taskId);
                $format = '.'.$taskId[1];
                $taskId = $taskId[0];
            }
            $data = Dispatcher::getDispatcher()->request()->getBody();
            $client = new APIHelper($format);
            $data = $client->deserialize($data, "Task");
            Dispatcher::sendResponce(null, TaskDao::save($data), null, $format);
        }, 'updateTask');
        
		//
        Dispatcher::registerNamed(HttpMethodEnum::DELETE, '/v0/tasks/:taskId/',
                                                            function ($taskId, $format = ".json") {
            
            if (!is_numeric($taskId) && strstr($taskId, '.')) {
                $taskId = explode('.', $taskId);
                $format = '.'.$taskId[1];
                $taskId = $taskId[0];
            }
            Dispatcher::sendResponce(null, TaskDao::delete($taskId), null, $format);
        }, 'deleteTask');
		
		//
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/tasks/:taskId/prerequisites(:format)/',
            function ($taskId, $format = ".json") {
                Dispatcher::sendResponce(null, TaskDao::getTaskPreReqs($taskId), null, $format);
        }, 'getTaskPreReqs', 'Middleware::authUserOrOrgForClaimedTask');
		
		//
        Dispatcher::registerNamed(HttpMethodEnum::PUT, '/v0/tasks/:taskId/prerequisites/:preReqId/',
            function ($taskId, $preReqId, $format = ".json") {
            if (!is_numeric($preReqId) && strstr($preReqId, '.')) {
                $preReqId = explode('.', $preReqId);
                $format = '.'.$preReqId[1];
                $preReqId = $preReqId[0];
            }
            
            Dispatcher::sendResponce(null, Upload::addTaskPreReq($taskId, $preReqId), null, $format);
        }, 'addTaskPreReq');
		
		//
        Dispatcher::registerNamed(HttpMethodEnum::DELETE, '/v0/tasks/:taskId/prerequisites/:preReqId/',
        function ($taskId, $preReqId, $format = ".json") {
            if (!is_numeric($preReqId) && strstr($preReqId, '.')) {
                $preReqId = explode('.', $preReqId);
                $format = '.'.$preReqId[1];
                $preReqId = $preReqId[0];
            }
            Dispatcher::sendResponce(null, Upload::removeTaskPreReq($taskId, $preReqId), null, $format);
            //Dispatcher::sendResponce(null, Upload::removeTaskPreReq($taskId, $preReqId), null, $format);
        }, 'removeTaskPreReq', 'Middleware::authenticateUserForOrgTask');
        
		//
        Dispatcher::registerNamed(HttpMethodEnum::PUT, '/v0/tasks/archiveTask/:taskId/user/:userId/',
                                                        function ($taskId, $userId, $format = ".json") {
            if (!is_numeric($userId) && strstr($userId, '.')) {
                $userId = explode('.', $userId);
                $format = '.'.$userId[1];
                $userId = $userId[0];
            }
            Dispatcher::sendResponce(null, TaskDao::moveToArchiveByID($taskId, $userId), null, $format);
        }, 'archiveTask');
        
		//
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/tasks/topTasks(:format)/',
                                                        function ($format = ".json") {
            
            $limit = Dispatcher::clenseArgs('limit', HttpMethodEnum::GET, 15);
            $offset = Dispatcher::clenseArgs('offset', HttpMethodEnum::GET, 0);
            Dispatcher::sendResponce(null, TaskDao::getLatestAvailableTasks($limit, $offset), null, $format);
        }, 'getTopTasks',null);
        
		//
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/tasks/:taskId/',
                                                        function ($taskId, $format = ".json") {

            if (!is_numeric($taskId) && strstr($taskId, '.')) {
                $taskId = explode('.', $taskId);
                $format = '.'.$taskId[1];
                $taskId = $taskId[0];
            }
            $data = TaskDao::getTask($taskId);
            if ($data && is_array($data)) {
                $data = $data[0];
            }
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'getTask',null);

        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/tasks/:taskId/reviews(:format)/',
                function ($taskId, $format = '.json')
                {
                    $review = TaskDao::getTaskReviews(null,$taskId);
                    Dispatcher::sendResponce(null, $review, null, $format);
                }, 'getTaskReview', 'Middleware::authUserOrOrgForClaimedTask');

        Dispatcher::registerNamed(HttpMethodEnum::POST, '/v0/tasks/reviews(:format)/',
                function ($format = '.json')
                {
                    $data=Dispatcher::getDispatcher()->request()->getBody();
                    $client = new APIHelper($format);
                    $review = $client->deserialize($data,"TaskReview");
                    Dispatcher::sendResponce(null, TaskDao::submitReview($review), null, $format);
                }, 'submitReview', 'Middleware::authenticateUserToSubmitReview');
        
		//
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/tasks/:taskId/tags(:format)/',
                                                        function ($taskId, $format = ".json") {
            Dispatcher::sendResponce(null, TaskDao::getTags($taskId), null, $format);
        }, 'getTasksTags',null);
//        
//        Dispatcher::registerNamed(HttpMethodEnum::PUT, '/v0/tasks/:id/tags(:format)/',
//                                                        function ($id, $format = ".json") {
//            $data = Dispatcher::getDispatcher()->request()->getBody();
//            $client = new APIHelper($format);
//            $data = $client->deserialize($data);
//            $data = $client->cast("Task", $data);
//            $result = TaskDao::updateTags($data);
//            Dispatcher::sendResponce(null, array("result" => $result), null, $format);
//        }, 'setTasksTags');
        
        
        //Consider Removing
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/tasks/:taskId/status(:format)/',
                                                        function ($taskId, $format=".json") {
            
            Dispatcher::sendResponce(null, array("status message" => TaskDao::getTaskStatus($taskId)), null, $format);
        }, 'getTaskStatus', 'Middleware::authUserOrOrgForClaimedTask');
		
		// Org Feedback, feedback sent from the organisation to the user who claimed the task
        Dispatcher::registerNamed(HttpMethodEnum::PUT, '/v0/tasks/:taskId/orgFeedback(:format)/',
                function ($taskId, $format = ".json") {
                    $data = Dispatcher::getDispatcher()->request()->getBody();
                    $client = new APIHelper($format);
                    $feedbackData = $client->deserialize($data,"OrgFeedback");
                    Notify::sendOrgFeedback($feedbackData);
                    Dispatcher::sendResponce(null, null, null, $format);
        }, 'sendOrgFeedback', 'Middleware::authenticateUserForOrgTask');
        
		// User Feedback, feedback sent from the user who claimed the task to the organisation
        Dispatcher::registerNamed(HttpMethodEnum::PUT, '/v0/tasks/:taskId/userFeedback(:format)/',
                function ($taskId, $format = ".json") {
                    $data = Dispatcher::getDispatcher()->request()->getBody();
                    $client = new APIHelper($format);
                    $feedbackData = $client->deserialize($data,"UserFeedback");
                    Notify::sendUserFeedback($feedbackData);
                    Dispatcher::sendResponce(null, null, null, $format);
        }, 'sendUserFeedback', 'Middleware::authUserForClaimedTask');
		
		//
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/tasks/:taskId/file(:format)/',
                                                        function ($taskId, $format=".json") {
            
            $version = Dispatcher::clenseArgs('version', HttpMethodEnum::GET, 0);
            $convert = Dispatcher::clenseArgs('convertToXliff', HttpMethodEnum::GET, false);
            if($convert&&$convert!==""){
                TaskDao::downloadConvertedTask($taskId, $version);
            }else{
                TaskDao::downloadTask($taskId, $version);
            }
        }, 'getTaskFile',null);
        
		//
        Dispatcher::registerNamed(HttpMethodEnum::PUT, '/v0/tasks/saveFile/:taskId/:userId/',
                                                        function ($taskId, $userId, $format = ".json") {
            
            if (!is_numeric($userId) && strstr($userId, '.')) {
                $userId = explode('.', $userId);
                $format = '.'.$userId[1];
                $userId = $userId[0];
            }
            $task = TaskDao::getTask($taskId);
            if (is_array($task)) {
                $task = $task[0];
            }
            $version = Dispatcher::clenseArgs('version', HttpMethodEnum::GET, null);
            $convert = Dispatcher::clenseArgs('convertFromXliff', HttpMethodEnum::GET, false);
            $data=Dispatcher::getDispatcher()->request()->getBody();
            $projectFile = ProjectDao::getProjectFileInfo($task->getProjectId(), null, null, null, null);
            $filename = $projectFile->getFilename();
            try {
                TaskDao::uploadFile($task, $convert,$data,$version,$userId,$filename);
            } catch(SolasMatchException $e) {
                Dispatcher::sendResponce(null, $e->getMessage(), $e->getCode());
                return;
            }
            Dispatcher::sendResponce(null, null, HttpStatusEnum::CREATED);
            
        }, 'saveTaskFile');
        
        //
         Dispatcher::registerNamed(HttpMethodEnum::PUT, '/v0/tasks/uploadOutputFile/:taskId/:userId/',
                                                        function ($taskId, $userId, $format = ".json") {
             if (!is_numeric($userId) && strstr($userId, '.')) {
                $userId = explode('.', $userId);
                $format = '.'.$userId[1];
                $userId = $userId[0];
            }
            $task = TaskDao::getTask($taskId);
            if (is_array($task)) {
                $task = $task[0];
            }
            
            $projectFile = ProjectDao::getProjectFileInfo($task->getProjectId(), null, null, null, null);
            $filename = $projectFile->getFilename();
            
            $convert = Dispatcher::clenseArgs('convertFromXliff', HttpMethodEnum::GET, false);
            $data=Dispatcher::getDispatcher()->request()->getBody();
            TaskDao::uploadOutputFile($task, $convert,$data,$userId,$filename);
        }, 'uploadOutputFile');
        
		//
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/tasks/:taskId/version(:format)/',
                                                        function ($taskId, $format = ".json") {
            
            $userId = Dispatcher::clenseArgs('userId', HttpMethodEnum::GET, null);
            Dispatcher::sendResponce(null, TaskDao::getLatestFileVersion($taskId, $userId), null, $format);
        }, 'getTaskVersion');
        
		//
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/tasks/:taskId/info(:format)/',
                                                        function ($taskId, $format = ".json") {
            
            $version = Dispatcher::clenseArgs('version', HttpMethodEnum::GET, 0);
            $taskMetadata = ModelFactory::buildModel("TaskMetadata", TaskDao::getTaskFileInfo($taskId, $version));
            Dispatcher::sendResponce(null, $taskMetadata, null, $format);
        }, 'getTaskInfo');
        
		//
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/tasks/:taskId/claimed(:format)/', 
                                                        function ($taskId, $format = ".json") {

            $data = null;
            $userId = Dispatcher::clenseArgs('userId', HttpMethodEnum::GET, null);
            if (is_numeric($userId)) {
                $data = TaskDao::hasUserClaimedTask($userId, $taskId);
            } else {
                $data = TaskDao::taskIsClaimed($taskId);
            }

            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'getTaskClaimed');
        
        //Consider Removing
        Dispatcher::registerNamed(HttpMethodEnum::POST, '/v0/tasks/addTarget/:languageCode/:countryCode/:userId/',
                                                function ($languageCode, $countryCode, $userId, $format = ".json") {
            
            if (!is_numeric($userId) && strstr($userId, '.')) {
                $userId = explode('.', $userId);
                $format = '.'.$userId[1];
                $userId = $userId[0];
            }
            $data = Dispatcher::getDispatcher()->request()->getBody();
            $client = new APIHelper($format);
            $data = $client->deserializer($data);
            $data = $client->cast("Task", $data);
            $result = TaskDao::duplicateTaskForTarget($data, $languageCode, $countryCode, $userId);
            Dispatcher::sendResponce(null, array("result" => $result), null, $format);
        }, 'addTarget', 'Middleware::authenticateUserMembership');   
        
		//
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/tasks/:taskId/user(:format)/',
                                                        function ($taskId, $format = ".json") {
            
            $data = TaskDao::getUserClaimedTask($taskId);
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'getUserClaimedTask');
        
		//
        Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/tasks/:taskId/timeClaimed(:format)/',
                                                        function ($taskId, $format = ".json") {
            
            $data = TaskDao::getClaimedTime($taskId);			
			
            Dispatcher::sendResponce(null, $data, null, $format);
        }, 'getClaimedTime', null);
		
		Dispatcher::registerNamed(HttpMethodEnum::GET, '/v0/tasks/pootleTranslate/:taskId/:userId(:format)/',
                                                        function ($taskId, $userId, $format = ".json") {
                                                        	
			if (!is_numeric($userId) && strstr($userId, '.')) {
                $userId = explode('.', $userId);
                $format = '.'.$userId[1];
                $userId = $userId[0];
            }
            $settings = new Settings();
			$pootleLocation = $settings->get("pootlefiles.pootle_directory");
			$tempLocation = $settings->get("pootlefiles.temp_directory");
			
			$baseUrl = Dispatcher::clenseArgs('backlink', HttpMethodEnum::GET, null);
			
			$users = UserDao::getUser($userId);	
			$user = $users[0];
            $tasks = TaskDao::getTask($taskId);
			$task = $tasks[0];
			$sourceLocale = $task->getSourceLocale();
        	$targetLocale = $task->getTargetLocale();
			$projects = ProjectDao::getProject($task->getProjectId());
			$project = $projects[0];
			$fileVersion = TaskDao::getLatestFileVersion($taskId);
			
			$task_file_info = TaskDao::getTaskFileInfo($taskId);
			$fileInfo = Upload::absoluteFilePathForUpload($task, $fileVersion, $task_file_info['filename']);
			
			$targetCode = $targetLocale->getLanguageCode().'_'.$targetLocale->getCountryCode();
			$targetName = $targetLocale->getLanguageName().' ('.$targetLocale->getCountryName().')';
			
			$sourceCode = $sourceLocale->getLanguageCode().'_'.$sourceLocale->getCountryCode();
			$sourceName = $sourceLocale->getLanguageName().' ('.$sourceLocale->getCountryName().')';
			
			
			//FileLocation /home/redray/workspace/solas-match/uploads/proj-{Project Id}/task-{Task Id}/v-{Version Number}/<Filename>
			$result[] = array(	'title' => $task->getTitle(), 
								'target_code' => $targetCode, 
								'target_name' => $targetName, 
								'source_code' => $sourceCode, 
								'source_name' => $sourceName, 
								'assignee_id' => $user->getEmail(), 
								//'backlink' => "something/something/something/task/$taskId/simple-upload",
								'backlink' => $baseUrl,
								//'fileInfo' => $fileInfo,
								'description' => $project->getDescription(), 
								'task_id' => $taskId,
								'translation_filename' => $task_file_info['filename']);
			
			$json_String = json_encode($result);
			
			$old_path = getcwd();
			
			//chdir($filedumpLocation);
			$cmd = "mkdir -m 777 -p {$tempLocation}/task-{$taskId}/";
			$output = shell_exec($cmd);
			
			//chdir("{$filedumpLocation}Pootle/task-{$taskId}");
			$cmd = "cp $fileInfo {$tempLocation}/task-{$taskId}";
			$output = shell_exec($cmd);
			//$filename = 'task'.$taskId.'.json';
			$filename = 'meta.json';
			$fp = fopen("{$tempLocation}/task-{$taskId}/".$filename, 'w+');
			fwrite($fp, $json_String);
			fclose($fp);
			//chdir($old_path);
			
			$cmd = "mv {$tempLocation}/task-{$taskId} {$pootleLocation}";
			$output = shell_exec($cmd);
			
            Dispatcher::sendResponce(null, $json_String, null, $format);
        }, 'pootleTranslate', null);
    }
}
Tasks::init();
