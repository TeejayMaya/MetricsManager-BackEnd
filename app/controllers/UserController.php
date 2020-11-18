<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

class UserController extends ControllerBase {    

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

    public function registerAction()
    {
        /** Init Block **/
        $errors = [];
        $data = [];
        $user = new Users();
        $company = new Companies();
        $companystructure = new Companystructure();
        $generalService = new GeneralService();
        $emailerService = new EmailerService();

        /** Validation Block **/
        try {
        //StaffID
        $data['staffid'] = "0";

        //Firstname
        $data['firstname'] = $this->request->getPost('firstname');
        if (!is_string($data['firstname'])) {
            $errors['firstname'] = 'Firstname expected';
        }

        //Lastname
        $data['lastname'] = $this->request->getPost('lastname');
        if (!is_string($data['lastname'])) {
            $errors['lastname'] = 'Lastname expected';
        }

        //Username
        $data['username'] = $data['firstname']." ".$data['lastname'];

        //Email
        $data['email'] = $this->request->getPost('email');
        if (!is_string($data['email'])) {
            $errors['email'] = 'Email expected';
        }

        //Phone
        $data['phone'] = $this->request->getPost('phone');
        if (!is_numeric($data['phone'])) {
            $errors['phone'] = 'Phone expected';
        }

        //Group Level
        $data['level'] = "";
        $data['group'] = "";

        //Position
        $data['position'] = $this->request->getPost('position');
        if (!is_string($data['position'])) {
            $errors['position'] = 'Role/Position expected';
        }

        //Linkedinprofile
        $data['linkedinprofile'] = $this->request->getPost('linkedinprofile');
        if (!is_string($data['linkedinprofile'])) {
            $errors['linkedinprofile'] = 'Linkedin profile expected';
        }

        //Password
        $data['password'] = $this->request->getPost('password');
        if (!is_string($data['password'])) {
            $errors['password'] = 'Password expected.';
        }

        //Password Confirm
        $data['passwordtwo'] = "";
        $data['passwordtwo'] = $this->request->getPost('passwordtwo');
        if (!is_string($data['passwordtwo']) || $data['password']!=$data['passwordtwo']) {
            $errors['passwordtwo'] = 'Both passwords does not match';
        }

        //Hash password
        $data['passwordhash'] = $this->security->hash($data['password']);

        //Profile photo
        $data['photo'] = "files/avatar.png";

        //Referrer code
        $data['referrercode'] = $this->request->getPost('referrercode');

        //Referral code
        $data['referralcode'] = rand ( 10000 , 99999 ); //Referral code

        //Verification code
        $data['verificationcode'] = bin2hex(random_bytes('9')); //Verification code

        //Account type
        $data['type'] = "admin";

        //Referrer details
        $data['referrerdetails'] = $this->request->getPost('referrerdetails');

        //Company name
        $data['companyname'] = $this->request->getPost('companyname');
        if (!is_string($data['companyname'])) {
            $errors['companyname'] = 'Company name expected';
        }

        //Company industrynew
        $data['companyindustrynew'] = $this->request->getPost('companyindustrynew');

        //Company industry
        $data['companyindustry'] = $this->request->getPost('companyindustry');
        if (!is_string($data['companyindustry'])) {
            $data['companyindustry'] = $data['companyindustrynew'];
        }

        //Company address
        $data['companyaddress'] = $this->request->getPost('companyaddress');
        if (!is_string($data['companyaddress'])) {
            $errors['companyaddress'] = 'Company address expected';
        }

        //Company city
        $data['companycity'] = $this->request->getPost('companycity');
        if (!is_string($data['companycity'])) {
            $errors['companycity'] = 'Company city expected';
        }

        //Company state
        $data['companystate'] = $this->request->getPost('companystate');
        if (!is_string($data['companystate'])) {
            $errors['companystate'] = 'Company state expected';
        }

        //Company country
        $data['companycountry'] = $this->request->getPost('companycountry');
        if (!is_string($data['companycountry'])) {
            $errors['companycountry'] = 'Company country expected';
        }

        //Company website
        $data['companywebsite'] = $this->request->getPost('companywebsite');
        if (!is_string($data['companywebsite'])) {
            $errors['companywebsite'] = 'Company website expected';
        }

        //Company email
        $data['companyemail'] = $this->request->getPost('companyemail');
        if (!is_string($data['companyemail'])) {
            $errors['companyemail'] = 'Company email expected';
        }

        //Company phone
        $data['companyphone'] = $this->request->getPost('companyphone');
        if (!is_numeric($data['companyphone'])) {
            $errors['companyphone'] = 'Company phone expected';
        }

        //Company employees count
        $data['companyemployeescount'] = $this->request->getPost('companyemployeescount');
        if (!is_string($data['companyemployeescount'])) {
            $errors['companyemployeescount'] = 'Company employees count expected';
        }

        //Company logo
        $data['companylogo'] = "files/avatar.png";
        if($this->request->hasFiles() == true){ //Photo change check
            $extIMG = array(
                'image/jpeg',
                'image/png',
                'image/gif',
            );
            foreach( $this->request->getUploadedFiles() as $file)
            {              
                // is it a valid extension?
                if ( in_array($file->getType() , $extIMG) && $file->getError() == 0 )
                {
                    $Name          = preg_replace("/[^A-Za-z0-9.]/", '-', $file->getName() );
                    $FileName      = "files/" . $Name;
                    $FileExtension = $file->getExtension();
                    if(!$file->moveTo($FileName)) { // move file to needed path";
                        return json_encode(array("status"=>"failed","message"=>"Error uploading photo"));
                    } else {
                        $data['companylogo'] = "$FileName"; 
                    }
                } else {
                    return json_encode(array("status"=>"failed","message"=>"Photo must be either JPEG or PNG or GIF file format"));
                }
            }
        }

        //Get current date and time
        $data['date'] = date("d-m-Y");
        $data['time'] = date('h:i A');

        // Check if User already exist in the Database
        $existResult=$user->checkUserExist($data);
        $existResultCompany=$company->checkCompanyExist($data);

        //Error form handling check and Submit Data
        if($errors) {
            echo json_encode(array("status"=>"failed","message"=>implode( ", ", $errors )));
        } elseif ($existResult >= 1 || $existResultCompany >= 1) {
        //Already exist
            echo json_encode(array("status"=>"failed","message"=>"Duplicate entry. Username, email or phone already exist."));
        } else {
        // Store to Database Model and check for errors
            $data['companyid']=$company->addCompany($data);
            $result=$user->addUser($data);
            if($result) {
                //Success
                //Add Company Structure Corporate
                $data['userid'] ="$result";
                $data['title'] ="corporate";
                $data['level'] ="corporate";
                $data['parentlevel'] ="";
                $data['categoryid'] ="";
                $data['category'] ="";
                $data['details'] ="Corporate level";
                $companystructure->addCategory($data);
                //Send Confirmation Emails
                $emailerService->sendWelcomeEmail($data['username'], $data['companyemail'], $data['verificationcode'], $data['password']); //email Company
                $emailerService->sendWelcomeEmail($data['username'], $data['email'], $data['verificationcode'], $data['password']); //email User
                //Proceed to Login The New User
                $userData=$user->singleUser($data['email']); //Get User data from the Database
                $companyid=$userData->companyid;
                $userid=$userData->id;
                $username=$userData->username;
                $useremail=$userData->email;
                $userimage=$this->getDi()->getShared('siteurl').'/'.$userData->photo;
                $accounttype=$userData->type;
                $logintoken=$generalService->generate_logintoken($data); //Auth login token
                $logindevice=$userData->logindevice;
                $lastlogindate=$userData->lastlogindate;
                $newdate=date("d-m-Y");
                $user->updateUserLoginToken($data['username'], $logintoken, $newdate); //Update User DB with generated token and last login date
                $company->updateCompanyUser($data['companyid'], $result, $data['username']); //Update Company profile with Author
                echo json_encode(array("status"=>"success","message"=>"Registration successful","companyid"=>"$companyid","userid"=>"$userid","username"=>"$username","useremail"=>"$useremail","userimage"=>"$userimage","accounttype"=>"$accounttype","logintoken"=>"$logintoken","logindevice"=>"$logindevice"));
            } else {
                //Failed
                echo json_encode(array("status"=>"failed","message"=>"Error occurred on database. Please try again"));
            }            
        }
        } catch(Exception $e) {
            return json_encode(array("status"=>"failed","message"=>$e->getMessage()));
        }
    }

