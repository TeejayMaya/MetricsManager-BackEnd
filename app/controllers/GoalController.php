<?php

use Phalcon\Mvc\Controller;

class GoalController extends \Phalcon\Mvc\Controller {

    public function beforeExecuteRoute()
    {
        // Executed before every found action
        $rawBody = $this->request->getJsonRawBody(true);
        if($rawBody){
            foreach ($rawBody as $key => $value) {
                $_POST[$key] = $value;
            }
        }
    }
    
    public function indexAction()
    {
        //echo json_encode(array("status"=>"success","message"=>"Hello World!"));
    }

    public function addAction()
    {
        /** Init Block **/
        $authService = new AuthService();
        $generalService = new GeneralService();
        $emailerService = new EmailerService();
        $errors = [];
        $data = [];
        $user = new Users();
        $goal = new Goals();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        /** Validation Block **/
        //Author ID and Name
        $data['companyid'] = $this->request->getPost('companyid');
        $data['userid'] = $this->request->getPost('userid');
        $data['username'] = $this->request->getPost('username');
        
        //title
        $data['title'] = $this->request->getPost('title');
        if (!is_string($data['title'])) {
            $errors['title'] = 'Title expected';
        }

        //type
        $data['type'] = $this->request->getPost('type');
        if (!is_string($data['type'])) {
            $errors['type'] = 'Type expected';
        }

        //level
        $data['level'] = $this->request->getPost('level');
        if (!is_string($data['level'])) {
            $errors['level'] = 'Level expected';
        }

        //target
        $data['target'] = $this->request->getPost('target');
        if (!is_string($data['target'])) {
            $errors['target'] = 'Target expected';
        }

        //targetdate
        $data['targetdate'] = $this->request->getPost('targetdate');
        if (!is_string($data['targetdate'])) {
            $errors['targetdate'] = 'Target date expected';
        }

        //targetscore
        $data['targetscore'] = $this->request->getPost('targetscore');
        if (!is_numeric($data['targetscore'])) {
            $errors['targetscore'] = 'Target score expected';
        }

        //KPI
        $data['kpi'] = $this->request->getPost('kpi');
        if (!is_string($data['kpi'])) {
            $errors['kpi'] = 'KPI expected';
        }

        //details
        $data['details'] = $this->request->getPost('details');
        if (!is_string($data['details'])) {
            $errors['details'] = 'Details expected';
        }

        //status
        $data['status'] = "pending";
        $data['result'] = "pending";
        $data['score'] = 0;
        $data['rating'] = 0;

        //Get current date and time
        $data['date'] = date("d-m-Y");
        $data['time'] = date('h:i A');

        //Error form handling check and Submit Data
        if ($errors) {
            return json_encode(array("status"=>"failed","message"=>implode( ", ", $errors )));
        } 

        // Store to Database Model and check for errors
        $goal->addEntry($data);
        //Send email alerts to group members
        $itemLists = array();
        $itemList = array();
        $resultData=$user->companyGroupMembers($this->request->getPost('companyid'),$data['level'],$data['target']); 
        foreach($resultData as $userData) {
            $member_username=$userData->username;
            $member_useremail=$userData->email;
            $member_userphone=$userData->phone;
            $emailerService->sendNewGoalAlertEmail($member_username, $member_useremail, $data['title'], $data['type'], $data['details']);
        }
        echo json_encode(array("status"=>"success","message"=>"Goal added successfully"));
    }

    public function updateAction()
    {
        /** Init Block **/
        $authService = new AuthService();
        $emailerService = new EmailerService();
        $goal = new Goals();
        $data = [];

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic
        if($this->request->getPost('status')){ //status change check
            $data['status'] = $this->request->getPost('status');
            if (is_string($data['status'])) {
                $goal->updateEntry($this->request->getPost('goalid'), $this->request->getPost('status'), "status"); //Update details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Status must be a string"));
            }
        }

        if($this->request->getPost('result')){ //result change check
            $data['result'] = $this->request->getPost('result');
            if (is_string($data['result'])) {
                $goal->updateEntry($this->request->getPost('goalid'), $this->request->getPost('result'), "result"); //Update details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Result must be a string"));
            }
        }

        if($this->request->getPost('score')){ //score change check
            $data['score'] = $this->request->getPost('score');
            if (is_string($data['score'])) {
                $goal->updateEntry($this->request->getPost('goalid'), $this->request->getPost('score'), "score"); //Update details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Score must be an INT"));
            }
        }

        //Send email alerts to group members
        $entryData=$goal->singleEntry($this->request->getPost('companyid'),$this->request->getPost('goalid')); // Get data from the Database
        $goalid=$entryData->id;
        $goaltitle=$entryData->title;
        $goaltype=$entryData->type;
        $goallevel=$entryData->level;
        $goaltarget=$entryData->target;
        $goal_status=$this->request->getPost('status');
        $goal_result=$this->request->getPost('result');
        $itemLists = array();
        $itemList = array();
        $resultData=$user->companyGroupMembers($this->request->getPost('companyid'),$goallevel,$goaltarget); 
        foreach($resultData as $userData) {
            $member_username=$userData->username;
            $member_useremail=$userData->email;
            $member_userphone=$userData->phone;
            $emailerService->sendGoalNewStatusAlertEmail($member_username, $member_useremail, $goaltitle, $goal_status, $goal_result);
        }
        
        echo json_encode(array("status"=>"success","message"=>"Goal updated successfully"));
    }

