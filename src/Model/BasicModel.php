<?php
namespace Itechart\InternshipProject\Model;

class BasicModel
{
    protected $connection;

    public function __construct()
    {
        global $conn;
        $this->connection = $conn;
    }

    //CREATE
    public function setModel(string $table, array $fields, string $types, array $values)
    {
        $val = count($values);
        $missed = "?";
        for ($i=1; $i<$val; $i++) {
            $missed.=", ?";
        }
        $sql = "INSERT INTO ".$table."(".$params.") VALUES (".$missed.")";
        $query = $this->connection->prepare($sql);
        $query->bind_param($types, $values);
        $query->execute();   
        $result = $query->get_result();
        $result = $result->fetch_assoc(); 
        return $result;
    }

    //READ
    public function getModel(string $fields = "*", string $table, string $if_clause = NULL, string $if_value = "-1 OR 1=1", string $types = NULL, string $sort = NULL): array
    {
        $sql = "SELECT ".$fields." FROM ".$table." WHERE ".$if_clause." = ? ORDER BY ".$sort;
        $query = $conn->prepare($sql);
        $query->bind_param($types, $if_value);
        $query->execute();
        $result = $query->get_result();
        $result = $result->fetch_all(MYSQLI_ASSOC); 
        return $result;
    }
}