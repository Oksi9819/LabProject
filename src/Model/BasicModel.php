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
    public function setModel(string $table, array $fields, string $types, array $values): string
    {
        $val = count($values);
        $missed = "?";
        for ($i=1; $i<$val; $i++) {
            $missed.=", ?";
        }
        $params = implode(", ",$fields);
        $sql = "INSERT INTO ".$table." (".$params.") VALUES (".$missed.")";
        $query = $this->connection->prepare($sql);
        $query->bind_param($types, ...$values);
        $query->execute();   
        $query->get_result();
        $result = "Success!";
        return $result;
    }

    //READ
    public function getModel(string $fields = "*", string $table, string $ifclause = NULL, string $ifvalue = NULL, string $ifoperator = NULL, string $group = NULL, string $sort = NULL, string $types = NULL): array
    {
        $ifvalues = explode(", ", $ifvalue);
        if ($sort===NULL && $ifclause===NULL && $ifvalue===NULL && $types===NULL && $group===NULL) {
            $sql = "SELECT ".$fields." FROM ".$table;
            
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
            $query->bind_param($types, ...$ifvalues);
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
            $query->bind_param($types, ...$ifvalues);
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
            $query->bind_param($types, ...$ifvalues);
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
            $query->bind_param($types, ...$ifvalues);
        }
        $query->execute();
        $result = $query->get_result();
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    //UPDATE
    public function updateModel(string $fields, string $table, string $ifclause, string $ifvalue, array $values, string $ifoperator = NULL, string $types)
    {
        $field = explode(", ", $fields);
        $sql = "UPDATE ".$table." SET ";
        for ($i=0; $i<count($field)-1; $i++) {
            $sql.=$field[$i]." = ?, ";
        }
        $sql.=$field[count($field)-1]." = ? WHERE ";
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
        $query = $this->connection->prepare($sql);
        array_push($values, $ifvalue);
        $query->bind_param($types, ...$values);
        $query->execute();
        $query->get_result();
        $types = "";
        if (is_int($ifvalue)) {
            $types = "i";
        }
        if (is_string($ifvalue)) {
            $types = "s";
        }
        if (is_float($ifvalue)) {
            $types = "d";
        }
        $result = $this->getModel("*", $table, $ifclause, $ifvalue, $ifoperator, NULL, NULL, $types);
        return $result;
    }

    //DELETE
    public function deleteModelItem(string $table, string $ifclause, string $ifvalue, string $ifoperator = NULL, string $types): string
    {
        $ifvalues = explode(", ", $ifvalue);
        $sql = "DELETE FROM ".$table." WHERE ";
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
        $query = $this->connection->prepare($sql);
        $query->bind_param($types, ...$ifvalues);
        $query->execute();
        $query->get_result();
        $result = "Success!";
        return $result;
    }
}