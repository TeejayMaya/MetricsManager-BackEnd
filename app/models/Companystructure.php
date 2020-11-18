<?php  
//Manual Model and not auto generated Model :)
use Phalcon\DI;
use Phalcon\Mvc\Model;  
use Phalcon\Mvc\Model\Manager;
use Phalcon\Mvc\Model\Query;

class Companystructure extends \Phalcon\Mvc\Model {

    public $db; 
    public $productid; 
    public $product; 

    public function initialize()
    {
        $this->db = $this->getDi()->getShared('db');
    }
    
    public function addCategory($data)
    {
        $query = "INSERT INTO companystructure (companyid, userid, username, level, parentlevel, categoryid, category, title, details, date) VALUES (:companyid, :userid, :username, :level, :parentlevel, :categoryid, :category, :title, :details, :date)";
        $result = $this->db->query($query, [
                        "companyid" => $data['companyid'],
                        "userid" => $data['userid'],
                        "username" => $data['username'],
                        "level" => $data['level'],
                        "parentlevel" => $data['parentlevel'],
                        "categoryid" => $data['categoryid'],
                        "category" => $data['category'],
                        "title" => $data['title'],
                        "details" => $data['details'],
                        "date" => $data['date']
                    ]
                  ); 
        return $result->numRows();
    }

    public function singleCategory($companyid,$structureid)
    {
        $query = "SELECT * FROM companystructure WHERE id=:structureid AND companyid=:companyid";
        $result = $this->db->query($query, ["structureid" => $structureid,"companyid" => $companyid]); 
        $result->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $row = $result->fetch();
        return $row;
    }

    public function removeCategory($companyid,$categoryid)
    {
        $query = "DELETE FROM companystructure WHERE id=:id AND companyid=:companyid";
        $result = $this->db->query($query, [
                      "id" => $categoryid,
                      "companyid" => $companyid
                    ]
                  );
        return $result->numRows();
    }

    public function allCategories()
    {
        $query = "SELECT * FROM companystructure";
        $result = $this->db->query($query, []); 
        $result->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $rows = $result->fetchAll();
        return $rows;
    }

    public function filterCategories($companyid,$level)
    {
        $query = "SELECT * FROM companystructure WHERE companyid=:companyid AND level=:level";
        $result = $this->db->query($query, ["companyid" => $companyid,"level" => $level]); 
        $result->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $rows = $result->fetchAll();
        return $rows;
    }

    public function filterSubcategories($companyid,$level,$category)
    {
        $query = "SELECT * FROM companystructure WHERE companyid=:companyid AND parentlevel=:level AND category=:category";
        $result = $this->db->query($query, ["companyid" => $companyid,"level" => $level,"category" => $category]); 
        $result->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $rows = $result->fetchAll();
        return $rows;
    }

    public function filterSubLevel($companyid,$level,$category)
    {
        $query = "SELECT * FROM companystructure WHERE companyid=:companyid AND level=:level AND category=:category";
        $result = $this->db->query($query, ["companyid" => $companyid,"level" => $level,"category" => $category]); 
        $result->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $rows = $result->fetchAll();
        return $rows;
    }

    public function getSubcategories($companyid,$level)
    {
        $query = "SELECT * FROM companystructure WHERE companyid=:companyid AND level=:level";
        $result = $this->db->query($query, ["companyid" => $companyid,"level" => $level]); 
        $result->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $rows = $result->fetchAll();
        return $rows;
    }
    
    public function getCategoryName($id)
    {
        $query = "SELECT title FROM companystructure WHERE id=:id";
        $result = $this->db->query($query, ["id" => $id]); 
        $result->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $row = $result->fetch();
        $data=$row->title;
        return $data;
    }

    public function updateCategory($companyid, $categoryid, $data, $tableLabel)
    {
        $query = "UPDATE companystructure SET $tableLabel=:tableLabelValue WHERE companyid=:companyid AND id=:categoryid";
        $result = $this->db->query($query, [
                      "tableLabelValue" => $data,
                      "categoryid" => $categoryid,
                      "companyid" => $companyid
                    ]
                  ); 
        return $result->numRows();
    }
}
?>