    public function addAction()
    {
        /** Init Block **/
        $errors = [];
        $data = [];
        $user = new Users();
        $company = new Companies();
        $generalService = new GeneralService();
        $emailerService = new EmailerService();

        /** Validation Block **/
        //CompanyID
        $data['companyid'] = $this->request->getPost('companyid');

        //StaffID
        $data['staffid'] = $this->request->getPost('staffid');

        //Firstname
        $data['firstname'] = $this->request->getPost('firstname');
        if (!is_string($data['firstname'])) {
            $errors['firstname'] = 'Firstname expected';
        }

        //Lastname
        $data['lastname'] = $this->request->getPost('lastname');
        if (!is_string($data['lastname'])) {
            $errors['lastname'] = 'Lastname expected';
        }

        //Username
        $data['username'] = $data['firstname']." ".$data['lastname'];

        //Email
        $data['email'] = $this->request->getPost('email');
        if (!is_string($data['email'])) {
            $errors['email'] = 'Email expected';
        }

        //Phone
        $data['phone'] = $this->request->getPost('phone');
        if (!is_numeric($data['phone'])) {
            $errors['phone'] = 'Phone expected';
        }        

        //Group Level
        $data['level'] = $this->request->getPost('level');
        if (!is_string($data['level'])) {
            $errors['level'] = 'Level expected';
        }
        if($data['level']=="corporate"){
            $data['group'] = "corporate";
            $existCorporateUserResult=$user->checkUserLevelGroupExist($data['companyid'],$data['level'],$data['group']);//Check if any User already added to Corporate Level
            if ($existCorporateUserResult >= 1) {
                return json_encode(array("status"=>"failed","message"=>"User already exist and added to Corporate."));
            } 
        } else {
            //Get Level group
            $data['group'] = $this->request->getPost('department');
            if (!is_string($data['group'])) {
                $errors['group'] = 'Group expected';
            }
        }

        //Position
        $data['position'] = $this->request->getPost('position');
        if (!is_string($data['position'])) {
            $errors['position'] = 'Role/Position expected';
        }

        //Linkedinprofile
        $data['linkedinprofile'] = $this->request->getPost('linkedinprofile');

        //Password
        $data['password'] = rand ( 10000 , 99999 );
        $data['passwordhash'] = $this->security->hash($data['password']); //Hash password

        //Profile photo
        $data['photo'] = "files/avatar.png";

        //Referrer code
        $data['referrercode'] = $this->request->getPost('referrercode');

        //Referral code
        $data['referralcode'] = rand ( 10000 , 99999 ); //Referral code

        //Verification code
        $data['verificationcode'] = bin2hex(random_bytes('9')); //Verification code

        //Account type
        $data['type'] = "staff";

        //Referrer details
        $data['referrerdetails'] = "";

        //Get current date and time
        $data['date'] = date("d-m-Y");
        $data['time'] = date('h:i A');

        // Check if User already exist in the Database
        $existResult=$user->checkUserExist($data);

        //Error form handling check and Submit Data
        if($errors) {
            return json_encode(array("status"=>"failed","message"=>implode( ", ", $errors )));
        } elseif ($existResult >= 1) {
        //Already exist
            return json_encode(array("status"=>"failed","message"=>"Duplicate entry. Username, email or phone already exist."));
        } else {
        // Store to Database Model and check for errors
            $result=$user->addUser($data);
            if ($result) {
                //Success
                $emailerService->sendWelcomeEmailToStaff($data['username'], $data['email'], $data['verificationcode'], $data['password']);
                return json_encode(array("status"=>"success","message"=>"Staff added successful"));
            } else {
                //Failed
                return json_encode(array("status"=>"failed","message"=>"Error occurred on database. Please try again"));
            }            
        }
    }

