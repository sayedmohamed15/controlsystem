<?php
/*
 * DB Class
 * This class is used for database related (connect, insert, update, and delete) operations with PHP Data Objects (PDO)
 */
class Database{

    private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "";
    private $dbName     = "controlsystem";
    public $lastInsertId;

    public function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            try{
                $conn = new PDO("mysql:host=".$this->dbHost.";dbname=".$this->dbName, $this->dbUsername, $this->dbPassword);
                $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->db = $conn;
            }catch(PDOException $e){
                die("Failed to connect with MySQL: " . $e->getMessage());
            }
        }
    }
    /*
     * Returns rows from the database based on the conditions
     * @param string name of the table
     * @param array select, where, order_by, limit and return_type conditions
     */
    public function getRows($table,$conditions = array()){
        $sql = 'SELECT ';
        $sql .= array_key_exists("select",$conditions)?$conditions['select']:'*';
        // echo $sql;
        $sql .= ' FROM '.$table;
        if(array_key_exists("where",$conditions)){
            $sql .= ' WHERE ';
            $i = 0;
            foreach($conditions['where'] as $key => $value){
                $pre = ($i > 0)?' AND ':'';

                $val  = (is_array($value)) ? reset($value) : $value ;
                $sign = (is_array($value)) ? key($value) : ' = ' ;
                // echo '<br>'.$val."string".$sign.'<br>';

                $sql .= $pre.$key.$sign."'".$val."'";
                $i++;
            }
        }
        // echo $sql;
        if(array_key_exists("group_by",$conditions)){
            $sql .= ' GROUP BY '.$conditions['group_by'];
        }
        if(array_key_exists("order_by",$conditions)){
            $sql .= ' ORDER BY '.$conditions['order_by'];
        }
        if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit'];
        }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['limit'];
        }
        // echo "<br>";
        // echo $sql;
        $query = $this->db->prepare($sql);
        $query->execute();

        if(array_key_exists("return_type",$conditions) && $conditions['return_type'] != 'all'){
            switch($conditions['return_type']){
                case 'count':
                    $data = $query->rowCount();
                    break;
                case 'single':
                    $data = $query->fetch(PDO::FETCH_ASSOC);
                    break;
                default:
                    $data = '';
            }
        }else{
            if($query->rowCount() > 0){
                $data = $query->fetchAll();
            }
        }
        return !empty($data)?$data:false;
    }
    
    /*
     * Insert data into the database
     * @param string name of the table
     * @param array the data for inserting into the table
     */
    public function insert($table,$data){
        if(!empty($data) && is_array($data)){
            $columns = '';
            $values  = '';
            $i = 0;

            $columnString = implode(',', array_keys($data));
            $valueString = ":".implode(',:', array_keys($data));
            $sql = "INSERT INTO ".$table." (".$columnString.") VALUES (".$valueString.")";
            $query = $this->db->prepare($sql);
            foreach($data as $key=>$val){
                 $query->bindValue(':'.$key, $val);
            }
            try{
                $insert = $query->execute();
                $this->lastInsertId = $this->db->lastInsertId();
            }catch(PDOException $e){
                $insert = $e->getMessage();

            }
            return $insert;
        }else{
            return 'false';
        }
    }

    public function lastId(){
        return $this->lastInsertId;
    }
    /*
     * Update data into the database
     * @param string name of the table
     * @param array the data for updating into the table
     * @param array where condition on updating data
     */
    public function update($table,$data,$conditions){
        if(!empty($data) && is_array($data)){
            $colvalSet = '';
            $whereSql = '';
            $i = 0;
            foreach($data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $colvalSet .= $pre.$key."='".$val."'";
                $i++;
            }
            if(!empty($conditions)&& is_array($conditions)){
                $whereSql .= ' WHERE ';
                $i = 0;
                foreach($conditions as $key => $value){
                    $pre = ($i > 0)?' AND ':'';
                    $whereSql .= $pre.$key." = '".$value."'";
                    $i++;
                }
            }
         echo      $sql = "UPDATE ".$table." SET ".$colvalSet.$whereSql;
            $query = $this->db->prepare($sql);
            $update = $query->execute();
            return $update?$query->rowCount():false;
        }else{
            return false;
        }
    }
    /*
     * Delete data from the database
     * @param string name of the table
     * @param array where condition on deleting data
     */
    public function delete($table,$conditions){
        $whereSql = '';
        if(!empty($conditions)&& is_array($conditions)){
            $whereSql .= ' WHERE ';
            $i = 0;
            foreach($conditions as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $whereSql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        $sql = "DELETE FROM ".$table.$whereSql;
        $delete = $this->db->exec($sql);
        return $delete?$delete:false;
    }
    public function getAllFBUsers($users)
    {

        $sql = "SELECT * FROM fb_user WHERE  user_name in  ($users) AND checked='true' ";
        $query = $this->db->prepare($sql);
        $query->execute();
        $data = $query->fetchAll();
        $result = [];
//        echo '<pre>';
//        var_dump($data[0]['img']);
//        exit();
        foreach ($data as   $user) {
            $userId = $user['id'];
            $userName = str_replace(array( '(', ')' ), '',trim(($user['name'])));
            $sql = "SELECT * FROM fb_user WHERE id in (SELECT friends_id FROM `fb_friend_rel` WHERE friend_id=$userId ) ";
            $query = $this->db->prepare($sql);
            $query->execute();
            $userResult= $query->fetchAll();
            $result[$userName]=array($userResult,$data[0]['img']);
        }
        return $result;
    }
    public function getAllTWUsers($users)
    {

        $sql = "SELECT * FROM tw_user WHERE  user_name in  ($users) AND checked='trueTwitter'  ";
        $query = $this->db->prepare($sql);
        $query->execute();
        $data = $query->fetchAll();
        $result = [];
        foreach ($data as   $user) {
            $userId = $user['id'];
            $userName = addslashes(str_replace(array( '(', ')' ), '',trim(($user['name']))));
            $sql = "SELECT * FROM tw_user WHERE id in (SELECT friends_id FROM `tw_friend_rel` WHERE friend_id=$userId ) limit 66";
            $query = $this->db->prepare($sql);
            $query->execute();
            $userResult= $query->fetchAll();
            $result[$userName]=array($userResult,$data);
        }
        return $result;
    }
    public function getlastJobId()
    {

        $sql = "SELECT job_id FROM `selected_users`  ORDER by id DESC limit 1";
        $query = $this->db->prepare($sql);
        $query->execute();
        $data = $query->fetchAll();

        return $data;
    }
    public function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    public function loginLog($user_id,$agent,$ip){
        $sql = "INSERT INTO login_log (`user_id`, `user_agent`, `ip`)
              VALUE (:user_id, :user_agent, :ip)";
        $query = $this->db->prepare($sql);
            $query->bindValue(':user_id', $user_id);
            $query->bindValue(':user_agent', $agent);
            $query->bindValue(':ip', $ip);

        $query->execute();
    }
}
