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
    public function getModel(string $fields = "*", string $table, string $ifclause = NULL, string $ifvalue = NULL, string $sort = NULL, string $types = NULL): array
    {
        if ($sort===NULL && $ifclause===NULL && $ifvalue===NULL && $types===NULL) {
            $sql = "SELECT ".$fields." FROM ".$table;
            $query = $this->connection->prepare($sql);
        } elseif ($ifclause===NULL && $ifvalue===NULL && $types===NULL) {
            $sql = "SELECT ".$fields." FROM ".$table." ORDER BY ".$sort;
            $query = $this->connection->prepare($sql);
        } elseif ($sort===NULL) {
            $value_arr = explode(" ", $ifvalue);
            $missed = "?";
            for ($i=1; $i<count($value_arr); $i++) {
                $missed.=", ?";
            }
            $sql = "SELECT ".$fields." FROM ".$table." WHERE ".$ifclause." = ".$missed;
            $query = $this->connection->prepare($sql);
            $query->bind_param($types, $ifvalue);
        } else {
            $value_arr = explode(" ", $ifvalue);
            echo count($value_arr)."<br>";
            $missed = "?";
            for ($i=1; $i<count($value_arr); $i++) {
                $missed.=", ?";
            }
            $sql = "SELECT ".$fields." FROM ".$table." WHERE ".$ifclause." = ".$missed." ORDER BY ".$sort;
            $query = $this->connection->prepare($sql);
            $query->bind_param($types, $ifvalue);
        }
        $query->execute();
        $result = $query->get_result();
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}