    public function editAction()
    {
        /** Init Block **/
        $authService = new AuthService();
        $user = new Users();
        $company = new Companies();
        $data = [];

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic
        if($this->request->getPost('staffuserid')){ //StaffID change check
            $data['staffid'] = $this->request->getPost('staffuserid');
            if (is_string($data['staffid'])) {
                $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('staffuserid'), $this->request->getPost('staffid'), "staffid"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Staff ID must be a string"));
            }
        }

        if($this->request->getPost('firstname')){ //Firstname change check
            $data['firstname'] = $this->request->getPost('firstname');
            if (is_string($data['firstname'])) {
                $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('staffuserid'), $this->request->getPost('firstname'), "firstname"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Firstname must be a string"));
            }
        }

        if($this->request->getPost('lastname')){ //Lastname change check
            $data['lastname'] = $this->request->getPost('lastname');
            if (is_string($data['lastname'])) {
                $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('staffuserid'), $this->request->getPost('lastname'), "lastname"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Lastname must be a string"));
            }
        }

        if($this->request->getPost('phone')){ //Phone change check
            $data['phone'] = $this->request->getPost('phone');
            if (preg_match('/^[0-9_-]{3,16}$/', $data['phone'])) {
                $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('staffuserid'), $this->request->getPost('phone'), "phone"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Phone must be numbers only"));
            }
        }

        if($this->request->getPost('address')){ //Address change check
            $data['address'] = $this->request->getPost('address');
            if (is_string($data['address'])) {
                $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('staffuserid'), $this->request->getPost('address'), "address"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Address must be a string"));
            }
        }

        if($this->request->getPost('city')){ //City change check
            $data['city'] = $this->request->getPost('city');
            if (is_string($data['city'])) {
                $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('staffuserid'), $this->request->getPost('city'), "city"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"City must be a string"));
            }
        }

        if($this->request->getPost('state')){ //State change check
            $data['state'] = $this->request->getPost('state');
            if (is_string($data['state'])) {
                $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('staffuserid'), $this->request->getPost('state'), "state"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"State must be a string"));
            }
        }

        if($this->request->getPost('country')){ //Country change check
            $data['country'] = $this->request->getPost('country');
            if (is_string($data['country'])) {
                $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('staffuserid'), $this->request->getPost('country'), "country"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Country must be a string"));
            }
        }

        if($this->request->getPost('postalzipcode')){ //Postalzipcode change check
            $data['postalzipcode'] = $this->request->getPost('postalzipcode');
            if (is_string($data['postalzipcode'])) {
                $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('staffuserid'), $this->request->getPost('postalzipcode'), "postalzipcode"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Postal/Zip code must be a string"));
            }
        }
        
        if($this->request->getPost('level')){ //Level change check
            $data['level'] = $this->request->getPost('level');
            if (is_string($data['level'])) {
                if($data['level']=="corporate"){
                    $data['group'] = "corporate";
                    $existCorporateUserResult=$user->checkUserLevelGroupExist($data['companyid'],$data['level'],$data['group']);//Check if any User already added to Corporate Level
                    if ($existCorporateUserResult >= 1) {
                        return json_encode(array("status"=>"failed","message"=>"User already exist and added to Corporate."));
                    } 
                }
                $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('staffuserid'), $data['level'], "level"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Level expected."));
            }
        }

        if($this->request->getPost('department')){ //Level Group department change check
            $data['department'] = $this->request->getPost('department');
            if (is_string($data['department'])) {
                $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('staffuserid'), $this->request->getPost('department'), "group"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Department expected"));
            }
        }

        if($this->request->getPost('position')){ //position change check
            $data['position'] = $this->request->getPost('position');
            if (is_string($data['position'])) {
                $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('staffuserid'), $this->request->getPost('position'), "position"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Position must be a string"));
            }
        }

        if($this->request->hasFiles() == true){ //Photo change check
            $extIMG = array(
                'image/jpeg',
                'image/png',
                'image/gif',
            );
            foreach( $this->request->getUploadedFiles() as $file)
            {              
                // is it a valid extension?
                if ( in_array($file->getType() , $extIMG) && $file->getError() == 0 )
                {
                    $Name          = preg_replace("/[^A-Za-z0-9.]/", '-', $file->getName() );
                    $FileName      = "files/" . $Name;
                    $FileExtension = $file->getExtension();
                    if(!$file->moveTo($FileName)) { // move file to needed path";
                        return json_encode(array("status"=>"failed","message"=>"Error uploading photo"));
                    } else {
                        $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('staffuserid'), $FileName, "photo"); //Update User account details changes
                    }
                } else {
                    return json_encode(array("status"=>"failed","message"=>"Photo must be either JPEG or PNG or GIF file format"));
                }
            }
        }
        
        echo json_encode(array("status"=>"success","message"=>"Staff updated successfully"));
    }

    public function loginAction()
    {
        /** Init Block **/
        $errors = [];
        $data = [];
        $user = new Users();
        $company = new Companies();
        $generalService = new GeneralService();

        /** Validation Block **/
        //Username
        $data['username'] = $this->request->getPost('username');
        if (!is_string($data['username'])) {
            $errors['username'] = 'Username expected.';
        }

        //Password
        $data['password'] = $this->request->getPost('password');
        if (!is_string($data['password'])) {
            $errors['password'] = 'Password expected.';
        }

        // Check if User already exist in the Database
        $existResult=$user->checkUserDataExist($data['username']);

        //Error form handling check and Submit Data
        if ($errors) {
            return json_encode(array("status"=>"failed","message"=>implode( ", ", $errors )));
        } 
        
        //Already exist
        if ($existResult >= 1) {
            // Get User data from the Database
            $userData=$user->singleUser($data['username']);
            $userPasswordHash=$userData->password;
            //Compare password with hashed password
            if ($this->security->checkHash($data['password'], $userPasswordHash)) {
                // The password is valid
                $companyid=$userData->companyid;
                $userid=$userData->id;
                $username=$userData->username;
                $useremail=$userData->email;
                $userimage=$this->getDi()->getShared('siteurl').'/'.$userData->photo;
                $accounttype=$userData->type;
                $logindevice=$userData->logindevice;
                $lastlogindate=$userData->lastlogindate;
                $logintoken=$userData->logintoken;
                if(!$logintoken){
                    $logintoken=$generalService->generate_logintoken($data); //Auth login token
                }
                $newdate=date("d-m-Y");
                $user->updateUserLoginToken($data['username'], $logintoken, $newdate); //Update User DB with generated token and last login date
                echo json_encode(array("status"=>"success","message"=>"login successful","companyid"=>"$companyid","userid"=>"$userid","username"=>"$username","useremail"=>"$useremail","userimage"=>"$userimage","accounttype"=>"$accounttype","logintoken"=>"$logintoken","logindevice"=>"$logindevice"));
            } else {
                //Invalid login attempt
                echo json_encode(array("status"=>"failed","message"=>"Invalid login credentials"));
            }
        } else {
            //Invalid login attempt
            echo json_encode(array("status"=>"failed","message"=>"Invalid login attempt"));
        }
    }

    public function forgotpasswordAction()
    {
        /** Init Block **/
        $errors = [];
        $data = [];
        $user = new Users();
        $company = new Companies();
        $emailerService = new EmailerService();

        /** Validation Block **/
        //Email
        $data['email'] = $this->request->getPost('email');
        if (!is_string($data['email'])) {
            $errors['email'] = 'Email expected';
        }

        //Reset code
        $data['resetcode'] = $this->request->getPost('resetcode');

        //Today's date
        $newdate=date("d-m-Y");

        //Error form handling check and Submit Data
        if ($errors) {
            return json_encode(array("status"=>"failed","message"=>implode( ", ", $errors )));
        } 

        //Reset password if reset code is available
        if ($data['resetcode'] && is_string($data['resetcode'])) {
            //Reset pass
            $validResetCode=$user->verifyUserPasswordResetCode($data['email'], $data['resetcode'], $newdate); //Verify User provided password reset code and today's expiry date
            if ($validResetCode >= 1) {
                //User reset code is valid
                $newpassword=bin2hex(random_bytes('6')); //New temp password
                $newpasswordhash=$this->security->hash($newpassword);
                $user->resetUserPassword($data['email'], $newpasswordhash); //Clear User password reset code and update with new password
                $emailerService->sendNewPasswordResetEmail($data['email'], $newpassword);
                echo json_encode(array("status"=>"success","message"=>"New password sent to your email"));
            } else {
                //User reset code not valid
                echo json_encode(array("status"=>"failed","message"=>"Provided reset code not valid or expired"));
            }
        } else {
            //check if user exist and send pass recovery code to user
            $existResult=$user->checkUserDataExist($data['email']);
            if ($existResult >= 1) {
                $passwordresetcode=rand(1000,10000); //Reset code
                $user->updateUserPasswordResetCode($data['email'], $passwordresetcode, $newdate); //Update User DB with generated password reset code and today's expiry date
                //User reset code sent
                $emailerService->sendPasswordRecoveryEmail($data['email'], $passwordresetcode);
                echo json_encode(array("status"=>"success","message"=>"Password reset code sent to your email"));
            } else {
                //User does not exist
                echo json_encode(array("status"=>"failed","message"=>"User does not exist"));
            }
        }
    }

    public function changeresetpasswordAction()
    {
        /** Init Block **/
        $errors = [];
        $data = [];
        $user = new Users();
        $company = new Companies();
        $emailerService = new EmailerService();

        /** Validation Block **/
        //Email
        $data['email'] = $this->request->getPost('email');
        if (!is_string($data['email'])) {
            $errors['email'] = 'Email expected';
        }

        //Reset code
        $data['resetcode'] = $this->request->getPost('resetcode');

        //Today's date
        $newdate=date("d-m-Y");

        //Error form handling check and Submit Data
        if ($errors) {
            return json_encode(array("status"=>"failed","message"=>implode( ", ", $errors )));
        } 

        //Reset password if reset code is available
        if ($data['resetcode'] && is_string($data['resetcode'])) {
            //Reset Pass
            //Password
            $data['password'] = $this->request->getPost('password');
            if (!is_string($data['password'])) {
                $errors['password'] = 'Password expected.';
            }

            //Password Confirm
            $data['passwordtwo'] = $this->request->getPost('passwordtwo');
            if (!is_string($data['passwordtwo']) || $data['password']!=$data['passwordtwo']) {
                $errors['passwordtwo'] = 'Both passwords does not match';
            }

            //Hash password
            $data['passwordhash'] = $this->security->hash($data['password']);

            $validResetCode=$user->verifyUserPasswordResetCode($data['email'], $data['resetcode'], $newdate); //Verify User provided password reset code and today's expiry date
            if ($validResetCode >= 1) {
                //User reset code is valid
                $newpasswordhash=$data['passwordhash']; //New password
                $user->resetUserPassword($data['email'], $newpasswordhash); //Clear User password reset code and update with new password
                $emailerService->sendNewPasswordResetEmail($data['email'], $data['password']);
                echo json_encode(array("status"=>"success","message"=>"Password changed"));
            } else {
                //User reset code not valid
                echo json_encode(array("status"=>"failed","message"=>"Provided reset code not valid or expired"));
            }
        } else {
            //check if user exist and send pass recovery code to user
            $existResult=$user->checkUserDataExist($data['email']);
            if ($existResult >= 1) {
                $passwordresetcode=rand(1000,10000); //Reset code
                $user->updateUserPasswordResetCode($data['email'], $passwordresetcode, $newdate); //Update User DB with generated password reset code and today's expiry date
                //User reset code sent
                $emailerService->sendPasswordResetLinkEmail($data['email'], $passwordresetcode);
                echo json_encode(array("status"=>"success","message"=>"Password reset link sent to your email"));
            } else {
                //User does not exist
                echo json_encode(array("status"=>"failed","message"=>"User does not exist"));
            }
        }
    }

    public function verifyaccountAction()
    {
        /** Init Block **/
        $errors = [];
        $data = [];
        $user = new Users();
        $company = new Companies();
        $emailerService = new EmailerService();

        /** Validation Block **/
        //UserID
        $data['userid'] = $this->request->getPost('userid');
        if (!is_string($data['userid'])) {
            $errors['userid'] = 'UserID expected';
        }

        //Verification Code
        $data['verificationcode'] = $this->request->getPost('verificationcode');
        if (!is_string($data['verificationcode'])) {
            $errors['verificationcode'] = 'Verification code expected';
        }

        //Error form handling check and Submit Data
        if ($errors) {
            echo json_encode(array("status"=>"failed","message"=>implode( ", ", $errors )));
        } 

        //check if user exist and send pass recovery code to user
        $existResult=$user->checkUserDataExist($data['userid']);
        if ($existResult >= 1) {
            $verifyResult=$user->verifyUserAccount($data['userid'], $data['verificationcode']); //Verify User account if code is valid
            if ($verifyResult >= 1) {
                echo json_encode(array("status"=>"success","message"=>"Account verified and activated successfully"));
            } else {
                echo json_encode(array("status"=>"failed","message"=>"Account activation code invalid!"));
            }
        } else {
            //User does not exist
            echo json_encode(array("status"=>"failed","message"=>"User does not exist"));
        }
    
    }

    public function accountdetailsAction()
    {
        /** Init Block **/
        $authService = new AuthService();
        $user = new Users();
        $company = new Companies();
        $goals = new Goals();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 
        
        //Passed the User Auth Check, Proceed with the Business Logic
        $userData=$user->singleUser($this->request->getPost('userid')); // Get User data from the Database
        $userid=$userData->id;
        $username=$userData->username;
        $firstname=$userData->firstname;
        $lastname=$userData->lastname;
        $userimage=$this->getDi()->getShared('siteurl').'/'.$userData->photo;
        $useremail=$userData->email;
        $userphone=$userData->phone;
        $accounttype=$userData->type;
        $address=$userData->address;
        $city=$userData->city;
        $state=$userData->state;
        $country=$userData->country;
        $postalzipcode=$userData->postalzipcode;
        $position=$userData->position;
        $linkedinprofile=$userData->linkedinprofile;
        $referrerdetails=$userData->referrerdetails;
        $referralcode=$userData->referralcode;
        $referrercode=$userData->referrercode;
        $lastlogindate=$userData->lastlogindate;
        $totalgoals=$goals->sumEntriesByUser($userid); // Get User Total Tasks Sum data from the Database
        $totalreferred=$user->sumReferredUsers($referralcode); // Get User Total Referrals Sum data from the Database
        echo json_encode(array("status"=>"success","username"=>"$username","useremail"=>"$useremail","userimage"=>"$userimage","accounttype"=>"$accounttype","userphone"=>"$userphone","firstname"=>"$firstname","lastname"=>"$lastname","address"=>"$address","city"=>"$city","state"=>"$state","country"=>"$country","postalzipcode"=>"$postalzipcode","position"=>"$position","linkedinprofile"=>"$linkedinprofile","referrerdetails"=>"$referrerdetails","referralcode"=>"$referralcode","referrercode"=>"$referrercode","totalgoals"=>"$totalgoals","totalreferred"=>"$totalreferred","lastlogindate"=>"$lastlogindate"));
    }

    public function accountupdateAction()
    {
        /** Init Block **/
        $authService = new AuthService();
        $user = new Users();
        $company = new Companies();
        $data = [];

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic
        if($this->request->getPost('firstname')){ //Firstname change check
            $data['firstname'] = $this->request->getPost('firstname');
            if (is_string($data['firstname'])) {
                $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('userid'), $this->request->getPost('firstname'), "firstname"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Firstname must be a string"));
            }
        }

        if($this->request->getPost('lastname')){ //Lastname change check
            $data['lastname'] = $this->request->getPost('lastname');
            if (is_string($data['lastname'])) {
                $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('userid'), $this->request->getPost('lastname'), "lastname"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Lastname must be a string"));
            }
        }

        if($this->request->getPost('phone')){ //Phone change check
            $data['phone'] = $this->request->getPost('phone');
            if (preg_match('/^[0-9_-]{3,16}$/', $data['phone'])) {
                $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('userid'), $this->request->getPost('phone'), "phone"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Phone must be numbers only"));
            }
        }

        if($this->request->getPost('address')){ //Address change check
            $data['address'] = $this->request->getPost('address');
            if (is_string($data['address'])) {
                $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('userid'), $this->request->getPost('address'), "address"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Address must be a string"));
            }
        }

        if($this->request->getPost('city')){ //City change check
            $data['city'] = $this->request->getPost('city');
            if (is_string($data['city'])) {
                $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('userid'), $this->request->getPost('city'), "city"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"City must be a string"));
            }
        }

        if($this->request->getPost('state')){ //State change check
            $data['state'] = $this->request->getPost('state');
            if (is_string($data['state'])) {
                $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('userid'), $this->request->getPost('state'), "state"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"State must be a string"));
            }
        }

        if($this->request->getPost('country')){ //Country change check
            $data['country'] = $this->request->getPost('country');
            if (is_string($data['country'])) {
                $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('userid'), $this->request->getPost('country'), "country"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Country must be a string"));
            }
        }

        if($this->request->getPost('postalzipcode')){ //Postalzipcode change check
            $data['postalzipcode'] = $this->request->getPost('postalzipcode');
            if (is_string($data['postalzipcode'])) {
                $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('userid'), $this->request->getPost('postalzipcode'), "postalzipcode"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Postal/Zip code must be a string"));
            }
        }
        
        if($this->request->getPost('password')){ //Password change check
            $data['password'] = $this->request->getPost('password');
            if (is_string($data['password'])) {
                $data['passwordhash'] = $this->security->hash($data['password']); //Hash password
                $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('userid'), $data['passwordhash'], "password"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Password expected. Must consist of words, numbers or symbols"));
            }
        }

        if($this->request->getPost('linkedinprofile')){ //linkedinprofile change check
            $data['linkedinprofile'] = $this->request->getPost('linkedinprofile');
            if (is_string($data['linkedinprofile'])) {
                $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('userid'), $this->request->getPost('linkedinprofile'), "linkedinprofile"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Linkedin profile must be a string"));
            }
        }

        if($this->request->getPost('position')){ //position change check
            $data['position'] = $this->request->getPost('position');
            if (is_string($data['position'])) {
                $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('userid'), $this->request->getPost('position'), "position"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Position must be a string"));
            }
        }

        if($this->request->hasFiles() == true){ //Photo change check
            $extIMG = array(
                'image/jpeg',
                'image/png',
                'image/gif',
            );
            foreach( $this->request->getUploadedFiles() as $file)
            {              
                // is it a valid extension?
                if ( in_array($file->getType() , $extIMG) && $file->getError() == 0 )
                {
                    $Name          = preg_replace("/[^A-Za-z0-9.]/", '-', $file->getName() );
                    $FileName      = "files/" . $Name;
                    $FileExtension = $file->getExtension();
                    if(!$file->moveTo($FileName)) { // move file to needed path";
                        return json_encode(array("status"=>"failed","message"=>"Error uploading photo"));
                    } else {
                        $user->updateUserAccount($this->request->getPost('companyid'),$this->request->getPost('userid'), $FileName, "photo"); //Update User account details changes
                    }
                } else {
                    return json_encode(array("status"=>"failed","message"=>"Photo must be either JPEG or PNG or GIF file format"));
                }
            }
        }
        
        echo json_encode(array("status"=>"success","message"=>"Account updated successfully"));
    }

    public function dashboarddataAction()
    {
        /** Init Block **/
        $authService = new AuthService();
        $user = new Users();
        $company = new Companies();
        $goals = new Goals();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic
        $userData=$user->singleUser($this->request->getPost('userid')); // Get User data from the Database
        $userid=$userData->id;
        $username=$userData->username;
        $firstname=$userData->firstname;
        $lastname=$userData->lastname;
        $useremail=$userData->email;
        $referralcode=$userData->referralcode;
        $totalgoalscompleted=$goals->goalResultStatus($this->request->getPost('companyid'),"completed"); 
        $totalgoalspending=$goals->goalResultStatus($this->request->getPost('companyid'),"pending"); 
        $financialsgoalsresult=$goals->goalResultType($this->request->getPost('companyid'),"financials"); 
        $customersgoalsresult=$goals->goalResultType($this->request->getPost('companyid'),"customers"); 
        $internalprocessesgoalsresult=$goals->goalResultType($this->request->getPost('companyid'),"internalprocesses"); 
        $learninggrowthgoalsresult=$goals->goalResultType($this->request->getPost('companyid'),"learninggrowth"); 
        $totalgoals=$goals->sumgoals(); // Get User Total Tasks Sum data from the Database
        $totalreferred=$user->sumReferredUsers($referralcode); // Get User Total Referrals Sum data from the Database
        $totalstaffs=$user->sumUsers(); // Get User Total Referrals Sum data from the Database
        
        //Graph Reports 
        //Set Dates 
        $currentmonth = date("m-Y"); //current month
        $currentmonthLABEL = date("M"); //current month
        $lastmonthone= date('m-Y', strtotime("-1 month")); //1 month ago
        $lastmonthoneLABEL = date("M", strtotime("-1 month")); //1 month ago
        $lastmonthtwo= date('m-Y', strtotime("-2 month")); //2 month ago
        $lastmonthtwoLABEL = date("M", strtotime("-2 month")); //2 month ago
        $lastmonththree= date('m-Y', strtotime("-3 month")); //3 month ago
        $lastmonththreeLABEL = date("M", strtotime("-3 month")); //3 month ago
        $lastmonthfour= date('m-Y', strtotime("-4 month")); //4 month ago
        $lastmonthfourLABEL = date("M", strtotime("-4 month")); //4 month ago
        $lastmonthfive= date('m-Y', strtotime("-5 month")); //5 month ago
        $lastmonthfiveLABEL = date("M", strtotime("-5 month")); //5 month ago

        //Goals Counts
        $currentmonth_GoalsCOUNT=$goals->entriesCountData($currentmonth,$this->request->getPost('companyid')); // Get data for graph chart
        $lastmonthone_GoalsCOUNT=$goals->entriesCountData($lastmonthone,$this->request->getPost('companyid')); // Get data for graph chart
        $lastmonthtwo_GoalsCOUNT=$goals->entriesCountData($lastmonthtwo,$this->request->getPost('companyid')); // Get data for graph chart
        $lastmonththree_GoalsCOUNT=$goals->entriesCountData($lastmonththree,$this->request->getPost('companyid')); // Get data for graph chart
        $lastmonthfour_GoalsCOUNT=$goals->entriesCountData($lastmonthfour,$this->request->getPost('companyid')); // Get data for graph chart
        $lastmonthfive_GoalsCOUNT=$goals->entriesCountData($lastmonthfive,$this->request->getPost('companyid')); // Get data for graph chart
        $goalsCounts_GraphData = array
        (
        array("$currentmonthLABEL","$currentmonth_GoalsCOUNT"),
        array("$lastmonthoneLABEL","$lastmonthone_GoalsCOUNT"),
        array("$lastmonthtwoLABEL","$lastmonthtwo_GoalsCOUNT"),
        array("$lastmonththreeLABEL","$lastmonththree_GoalsCOUNT"),
        array("$lastmonthfourLABEL","$lastmonthfour_GoalsCOUNT"),
        array("$lastmonthfiveLABEL","$lastmonthfive_GoalsCOUNT")
        );

        //Goals Statistics Counts
        $completed_GoalsCOUNT=$goals->entriesStatisticsCountDataByStatus("completed",$this->request->getPost('companyid')); // Get data for pie-chart graph
        $failed_GoalsCOUNT=$goals->entriesStatisticsCountDataByStatus("failed",$this->request->getPost('companyid')); // Get data for pie-chart graph
        $pending_GoalsCOUNT=$goals->entriesStatisticsCountDataByStatus("pending",$this->request->getPost('companyid')); // Get data for pie-chart graph
        $financials_GoalsCOUNT=$goals->entriesStatisticsCountDataByType("financials",$this->request->getPost('companyid')); // Get data for pie-chart graph
        $customers_GoalsCOUNT=$goals->entriesStatisticsCountDataByType("customers",$this->request->getPost('companyid')); // Get data for pie-chart graph
        $internalprocesses_GoalsCOUNT=$goals->entriesStatisticsCountDataByType("internalprocesses",$this->request->getPost('companyid')); // Get data for pie-chart graph
        $learninggrowth_GoalsCOUNT=$goals->entriesStatisticsCountDataByType("learninggrowth",$this->request->getPost('companyid')); // Get data for pie-chart graph
        $goalsStatusStatisticsData = array
        (
        array("Completed","$completed_GoalsCOUNT"),
        array("Failed","$failed_GoalsCOUNT"),
        array("Pending","$pending_GoalsCOUNT")
        );
        $goalsTypeStatisticsData = array
        (
        array("Financials","$financials_GoalsCOUNT"),
        array("Customers","$customers_GoalsCOUNT"),
        array("Internal Processes","$internalprocesses_GoalsCOUNT"),
        array("Learning Growth","$learninggrowth_GoalsCOUNT")
        );
        echo json_encode(array("status"=>"success","username"=>"$username","totalgoalscompleted"=>"$totalgoalscompleted","totalgoalspending"=>"$totalgoalspending","financialsgoalsresult"=>"$financialsgoalsresult","customersgoalsresult"=>"$customersgoalsresult","internalprocessesgoalsresult"=>"$internalprocessesgoalsresult","learninggrowthgoalsresult"=>"$learninggrowthgoalsresult","totalstaffs"=>"$totalstaffs","totalgoals"=>"$totalgoals","totalreferred"=>"$totalreferred","goalsgraphdata"=>$goalsCounts_GraphData,"goalsstatisticsgraphdata"=>$goalsStatusStatisticsData,"goalstypestatisticsgraphdata"=>$goalsTypeStatisticsData));
    }

    public function companydetailsAction()
    {
        /** Init Block **/
        $authService = new AuthService();
        $user = new Users();
        $company = new Companies();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic
        $itemList = array();
        $entryData=$company->singleCompany($this->request->getPost('companyid')); // Get User data from the Database
        $itemList['id']=$entryData->id;
        $itemList['companyid']=$entryData->id;
        $itemList['companyname']=$entryData->companyname;
        $itemList['companylogo']=$this->getDi()->getShared('siteurl').'/'.$entryData->photo;
        $itemList['companyindustry']=$entryData->companyindustry;
        $itemList['companyaddress']=$entryData->companyaddress;
        $itemList['companycity']=$entryData->companycity;
        $itemList['companystate']=$entryData->companystate;
        $itemList['companycountry']=$entryData->companycountry;
        $itemList['companywebsite']=$entryData->companywebsite;
        $itemList['companyemail']=$entryData->email;
        $itemList['companyphone']=$entryData->phone;
        $itemList['companyemployeescount']=$entryData->companyemployeescount;
        $itemList['date']=$entryData->date;
        echo json_encode($itemList);    
    }
    
    public function companyupdateAction()
    {
        /** Init Block **/
        $authService = new AuthService();
        $user = new Users();
        $company = new Companies();
        $data = [];

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic
        if($this->request->getPost('companyname')){ //companyname change check
            $data['companyname'] = $this->request->getPost('companyname');
            if (is_string($data['companyname'])) {
                $company->updateCompany($this->request->getPost('companyid'), $this->request->getPost('companyname'), "companyname"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Company name must be a string"));
            }
        }

        if($this->request->getPost('companyindustry')){ //companyindustry change check
            $data['companyindustry'] = $this->request->getPost('companyindustry');
            if (is_string($data['companyindustry'])) {
                $company->updateCompany($this->request->getPost('companyid'), $this->request->getPost('companyindustry'), "companyindustry"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"companyindustry must be a string"));
            }
        }

        if($this->request->getPost('companyphone')){ //companyphone change check
            $data['companyphone'] = $this->request->getPost('companyphone');
            if (preg_match('/^[0-9_-]{3,16}$/', $data['companyphone'])) {
                $company->updateCompany($this->request->getPost('companyid'), "companyphone"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"companyphone must be numbers only"));
            }
        }

        if($this->request->getPost('companyaddress')){ //companyaddress change check
            $data['companyaddress'] = $this->request->getPost('companyaddress');
            if (is_string($data['companyaddress'])) {
                $company->updateCompany($this->request->getPost('companyid'), "companyaddress"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"companyaddress must be a string"));
            }
        }

        if($this->request->getPost('companycity')){ //companycity change check
            $data['companycity'] = $this->request->getPost('companycity');
            if (is_string($data['companycity'])) {
                $company->updateCompany($this->request->getPost('companyid'), $this->request->getPost('companycity'), "companycity"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"companycity must be a string"));
            }
        }

        if($this->request->getPost('companystate')){ //companystate change check
            $data['companystate'] = $this->request->getPost('companystate');
            if (is_string($data['companystate'])) {
                $company->updateCompany($this->request->getPost('companyid'), $this->request->getPost('companystate'), "companystate"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"companystate must be a string"));
            }
        }

        if($this->request->getPost('companycountry')){ //companycountry change check
            $data['companycountry'] = $this->request->getPost('companycountry');
            if (is_string($data['companycountry'])) {
                $company->updateCompany($this->request->getPost('companyid'), $this->request->getPost('companycountry'), "companycountry"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"companycountry must be a string"));
            }
        }

        if($this->request->getPost('companywebsite')){ //companywebsite change check
            $data['companywebsite'] = $this->request->getPost('companywebsite');
            if (is_string($data['companywebsite'])) {
                $company->updateCompany($this->request->getPost('companyid'), $this->request->getPost('companywebsite'), "companywebsite"); //Update User account details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Postal/Zip code must be a string"));
            }
        }

        if($this->request->hasFiles() == true){ //Photo change check
            $extIMG = array(
                'image/jpeg',
                'image/png',
                'image/gif',
            );
            foreach( $this->request->getUploadedFiles() as $file)
            {              
                // is it a valid extension?
                if ( in_array($file->getType() , $extIMG) && $file->getError() == 0 )
                {
                    $Name          = preg_replace("/[^A-Za-z0-9.]/", '-', $file->getName() );
                    $FileName      = "files/" . $Name;
                    $FileExtension = $file->getExtension();
                    if(!$file->moveTo($FileName)) { // move file to needed path";
                        return json_encode(array("status"=>"failed","message"=>"Error uploading photo"));
                    } else {
                        $company->updateCompany($this->request->getPost('companyid'), $FileName, "companyphoto"); //Update User account details changes
                    }
                } else {
                    return json_encode(array("status"=>"failed","message"=>"Photo must be either JPEG or PNG or GIF file format"));
                }
            }
        }
        
        echo json_encode(array("status"=>"success","message"=>"Company updated successfully"));
    }


    public function removecompanyAction($companyid)
    {
        /** Init Block **/
        $authService = new AuthService();
        $company = new Companies();
        $user = new Users();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "admin"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic 
        $company->removeCompany($this->request->getPost('userid'), $companyid); //Remove
        echo json_encode(array("status"=>"success","message"=>"Company removed successfully"));
    }

    public function allAction()
    {
        /** Init Block **/
        $authService = new AuthService();
        $user = new Users();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "admin"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic
        $itemLists = array();
        $itemList = array();
        $resultData=$user->allUsers(); // Get User data from the Database
        foreach($resultData as $userData) {
            $itemList['userid']=$userData->id;
            $itemList['username']=$userData->username;
            $itemList['firstname']=$userData->firstname;
            $itemList['lastname']=$userData->lastname;
            $itemList['userimage']=$this->getDi()->getShared('siteurl').'/'.$userData->photo;
            $itemList['useremail']=$userData->email;
            $itemList['userphone']=$userData->phone;
            $itemList['position']=$userData->position;
            $itemList['linkedinprofile']=$userData->linkedinprofile;
            $itemList['address']=$userData->address;
            $itemList['city']=$userData->city;
            $itemList['state']=$userData->state;
            $itemList['country']=$userData->country;
            $itemList['referralcode']=$userData->referralcode;
            $itemList['referrercode']=$userData->referrercode;
            $itemList['lastlogindate']=$userData->lastlogindate;
            $itemLists[] = $itemList;
        }
        echo json_encode($itemLists);     
    }

    public function companystaffsAction($level="all")
    {
        /** Init Block **/
        $authService = new AuthService();
        $user = new Users();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic
        $itemLists = array();
        $itemList = array();
        if($level="all"){
            $resultData=$user->companyUsers($this->request->getPost('companyid')); // Get User data from the Database
        } else {
            $resultData=$user->companyUsersLevels($this->request->getPost('companyid'),$level); // Get User data from the Database
        }
        foreach($resultData as $userData) {
            $itemList['id']=$userData->id;
            $itemList['userid']=$userData->id;
            $itemList['staffid']=$userData->staffid;
            $itemList['username']=$userData->username;
            $itemList['firstname']=$userData->firstname;
            $itemList['lastname']=$userData->lastname;
            $itemList['userimage']=$this->getDi()->getShared('siteurl').'/'.$userData->photo;
            $itemList['useremail']=$userData->email;
            $itemList['userphone']=$userData->phone;
            $itemList['position']=$userData->position;
            $itemList['level']=$userData->level;
            $itemList['group']=$userData->group;
            $itemList['linkedinprofile']=$userData->linkedinprofile;
            $itemList['address']=$userData->address;
            $itemList['city']=$userData->city;
            $itemList['state']=$userData->state;
            $itemList['country']=$userData->country;
            $itemList['referralcode']=$userData->referralcode;
            $itemList['referrercode']=$userData->referrercode;
            $itemList['lastlogindate']=$userData->lastlogindate;
            $itemLists[] = $itemList;
        }
        echo json_encode($itemLists); 
    }

    public function companygroupmembersAction($level,$group)
    {
        /** Init Block **/
        $authService = new AuthService();
        $user = new Users();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic
        $itemLists = array();
        $itemList = array();
        $resultData=$user->companyGroupMembers($this->request->getPost('companyid'),$level,$group); // Get User data from the Database
        foreach($resultData as $userData) {
            $itemList['userid']=$userData->id;
            $itemList['username']=$userData->username;
            $itemList['firstname']=$userData->firstname;
            $itemList['lastname']=$userData->lastname;
            $itemList['userimage']=$this->getDi()->getShared('siteurl').'/'.$userData->photo;
            $itemList['useremail']=$userData->email;
            $itemList['userphone']=$userData->phone;
            $itemList['position']=$userData->position;
            $itemList['level']=$userData->level;
            $itemList['group']=$userData->group;
            $itemList['linkedinprofile']=$userData->linkedinprofile;
            $itemList['address']=$userData->address;
            $itemList['city']=$userData->city;
            $itemList['state']=$userData->state;
            $itemList['country']=$userData->country;
            $itemList['referralcode']=$userData->referralcode;
            $itemList['referrercode']=$userData->referrercode;
            $itemList['lastlogindate']=$userData->lastlogindate;
            $itemLists[] = $itemList;
        }
        echo json_encode($itemLists); 
    }

    public function notificationsAction($type="all")
    {
        /** Init Block **/
        $authService = new AuthService();
        $user = new Users();
        $notifications = new Notifications();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic
        $itemLists = array();
        $itemList = array();
        if($type=="all"){
            $resultData=$notifications->allEntriesByUser($this->request->getPost('userid')); // Get data from the Database
        } else {
            $resultData=$notifications->allEntriesTypeByUser($this->request->getPost('userid'),$type); // Get User data from the Database
        }
        foreach($resultData as $userData) {
            $itemList['userid']=$userData->id;
            $itemList['username']=$userData->username;
            $itemList['title']=$userData->title;
            $itemList['details']=$userData->details;
            $itemList['fromid']=$userData->fromid;
            $itemList['from']=$userData->from;
            $itemList['type']=$userData->type;
            $itemList['status']=$userData->status;
            $itemList['time']=$userData->time;
            $itemList['date']=$userData->date;
            $itemLists[] = $itemList;
        }
        echo json_encode($itemLists); 
    }

    public function addnotificationAction($type="all")
    {
        /** Init Block **/
        $authService = new AuthService();
        $user = new Users();
        $notifications = new Notifications();
        $errors = [];
        $data = [];

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic
        //User data
        $data['userid'] = $this->request->getPost('userid');
        $data['username'] = $this->request->getPost('username');

        //title
        $data['title'] = $this->request->getPost('title');
        if (!is_string($data['title'])) {
            $errors['title'] = 'Title expected';
        }

        //details
        $data['details'] = $this->request->getPost('details');
        if (!is_string($data['details'])) {
            $errors['details'] = 'Details expected';
        }

        //type
        $data['details'] = $type;

        //status
        $data['status'] = "unread";

        //from
        $data['fromid'] = "";
        $data['from'] = "";

        //Get current date and time
        $data['time'] = date("h:i:sa");
        $data['date'] = date("d-m-Y");

        //Add to Database
        $notifications->addEntry($data);
        echo json_encode(array("status"=>"success","message"=>"Emergency added successful"));
    }

    public function updatenotificationsAction()
    {
        /** Init Block **/
        $authService = new AuthService();
        $user = new Users();
        $notifications = new Notifications();
        $errors = [];
        $data = [];

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic
        $notifications->updateEntryReadByUser($this->request->getPost('userid')); //Update details changes
        echo json_encode(array("status"=>"success","message"=>"Notifications updated successfully"));
    }

    public function referrersAction()
    {
        /** Init Block **/
        $authService = new AuthService();
        $user = new Users();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "admin"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic
        $itemLists = array();
        $itemList = array();
        $resultData=$user->allReferrers(); // Get User data from the Database
        foreach($resultData as $userData) {
            $itemList['userid']=$userData->id;
            $itemList['username']=$userData->username;
            $itemList['firstname']=$userData->firstname;
            $itemList['lastname']=$userData->lastname;
            $itemList['userimage']=$this->getDi()->getShared('siteurl').'/'.$userData->photo;
            $itemList['useremail']=$userData->email;
            $itemList['userphone']=$userData->phone;
            $itemList['accounttype']=$userData->type;
            $itemList['address']=$userData->address;
            $itemList['city']=$userData->city;
            $itemList['state']=$userData->state;
            $itemList['country']=$userData->country;
            $itemList['postalzipcode']=$userData->postalzipcode;
            $itemList['position']=$userData->position;
            $itemList['linkedinprofile']=$userData->linkedinprofile;
            $itemList['referralcode']=$userData->referralcode;
            $itemList['referrercode']=$userData->referrercode;
            $itemList['lastlogindate']=$userData->lastlogindate;
            $itemLists[] = $itemList;
        }
        echo json_encode($itemLists);     
    }

    public function referralsAction()
    {
        /** Init Block **/
        $authService = new AuthService();
        $user = new Users();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic
        $itemLists = array();
        $itemList = array();
        $userData=$user->singleUser($this->request->getPost('userid')); // Get User data from the Database
        $referralcode=$userData->referralcode;
        $referrercode=$userData->referrercode;
        $resultData=$user->referredUsers($referralcode); // Get User data from the Database
        foreach($resultData as $userData) {
            $itemList['id']=$userData->id;
            $itemList['userid']=$userData->id;
            $itemList['type']=$userData->type;
            $itemList['username']=$userData->username;
            $itemList['firstname']=$userData->firstname;
            $itemList['lastname']=$userData->lastname;
            $itemList['userimage']=$this->getDi()->getShared('siteurl').'/'.$userData->photo;
            $itemList['useremail']=$userData->email;
            $itemList['userphone']=$userData->phone;
            $itemList['accounttype']=$userData->type;
            $itemList['address']=$userData->address;
            $itemList['city']=$userData->city;
            $itemList['state']=$userData->state;
            $itemList['country']=$userData->country;
            $itemList['postalzipcode']=$userData->postalzipcode;
            $itemList['position']=$userData->position;
            $itemList['linkedinprofile']=$userData->linkedinprofile;
            $itemList['referralcode']=$userData->referralcode;
            $itemList['referrercode']=$userData->referrercode;
            $itemList['lastlogindate']=$userData->lastlogindate;
            $itemLists[] = $itemList;
        }
        echo json_encode($itemLists); 
    }

    public function profileAction($userid)
    {
        /** Init Block **/
        $authService = new AuthService();
        $user = new Users();
        $goal = new Goals();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 
        
        //Passed the User Auth Check, Proceed with the Business Logic
        $itemList = array();
        $userData=$user->singleCompanyUser($this->request->getPost('companyid'),$userid); // Get User data from the Database
        $itemList['id']=$userData->id;
        $itemList['userid']=$userData->id;
        $itemList['staffid']=$userData->staffid;
        $itemList['type']=$userData->type;
        $itemList['username']=$userData->username;
        $itemList['firstname']=$userData->firstname;
        $itemList['lastname']=$userData->lastname;
        $itemList['userimage']=$this->getDi()->getShared('siteurl').'/'.$userData->photo;
        $itemList['email']=$userData->email;
        $itemList['phone']=$userData->phone;
        $itemList['accounttype']=$userData->type;
        $itemList['address']=$userData->address;
        $itemList['city']=$userData->city;
        $itemList['state']=$userData->state;
        $itemList['country']=$userData->country;
        $itemList['postalzipcode']=$userData->postalzipcode;
        $itemList['position']=$userData->position;
        $itemList['linkedinprofile']=$userData->linkedinprofile;
        $itemList['level']=$userData->level;
        $itemList['group']=$userData->group;
        $itemList['referralcode']=$userData->referralcode;
        $itemList['referrercode']=$userData->referrercode;
        $itemList['lastlogindate']=$userData->lastlogindate;
        $itemList['date']=$userData->date;
        echo json_encode($itemList); 
    }

    public function singlerecordAction($userid)
    {
        /** Init Block **/
        $authService = new AuthService();
        $user = new Users();
        $goal = new Goals();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "admin"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 
        
        //Passed the User Auth Check, Proceed with the Business Logic
        $itemList = array();
        $userData=$user->singleUser($userid); // Get User data from the Database
        $itemList['id']=$userData->id;
        $itemList['userid']=$userData->id;
        $itemList['type']=$userData->type;
        $itemList['username']=$userData->username;
        $itemList['firstname']=$userData->firstname;
        $itemList['lastname']=$userData->lastname;
        $itemList['userimage']=$this->getDi()->getShared('siteurl').'/'.$userData->photo;
        $itemList['useremail']=$userData->email;
        $itemList['userphone']=$userData->phone;
        $itemList['accounttype']=$userData->type;
        $itemList['address']=$userData->address;
        $itemList['city']=$userData->city;
        $itemList['state']=$userData->state;
        $itemList['country']=$userData->country;
        $itemList['postalzipcode']=$userData->postalzipcode;
        $itemList['position']=$userData->position;
        $itemList['linkedinprofile']=$userData->linkedinprofile;
        $itemList['referralcode']=$userData->referralcode;
        $itemList['referrercode']=$userData->referrercode;
        $itemList['lastlogindate']=$userData->lastlogindate;
        echo json_encode($itemList); 
    }

    public function companystructuresAction($level)
    {
        /** Init Block **/
        $authService = new AuthService();
        $companystructure = new Companystructure();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Logic
        $itemLists = array();
        $itemList = array();
        $itemSubLists = array();
        $itemSubList = array();
        $resultData=$companystructure->filterCategories($this->request->getPost('companyid'),$level); // Get level categories data from the Database
        foreach($resultData as $categoryData) {
            $itemList['id']=$categoryData->id;            
            $itemList['parentlevel']=$categoryData->parentlevel;
            $itemList['categoryid']=$categoryData->categoryid;            
            $itemList['category']=$categoryData->category;
            $itemList['title']=$categoryData->title;
            $itemList['level']=$categoryData->level;
            $itemList['details']=$categoryData->details;
            $itemList['date']=$categoryData->date;
            $category=$categoryData->category;
              //SubCategories
              $subResultData=$companystructure->filterSubcategories($this->request->getPost('companyid'),$level,$category); // Get type subcategories data from the Database
              foreach($subResultData as $subcategoryData) {
                $itemSubList['parentlevel']=$subcategoryData->parentlevel;
                $itemSubList['subcategoryid']=$subcategoryData->id;            
                $itemSubList['title']=$subcategoryData->title;
                $itemSubList['level']=$subcategoryData->level;
                $itemSubList['details']=$subcategoryData->details;
                $itemSubList['category']=$subcategoryData->category;
                $itemSubList['subcategorydate']=$subcategoryData->date;
                $itemSubLists[] = $itemSubList;
              }
            $itemList['subcategories']=$itemSubLists;
            $itemSubLists=[]; $itemSubList=[]; //Clear Sub Vars
            $itemLists[] = $itemList;
        }
        echo json_encode($itemLists); 
    }

    public function companysubstructuresAction($level,$category)
    {
        /** Init Block **/
        $authService = new AuthService();
        $companystructure = new Companystructure();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Logic
        $itemLists = array();
        $itemList = array();
        $resultData=$companystructure->filterSubcategories($this->request->getPost('companyid'),$level,$category); // Get level categories data from the Database
        foreach($resultData as $categoryData) {
            $itemList['id']=$categoryData->id;            
            $itemList['parentlevel']=$categoryData->parentlevel;
            $itemList['categoryid']=$categoryData->categoryid;            
            $itemList['category']=$categoryData->category;
            $itemList['title']=$categoryData->title;
            $itemList['level']=$categoryData->level;
            $itemList['details']=$categoryData->details;
            $itemList['date']=$categoryData->date;
            $itemLists[] = $itemList;
        }
        echo json_encode($itemLists); 
    }

    public function companyorganogramAction()
    {
        /** Init Block **/
        $authService = new AuthService();
        $companystructure = new Companystructure();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Logic
        $itemLists = array();
        $itemList = array();
        $itemSubListsOne = array();
        $itemSubListOne = array();
        $itemSubListsTwo = array();
        $itemSubListTwo = array();
        $itemSubListsThree = array();
        $itemSubListThree = array();
        $resultData=$companystructure->filterCategories($this->request->getPost('companyid'),'corporate'); // Get level categories data from the Database
        foreach($resultData as $categoryData) {
            $itemList['id']=$categoryData->id;            
            $itemList['parentlevel']=$categoryData->parentlevel;
            $itemList['categoryid']=$categoryData->categoryid;            
            $itemList['category']=$categoryData->category;
            $itemList['title']=$categoryData->title;
            $itemList['level']=$categoryData->level;
            $itemList['details']=$categoryData->details;
            $itemList['date']=$categoryData->date;
            $category=$categoryData->category;
            /**SubCategoriesZero
              $subResultData=$companystructure->filterSubLevel($this->request->getPost('companyid'),'divisions','corporate'); // Get type subcategories data from the Database
              foreach($subResultData as $subcategoryData) {
                $itemSubListZero['id']=$subcategoryData->id;
                $itemSubListZero['parentlevel']=$subcategoryData->parentlevel;
                $itemSubListZero['subcategoryid']=$subcategoryData->id;            
                $itemSubListZero['title']=$subcategoryData->title;
                $itemSubListZero['level']=$subcategoryData->level;
                $itemSubListZero['details']=$subcategoryData->details;
                $itemSubListZero['category']=$subcategoryData->category;
                $itemSubListZero['subcategorydate']=$subcategoryData->date;
                $itemSubListsZero[] = $itemSubListZero;
              }
            $itemList['substructureszero']=$itemSubListsZero;**/
            //SubCategoriesOne
              $subResultData=$companystructure->getSubcategories($this->request->getPost('companyid'),'departments'); // Get type subcategories data from the Database
              foreach($subResultData as $subcategoryData) {
                $itemSubListOne['id']=$subcategoryData->id;
                $itemSubListOne['parentlevel']=$subcategoryData->parentlevel;
                $itemSubListOne['subcategoryid']=$subcategoryData->id;            
                $itemSubListOne['title']=$subcategoryData->title;
                $itemSubListOne['level']=$subcategoryData->level;
                $itemSubListOne['details']=$subcategoryData->details;
                $itemSubListOne['category']=$subcategoryData->category;
                $itemSubListOne['subcategorydate']=$subcategoryData->date;
                $itemSubListsOne[] = $itemSubListOne;
              }
            $itemList['substructuresone']=$itemSubListsOne;
            //SubCategoriesTwo
              $subResultData=$companystructure->getSubcategories($this->request->getPost('companyid'),'units'); // Get type subcategories data from the Database
              foreach($subResultData as $subcategoryData) {
                $itemSubListTwo['id']=$subcategoryData->id;
                $itemSubListTwo['parentlevel']=$subcategoryData->parentlevel;
                $itemSubListTwo['subcategoryid']=$subcategoryData->id;            
                $itemSubListTwo['title']=$subcategoryData->title;
                $itemSubListTwo['level']=$subcategoryData->level;
                $itemSubListTwo['details']=$subcategoryData->details;
                $itemSubListTwo['category']=$subcategoryData->category;
                $itemSubListTwo['subcategorydate']=$subcategoryData->date;
                $itemSubListsTwo[] = $itemSubListTwo;
              }
            $itemList['substructurestwo']=$itemSubListsTwo;
            //SubCategoriesThree
              $subResultData=$companystructure->getSubcategories($this->request->getPost('companyid'),'teams'); // Get type subcategories data from the Database
              foreach($subResultData as $subcategoryData) {
                $itemSubListThree['id']=$subcategoryData->id;
                $itemSubListThree['parentlevel']=$subcategoryData->parentlevel;
                $itemSubListThree['subcategoryid']=$subcategoryData->id;            
                $itemSubListThree['title']=$subcategoryData->title;
                $itemSubListThree['level']=$subcategoryData->level;
                $itemSubListThree['details']=$subcategoryData->details;
                $itemSubListThree['category']=$subcategoryData->category;
                $itemSubListThree['subcategorydate']=$subcategoryData->date;
                $itemSubListsThree[] = $itemSubListThree;
              }
            $itemList['substructuresthree']=$itemSubListsThree;
            $itemLists[] = $itemList;
        }
        echo json_encode($itemLists); 
    }

    public function companystructureAction($structureid)
    {
        /** Init Block **/
        $authService = new AuthService();
        $companystructure = new Companystructure();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic
        $itemList = array();
        $resultData=$companystructure->singleCategory($this->request->getPost('companyid'),$structureid); // Get User data from the Database
        $itemList['id']=$resultData->id;            
        $itemList['parentlevel']=$resultData->parentlevel;
        $itemList['categoryid']=$resultData->categoryid;            
        $itemList['category']=$resultData->category;
        $itemList['title']=$resultData->title;
        $itemList['level']=$resultData->level;
        $itemList['details']=$resultData->details;
        $itemList['date']=$resultData->date;
        echo json_encode($itemList); 
    }

    public function addcompanystructureAction()
    {
        /** Init Block **/
        $authService = new AuthService();
        $generalService = new GeneralService();
        $errors = [];
        $data = [];
        $user = new Users();
        $companystructure = new Companystructure();

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

        //level
        $data['level'] = $this->request->getPost('level');
        if (!is_string($data['level'])) {
            $errors['level'] = 'Level expected';
        }

        //parentlevel
        $data['parentlevel'] = $this->request->getPost('parentlevel');
        if (!is_string($data['parentlevel'])) {
            $errors['parentlevel'] = 'Parent level expected';
        }

        //category
        $data['categoryid'] = $this->request->getPost('parentcategoryid');
        $data['category'] = $this->request->getPost('parentcategory');

        //details
        $data['details'] = $this->request->getPost('details');
        if (!is_string($data['details'])) {
            $errors['details'] = 'Details expected';
        }

        //Get current date and time
        $data['date'] = date("d-m-Y");
        $data['time'] = date('h:i A');

        //Error form handling check and Submit Data
        if ($errors) {
            return json_encode(array("status"=>"failed","message"=>implode( ", ", $errors )));
        } 

        // Store to Database Model and check for errors
        $companystructure->addCategory($data);
        echo json_encode(array("status"=>"success","message"=>"Company structure added successfully"));
    }
    
    public function updatecompanystructureAction()
    {
        /** Init Block **/
        $authService = new AuthService();
        $generalService = new GeneralService();
        $errors = [];
        $data = [];
        $user = new Users();
        $companystructure = new Companystructure();

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

        //Get Old Structure Data
        $resultData=$companystructure->singleCategory($this->request->getPost('companyid'),$this->request->getPost('structureid')); // Get User data from the Database
        $oldtitle=$resultData->title;
        
        //Update title
        if($this->request->getPost('title')){ //title change check
            $data['title'] = $this->request->getPost('title');
            if (is_string($data['title'])) {
                $companystructure->updateCategory($this->request->getPost('companyid'), $this->request->getPost('structureid'), $this->request->getPost('title'), "title"); //Update details changes
                $user->updateUserAccount($this->request->getPost('companyid'), $oldtitle, $this->request->getPost('title'), "group"); //Update User account group changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Title must be a string"));
            }
        }

        //Update details
        if($this->request->getPost('details')){ //details change check
            $data['details'] = $this->request->getPost('details');
            if (is_string($data['details'])) {
                $companystructure->updateCategory($this->request->getPost('companyid'), $this->request->getPost('structureid'), $this->request->getPost('details'), "details"); //Update details changes
            } else {
                return json_encode(array("status"=>"failed","message"=>"Details must be a string"));
            }
        }

        echo json_encode(array("status"=>"success","message"=>"Structure updated successfully"));
    }

    public function removestructureAction($itemid)
    {
        /** Init Block **/
        $authService = new AuthService();
        $company = new Companies();
        $user = new Users();
        $companystructure = new Companystructure();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic 
        $companystructure->removeCategory($this->request->getPost('companyid'), $itemid); //Remove
        echo json_encode(array("status"=>"success","message"=>"Structure removed successfully"));
    }

    public function removeaccountAction($userid)
    {
        /** Init Block **/
        $authService = new AuthService();
        $user = new Users();

        //Auth Check
        $authCheckResult=$authService->UserAuth($this->request->getPost('userid'), $this->request->getPost('userlogintoken'), "user"); 
        if(!$authCheckResult) { 
            return json_encode(array("status"=>"failed","message"=>"Access denied. Invalid auth credentials!")); 
        } 

        //Passed the User Auth Check, Proceed with the Business Logic
        $user->removeUser($this->request->getPost('companyid'),$userid); //Delete User account
        echo json_encode(array("status"=>"success","message"=>"Account deleted successfully"));
    }
}
?>
