<?php  
//Manual Model and not auto generated Model :)
use Phalcon\DI;
use Phalcon\Mvc\Model;  
use Phalcon\Mvc\Model\Manager;
use Phalcon\Mvc\Model\Query;

class Goals extends \Phalcon\Mvc\Model {

    public $db; 

    public function initialize()
    {
        $this->db = $this->getDi()->getShared('db');
    }
    
    public function addEntry($data)
    {
        $query = "INSERT INTO goals (companyid, userid, username, title, type, level, target, targetdate, targetscore, result, score, rating, status, kpi, details, time, date) VALUES (:companyid, :userid, :username, :title, :type, :level, :target, :targetdate, :targetscore, :result, :score, :rating, :status, :kpi, :details, :time, :date)";
        $result = $this->db->query($query, [
                        "companyid" => $data['companyid'],
                        "userid" => $data['userid'],
                        "username" => $data['username'],
                        "title" => $data['title'],
                        "type" => $data['type'],
                        "level" => $data['level'],
                        "target" => $data['target'],
                        "targetdate" => $data['targetdate'],
                        "targetscore" => $data['targetscore'],
                        "result" => $data['result'],
                        "score" => $data['score'],
                        "rating" => $data['rating'],
                        "status" => $data['status'],
                        "kpi" => $data['kpi'],
                        "details" => $data['details'],
                        "time" => $data['time'],
                        "date" => $data['date']
                    ]
                  ); 
        return $result->numRows();
    }

    public function updateEntry($postid, $postdata, $tableLabel)
    {
        $query = "UPDATE goals SET $tableLabel=:tableLabelValue WHERE id=:postid";
        $result = $this->db->query($query, [
                      "tableLabelValue" => $postdata,
                      "postid" => $postid
                    ]
                  ); 
        return $result->numRows();
    }

    public function removeEntry($postid)
    {
        $query = "DELETE FROM goals WHERE id=:id";
        $result = $this->db->query($query, ["id" => $postid]);
        return $result->numRows();
    }

    public function allEntries($companyid)
    {
        $query = "SELECT * FROM goals WHERE companyid=:companyid";
        $result = $this->db->query($query, ["companyid" => $companyid]); 
        $result->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $rows = $result->fetchAll();
        return $rows;
    }

    public function allEntriesByType($companyid,$type)
    {
        $query = "SELECT * FROM goals WHERE companyid=:companyid AND type=:type";
        $result = $this->db->query($query, ["companyid" => $companyid,"type" => $type]); 
        $result->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $rows = $result->fetchAll();
        return $rows;
    }

    public function allEntriesByGroup($companyid,$level,$group)
    {
        $query = "SELECT * FROM goals WHERE companyid=:companyid AND `level`=:level AND `target`=:group";
        $result = $this->db->query($query, ["companyid" => $companyid,"level" => $level,"group" => $group]); 
        $result->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $rows = $result->fetchAll();
        return $rows;
    }

    public function allEntriesByAdmin($postid)
    {
        $query = "SELECT * FROM goals";
        $result = $this->db->query($query, []); 
        $result->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $rows = $result->fetchAll();
        return $rows;
    }

    public function singleEntry($companyid,$postid)
    {
        $query = "SELECT * FROM goals WHERE id=:postid AND companyid=:companyid";
        $result = $this->db->query($query, ["postid" => $postid,"companyid" => $companyid]); 
        $result->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $row = $result->fetch();
        return $row;
    }

    public function sumgoals()
    {
        $query = "SELECT * FROM goals";
        $result = $this->db->query($query, []); 
        return $result->numRows();
    }

    public function sumGoalsByCompany($companyid)
    {
        $query = "SELECT * FROM goals WHERE companyid=:companyid";
        $result = $this->db->query($query, ["companyid" => $companyid]); 
        return $result->numRows();
    }

    public function goalResultStatus($companyid,$status)
    {
        $query = "SELECT * FROM goals WHERE companyid=:companyid AND status=:status";
        $result = $this->db->query($query, ["companyid" => $companyid,"status" => $status]); 
        return $result->numRows();
    }

    public function goalResultType($companyid,$type)
    {
        $query = "SELECT COALESCE(SUM(score), 0) AS totalscore FROM goals WHERE companyid=:companyid AND type=:type";
        $result = $this->db->query($query, ["companyid" => $companyid,"type" => $type]); 
        $result->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $row = $result->fetch();
        $data=$row->totalscore;
        return $data;
    }

    public function entriesCountData($monthquery,$companyid)
    {
        $query = "SELECT * FROM goals WHERE date like '%$monthquery' AND companyid=:companyid GROUP BY id";
        $result = $this->db->query($query, ["companyid" => $companyid]); 
        return $result->numRows();
    }

    public function entriesStatisticsCountDataByStatus($status,$companyid)
    {
        $query = "SELECT * FROM goals WHERE status=:status AND companyid=:companyid GROUP BY id";
        $result = $this->db->query($query, ["status" => $status,"companyid" => $companyid]); 
        return $result->numRows();
    }

    public function entriesStatisticsCountDataByType($type,$companyid)
    {
        $query = "SELECT * FROM goals WHERE type=:type AND companyid=:companyid GROUP BY id";
        $result = $this->db->query($query, ["type" => $type,"companyid" => $companyid]); 
        return $result->numRows();
    }
}
?>