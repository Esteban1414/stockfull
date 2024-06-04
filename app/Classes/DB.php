<?php

namespace app\classes;

use \PDO;

class db
{
    private $host = '127.0.0.1';
    private $db = 'stockfull';
    private $user = 'Cali';
    private $pass = '1UoaDBLkMgtmm12055vZ*IAJs2SVO*iDSYiD1y856hVDxhbeD%';
    private $charset = 'utf8mb4';
    private $pdo;
    private $error;

    protected $fillable = [];
    protected $values = [];

    public $s = " * ";
    public $c = "";
    public $w = " 1 ";
    public $j = "";
    public $o = "";
    public $g = "";
    public $l = "";


    public function __construct()
    {
        $conn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];

        try {
            $this->pdo = new PDO($conn, $this->user, $this->pass, $options);
        } catch (\PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function select($cc = [])
    {
        if (count($cc) > 0) {
            $this->s = implode(",", $cc);
            return $this;
        }
    }

    public function join($join = "", $on = "")
    {
        if ($join != "" && $on != "") {
            $this->j .= ' JOIN ' . $join . ' ON ' . $on;
        }
        return $this;
    }

    public function joinLeft($join = "", $on = ""){
        if($join != "" && $on != ""){
            $this->j .= ' LEFT JOIN ' . $join . ' ON ' . $on;
        }
        return $this;
    }

    public function where($ww = []){
        $this->w = "";
        if(count($ww) > 0){
            foreach($ww as $where){
                $this->w .= $where[0] . " " . $where[1] . " '" . $where[2] . "' " . ' AND ';
            }
        }
        $this->w .= ' 1 ';            
        $this->w = ' (' . $this->w . ')';            
        return $this;
    }

    public function count($co = "*"){
        $this->c = ",count(" . $co . ") as tt ";
        return $this;
    }

    public function orderBy($ob = [])
    {
        if (count($ob) > 0) {
            foreach ($ob as $orderBy) {

                $this->o .= $orderBy[0] . ' ' . $orderBy[1] . ',';
            }
            $this->o = ' ORDER BY ' . trim($this->o, ',');
        }
        return $this;
    }

    public function groupBy($gb = [])
    {
        if (count($gb) > 0) {
            foreach ($gb as $groupBy) {

                $this->g .= $groupBy[0] . ',';
            }
            $this->g = ' GROUP BY ' . trim($this->g, ',');
        }
        return $this;
    }

    public function limit($l = "")
    {
        if ($l != "") {
            $this->l = ' LIMIT ' . $l;
        }

        return $this;
    }

    public function get()
    {
        try {
            $sql = "SELECT " . $this->s . $this->c . " FROM " . str_replace("app\\models\\","",get_class($this)) .
                ($this->j != "" ? " a " . $this->j : "") .
                " WHERE" .
                $this->w .
                $this->g .
                $this->o .
                $this->l;

            $r = $this->pdo->query($sql);

            $result = [];
            while ($f = $r->fetch(PDO::FETCH_ASSOC)) {
                $result[] = $f;
            }
            return json_encode($result);

        } catch (\PDOException $err) {
            echo json_encode(["r" => 'q']);
        }
    }
    
    public function insert()
    {
        try {
            $sql = "INSERT INTO " . str_replace("app\\models\\", "", get_class($this)) .
                " (" . implode(",", $this->fillable) . ') values (' .
                trim(str_replace("&", "?,", str_pad("", count($this->values), "&")), ",") . ');';

            $stmt = $this->pdo->prepare($sql);
            foreach ($this->values as $v => $value) {
                $stmt->bindValue(($v + 1), $value);
            }
            $stmt->execute();
            return $this->pdo->lastInsertId();
         } catch (\PDOException $e) {
            $this->error = $e->getMessage();
            echo json_encode(["r" => $this->error]);
            return false;
        }
    }

    public function update()
    {
        try {
            $setClause = '';
            foreach ($this->values as $column => $value) {
                $setClause .= $column . '=?, ';
            }
            $setClause = rtrim($setClause, ', ');

            $sql = "UPDATE " . str_replace("app\\models\\", "", get_class($this)) .
                " SET $setClause WHERE " .
                $this->w;

            $stmt = $this->pdo->prepare($sql);

            $i = 1;
            foreach ($this->values as $value) {
                $stmt->bindValue($i++, $value);
            }

            $res = $stmt->execute();
            return $res;
            
        } catch (\PDOException $e) {
            $this->error = $e->getMessage();
            echo json_encode(["r" => $this->error]);
            return false;
        }
    }

    public function delete()
    {
        try {
            $sql = "DELETE FROM " . str_replace("app\\models\\", "", get_class($this)) . " WHERE " .
                $this->w;
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
        } catch (\PDOException $e) {
            $this->error = $e->getMessage();
            echo json_encode(["r" => $this->error]);
            return false;
        }
    }
}
