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
    public function getModel(string $fields = "*", string $table, string $ifclause = NULL, string $ifvalue = NULL, string $ifoperator = NULL, string $group = NULL, string $sort = NULL, string $types = NULL): array
    {
        if ($sort===NULL && $ifclause===NULL && $ifvalue===NULL && $types===NULL && $group===NULL) {
            $sql = "SELECT ".$fields." FROM ".$table;
            $query = $this->connection->prepare($sql);
        } elseif ($sort===NULL && $ifclause===NULL && $ifvalue===NULL && $types===NULL) {
            $sql = "SELECT ".$fields." FROM ".$table." GROUP BY ".$group;
            $query = $this->connection->prepare($sql);
        } elseif ($ifclause===NULL && $ifvalue===NULL && $types===NULL && $group===NULL) {
            $sql = "SELECT ".$fields." FROM ".$table." ORDER BY ".$sort;
            $query = $this->connection->prepare($sql);
        } elseif ($ifclause===NULL && $ifvalue===NULL && $types===NULL) {
            $sql = "SELECT ".$fields." FROM ".$table." GROUP BY ".$group." ORDER BY ".$sort;
            $query = $this->connection->prepare($sql);
        } elseif ($sort===NULL && $group===NULL) {
            $if = explode(", ", $ifclause);
            $sql = "SELECT ".$fields." FROM ".$table." WHERE ";
            if (is_null($ifoperator)) {
                for ($i=0; $i<count($if); $i++) {
                    $sql.=$if[$i]." = ? ";
                }
            } else {
                for ($i=0; $i<count($if); $i++) {
                    $sql.=$if[$i]." = ? ".$ifoperator." ";
                }
            }
            $query = $this->connection->prepare($sql);
            $query->bind_param($types, $ifvalue);
        } elseif ($sort===NULL) {
            $sql = "SELECT ".$fields." FROM ".$table." WHERE ";
            $if = explode(", ", $ifclause);
            if (is_null($ifoperator)) {
                for ($i=0; $i<count($if); $i++) {
                    $sql.=$if[$i]." = ? ";
                }
            } else {
                for ($i=0; $i<count($if); $i++) {
                    $sql.=$if[$i]." = ? ".$ifoperator." ";
                }
            }
            $sql.= "GROUP BY ".$group;
            $query = $this->connection->prepare($sql);
            $query->bind_param($types, $ifvalue);
        }  elseif ($group===NULL) {
            $sql = "SELECT ".$fields." FROM ".$table." WHERE ";
            $if = explode(", ", $ifclause);
            if (is_null($ifoperator)) {
                for ($i=0; $i<count($if); $i++) {
                    $sql.=$if[$i]." = ? ";
                }
            } else {
                for ($i=0; $i<count($if); $i++) {
                    $sql.=$if[$i]." = ? ".$ifoperator." ";
                }
            }
            $sql.= "ORDER BY ".$sort;
            $query = $this->connection->prepare($sql);
            $query->bind_param($types, $ifvalue);
        } else {
            $sql = "SELECT ".$fields." FROM ".$table." WHERE ";
            $if = explode(", ", $ifclause);
            if (is_null($ifoperator)) {
                for ($i=0; $i<count($if); $i++) {
                    $sql.=$if[$i]." = ? ";
                }
            } else {
                for ($i=0; $i<count($if); $i++) {
                    $sql.=$ifclause[$i]." = ? ".$ifoperator." ";
                }
            }
            $sql.= "GROUP BY ".$group."ORDER BY ".$sort;
            $query = $this->connection->prepare($sql);
            $query->bind_param($types, $ifvalue);
        }
        $query->execute();
        $result = $query->get_result();
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}