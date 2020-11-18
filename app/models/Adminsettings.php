<?php  
//Manual Model and not auto generated Model :)
use Phalcon\DI;
use Phalcon\Mvc\Model;  
use Phalcon\Mvc\Model\Manager;
use Phalcon\Mvc\Model\Query;

class Adminsettings extends \Phalcon\Mvc\Model {

    public $db; 

    public function initialize()
    {
        $this->db = $this->getDi()->getShared('db');
    }

    public function updateEntry($postid, $postdata, $tableLabel)
    {
        $query = "UPDATE adminsettings SET $tableLabel=:tableLabelValue WHERE id=:postid";
        $result = $this->db->query($query, [
                      "tableLabelValue" => $postdata,
                      "postid" => $postid
                    ]
                  ); 
        return $result->numRows();
    }

    public function allEntries()
    {
        $query = "SELECT * FROM adminsettings";
        $result = $this->db->query($query, []); 
        $result->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $rows = $result->fetchAll();
        return $rows;
    }

    public function singleEntry($postid)
    {
        $query = "SELECT * FROM adminsettings WHERE id=:id";
        $result = $this->db->query($query, ["id" => $postid]);  
        $result->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $row = $result->fetch();
        return $row;
    }
}
?>