    public function addcommentAction()
    {
        /** Init Block **/
        $authService = new AuthService();
        $emailerService = new EmailerService();
        $user = new Users();
        $goal = new Goals();
        $comments = new Comments(); 

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic
        //Author ID and Name
        $data['companyid'] = $this->request->getPost('companyid');
        $data['userid'] = $this->request->getPost('userid');
        $data['username'] = $this->request->getPost('username');

        //postid
        $data['postid'] = $this->request->getPost('goalid');
        if (!is_string($data['postid'])) {
            $errors['postid'] = 'Post ID expected';
        }

        //type
        $data['type'] = "goals";

        //status
        $data['status'] = "approved";
        
        //commenter details
        $data['details'] = $this->request->getPost('details');
        if (!is_string($data['details'])) {
            $errors['details'] = 'Comment expected';
        } 

        //comment photo
        $data['photo'] = "";
       
        //Get current date and time
        $data['time'] = date("h:i:sa");
        $data['date'] = date("d-m-Y");

        //Error form handling check and Submit Data
        if ($errors) {
            return json_encode(array("status"=>"failed","message"=>implode( ", ", $errors )));
        } 

        // Store to Database Model and check for errors
        $comments->addEntry($data);
        if($this->request->getPost('status') && $this->request->getPost('status')!="undefined"){ //status change check
            $data['status'] = $this->request->getPost('status');
            if (is_string($data['status'])) {
                $goal->updateEntry($this->request->getPost('goalid'), $this->request->getPost('status'), "status"); //Update details changes
                $goal->updateEntry($this->request->getPost('goalid'), $this->request->getPost('status'), "result"); //Update details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Status must be a string"));
            }
        }
        if($this->request->getPost('score') && $this->request->getPost('score')!="undefined"){ //score change check
            $data['score'] = $this->request->getPost('score');
            if (is_string($data['score'])) {
                $goal->updateEntry($this->request->getPost('goalid'), $this->request->getPost('score'), "score"); //Update details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Score must be an INT"));
            }
        }

        //Send email alerts to group members
        $entryData=$goal->singleEntry($this->request->getPost('companyid'),$this->request->getPost('goalid')); // Get data from the Database
        $goalid=$entryData->id;
        $goaltitle=$entryData->title;
        $goaltype=$entryData->type;
        $goallevel=$entryData->level;
        $goaltarget=$entryData->target;
        $goal_status=$this->request->getPost('status');
        $goal_result=$this->request->getPost('result');
        $itemLists = array();
        $itemList = array();
        $resultData=$user->companyGroupMembers($this->request->getPost('companyid'),$goallevel,$goaltarget); 
        foreach($resultData as $userData) {
            $member_username=$userData->username;
            $member_useremail=$userData->email;
            $member_userphone=$userData->phone;
            $emailerService->sendGoalNewCommentAlertEmail($member_username, $member_useremail, $goaltitle, $data['username'], $data['details']);
        }
        echo json_encode(array("status"=>"success","message"=>"Comment added successfully"));
    }

    public function commentsAction($postid)
    {
        /** Init Block **/
        $authService = new AuthService();
        $user = new Users();
        $goal = new Goals();
        $comments = new Comments(); 
        $errors = [];
        $data = [];

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic
        $itemLists = array();
        $itemList = array();
        $resultData=$comments->allEntriesByPost($postid); // Get post comments data from the Database
        foreach($resultData as $entryData) {
            $itemList['id']=$entryData->id;
            $itemList['postid']=$entryData->postid;
            $itemList['userid']=$entryData->userid;
            $itemList['username']=$entryData->username;
            $userData=$user->singleUser($itemList['userid']); // Get User data from the Database
            $itemList['userphoto']=$this->getDi()->getShared('siteurl').'/'.$userData->photo;
            $itemList['status']=$entryData->status;
            $itemList['message']=$entryData->details;
            $itemList['details']=$entryData->details;
            $itemList['date']=$entryData->date;
            $itemLists[] = $itemList;
        }
        echo json_encode($itemLists);    
    }

