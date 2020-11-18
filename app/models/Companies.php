<?php  
//Manual Model and not auto generated Model :)
use Phalcon\DI;
use Phalcon\Mvc\Model;  
use Phalcon\Mvc\Model\Manager;
use Phalcon\Mvc\Model\Query;

class Companies extends \Phalcon\Mvc\Model {

    public $db; 
    public $userid; 
    public $username; 

    public function initialize()
    {
        $this->db = $this->getDi()->getShared('db');
    }
    
    public function checkCompanyExist($data)
    {
        $query = "SELECT * FROM companies WHERE email=:email OR phone=:phone OR companyname=:companyname";
        $result = $this->db->query($query, [
                        "companyname" => $data['companyname'],
                        "email" => $data['companyemail'],
                        "phone" => $data['companyphone']
                    ]
                  ); 
        return $result->numRows();
    }
    
    public function addCompany($data)
    {
        $query = "INSERT INTO companies (companyname, companyindustry, email, phone, companyaddress, companycity, companystate, companycountry, companywebsite, companyemployeescount, photo, referrercode, referralcode, verified, verificationcode, type, date) VALUES (:companyname, :companyindustry, :email, :phone, :companyaddress, :companycity, :companystate, :companycountry, :companywebsite, :companyemployeescount, :photo, :referrercode, :referralcode, 'no', :verificationcode, :type, :date)";
        $result = $this->db->query($query, [
                        "companyname" => $data['companyname'],
                        "companyindustry" => $data['companyindustry'],
                        "email" => $data['email'],
                        "phone" => $data['phone'],
                        "companyaddress" => $data['companyaddress'],
                        "companycity" => $data['companycity'],
                        "companystate" => $data['companystate'],
                        "companycountry" => $data['companycountry'],
                        "companywebsite" => $data['companywebsite'],
                        "companyemployeescount" => $data['companyemployeescount'],
                        "photo" => $data['companylogo'],
                        "referrercode" => $data['referrercode'],
                        "referralcode" => $data['referralcode'],
                        "verificationcode" => $data['verificationcode'],
                        "type" => $data['type'],
                        "date" => $data['date']
                    ]
                  ); 
        return $this->db->lastInsertId();
    }
    
    public function singleCompany($companyid)
    {
        $query = "SELECT * FROM companies WHERE id=:companyid OR companycode=:companyid";
        $result = $this->db->query($query, ["companyid" => $companyid]); 
        $result->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $row = $result->fetch();
        return $row;
    }

    public function updateCompanyUser($companyid, $userid, $username)
    {
        $query = "UPDATE companies SET userid=:userid, username=:username WHERE id=:companyid";
        $result = $this->db->query($query, [
                      "userid" => $userid,
                      "username" => $username,
                      "companyid" => $companyid
                    ]
                  ); 
        return $result->numRows();
    }

    public function removeCompany($companyid)
    {
        $query = "DELETE FROM companies WHERE id=:id";
        $result = $this->db->query($query, [
                      "id" => $companyid
                    ]
                  );
        return $result->numRows();
    }
}
?>