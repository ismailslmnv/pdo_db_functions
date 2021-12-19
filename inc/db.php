<?
/// This class is used to interact with the database
class DB
{

    public function __construct()
    {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    }
    public function setCharSet($charset)
    {
        $this->db->exec("SET NAMES $charset");
        return $this;
    }

    private $q = "";
    public function select()
    {
        $this->q = "SELECT";
        return $this;
    }
    public function insert($table)
    {
        $this->q = "INSERT INTO $table";
        return $this;
    }
    public function update($table)
    {
        $this->q = "UPDATE $table";
        return $this;
    }
    public function delete($table)
    {
        $this->q = "DELETE FROM $table";
        return $this;
    }
    public function from($table)
    {
        $this->q .= " FROM $table";
        return $this;
    }
    public function where($where)
    {
        $this->q .= " WHERE";
        foreach ($where as $key => $value) {
            $this->q .= " $key '$value' AND";
        }
        $this->q = substr($this->q, 0, -4);
        return $this;
    }

    public function rightJoin($table, $on)
    {
        $this->q .= " RIGHT JOIN $table ON $on";
        return $this;
    }
    public function leftJoin($table, $on)
    {
        $this->q .= " LEFT JOIN $table ON $on";
        return $this;
    }
    public function innerJoin($table, $on)
    {
        $this->q .= " INNER JOIN $table ON $on";
        return $this;
    }
    public function join($table, $on)
    {
        $this->q .= " JOIN $table ON $on";
        return $this;
    }
    public function groupBy($groupBy)
    {
        $this->q .= " GROUP BY $groupBy";
        return $this;
    }
    public function set($set)
    {
        $this->q .= " SET";
        foreach ($set as $paramKey => $param) {
            $this->q .= " $paramKey = '$param', ";
        }
        $this->q = substr($this->q, 0, -2);
        return $this;
    }
    public function insertColumns($columns)
    {
        $this->q .= " ($columns)";
        return $this;
    }
    public function setValues($values)
    {
        $this->q .= " VALUES ($values)";
        return $this;
    }
    public function columns($columns)
    {
        $this->q .= " ($columns)";
        return $this;
    }
    public function orderBy($orderBy)
    {
        $this->q .= " ORDER BY $orderBy";
        return $this;
    }
    public function limit($limit)
    {
        $this->q .= " LIMIT $limit";
        return $this;
    }

    public function get()
    {
        echo $this->q;
        $stmt = $this->db->prepare($this->q);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    public function execute()
    {
        $this->stmt = $this->db->prepare($this->q);
        if ($this->stmt->execute()) {
            return $this;
        }
        return $this->error();
    }
    public function lastInsertedId()
    {
        return $this->db->lastInsertId();
    }
    public function affectedRows()
    {
        return $this->stmt->rowCount();
    }
    public function error()
    {
        return $this->db->errorInfo();
    }
}