    public function listsAction($type="all")
    {
        /** Init Block **/
        $authService = new AuthService();
        $goal = new Goals();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic
        $itemLists = array();
        $itemList = array();
        if($type=="all"){
            $resultData=$goal->allEntries($this->request->getPost('companyid')); // Get data from the Database
        } else {
            $resultData=$goal->allEntriesByType($this->request->getPost('companyid'),$type); // Get data from the Database
        }
        foreach($resultData as $entryData) {
            $itemList['id']=$entryData->id;
            $itemList['title']=$entryData->title;
            $itemList['type']=$entryData->type;
            $itemList['level']=$entryData->level;
            $itemList['target']=$entryData->target;
            $itemList['targetdate']=$entryData->targetdate;
            $itemList['targetscore']=$entryData->targetscore;
            $itemList['score']=$entryData->score;
            $itemList['kpi']=$entryData->kpi;
            $itemList['details']=$entryData->details;
            $itemList['status']=$entryData->status;
            $itemList['date']=$entryData->date;
            $itemLists[] = $itemList;
        } 
        echo json_encode($itemLists);    
    }

    public function stafflistsAction($staffid)
    {
        /** Init Block **/
        $authService = new AuthService();
        $goal = new Goals();
        $user = new Users();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic
        $userData=$user->singleCompanyUser($this->request->getPost('companyid'),$staffid); // Get User data from the Database
        $userlevel=$userData->level;
        $usergroup=$userData->group;
        $itemLists = array();
        $itemList = array();
        $resultData=$goal->allEntriesByGroup($this->request->getPost('companyid'),$userlevel,$usergroup); // Get data from the Database
        foreach($resultData as $entryData) {
            $itemList['id']=$entryData->id;
            $itemList['title']=$entryData->title;
            $itemList['type']=$entryData->type;
            $itemList['level']=$entryData->level;
            $itemList['target']=$entryData->target;
            $itemList['targetdate']=$entryData->targetdate;
            $itemList['targetscore']=$entryData->targetscore;
            $itemList['score']=$entryData->score;
            $itemList['kpi']=$entryData->kpi;
            $itemList['details']=$entryData->details;
            $itemList['status']=$entryData->status;
            $itemList['date']=$entryData->date;
            $itemLists[] = $itemList;
        } 
        echo json_encode($itemLists);    
    }

    public function grouplistsAction()
    {
        /** Init Block **/
        $authService = new AuthService();
        $goal = new Goals();
        $user = new Users();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic
        $grouptitle = $this->request->getPost('groupname');
        if (!is_string($data['groupname'])) {
            return json_encode(array("status"=>"failed","message"=>"Group title expected"));
        }

        $grouplevel = $this->request->getPost('grouplevel');
        if (!is_string($data['grouplevel'])) {
            return json_encode(array("status"=>"failed","message"=>"Group level expected"));
        }

        $itemLists = array();
        $itemList = array();
        $resultData=$goal->allEntriesByGroup($this->request->getPost('companyid'),$grouplevel,$grouptitle); // Get data from the Database
        foreach($resultData as $entryData) {
            $itemList['id']=$entryData->id;
            $itemList['title']=$entryData->title;
            $itemList['type']=$entryData->type;
            $itemList['level']=$entryData->level;
            $itemList['target']=$entryData->target;
            $itemList['targetdate']=$entryData->targetdate;
            $itemList['targetscore']=$entryData->targetscore;
            $itemList['score']=$entryData->score;
            $itemList['kpi']=$entryData->kpi;
            $itemList['details']=$entryData->details;
            $itemList['status']=$entryData->status;
            $itemList['date']=$entryData->date;
            $itemLists[] = $itemList;
        } 
        echo json_encode($itemLists);    
    }

    public function singleAction($postid)
    {
        /** Init Block **/
        $authService = new AuthService();
        $goal = new Goals();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic
        $itemList = array();
        $entryData=$goal->singleEntry($this->request->getPost('companyid'),$postid); // Get data from the Database
        $itemList['id']=$entryData->id;
        $itemList['title']=$entryData->title;
        $itemList['type']=$entryData->type;
        $itemList['level']=$entryData->level;
        $itemList['target']=$entryData->target;
        $itemList['targetdate']=$entryData->targetdate;
        $itemList['targetscore']=$entryData->targetscore;
        $itemList['score']=$entryData->score;
        $itemList['kpi']=$entryData->kpi;
        $itemList['details']=$entryData->details;
        $itemList['status']=$entryData->status;
        $itemList['date']=$entryData->date;
        echo json_encode($itemList);       
    }

    public function removeGoalAction()
    {
        /** Init Block **/
        $authService = new AuthService();
        $goal = new Goals();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "admin"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic
        $goal->removePage($this->request->getPost('goalid')); //Delete page
        echo json_encode(array("status"=>"success","message"=>"Goal deleted successfully"));
    }
}
?>