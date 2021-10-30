<?php
spl_autoload_register(static function ($class) {
    $path = __DIR__ . "/$class.php";
    $path2 = __DIR__ . "/../customer/$class.php";
    if (file_exists($path)) {
        //tell php that $path is safe to run.
        /** @noinspection PhpIncludeInspection */
        include_once($path);
        return true;
    }

    if (file_exists($path2)) {
        /** @noinspection PhpIncludeInspection */
        include_once($path2);
        return true;
    }

    return false;
});
class DBFranchise implements DBService
{
    private DBConnection $conn;
    private PDO $db;
    
    public function __construct()
    {
        $this->conn = new DBConnection("shinycoffee");
        $this->db = $this->conn->getdb();
    }
    
    public function insertInto(array $object): bool
    {
        // TODO: Implement InsertInto() method.
        try {
            if ($this->conn->isConnected()) {
                $sql = 'INSERT INTO shinycoffee.customer (fullname, email, phone, address)
                        values (:fullname, :email, :phone, :address);
                        INSERT INTO shinycoffee.franchise
                        SET cus_id = (SELECT cus_id FROM shinycoffee.customer   
                                      WHERE cus_id=LAST_INSERT_ID()),
                            type=:type';
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':fullname', $object['fullname']);
                $stmt->bindParam(':email', $object['email']);
                $stmt->bindParam(':phone', $object['phone']);
                $stmt->bindParam(':address', $object['address']);
                $stmt->bindParam(':type', $object['type']);
                $stmt->execute();
            }
        }catch (PDOException $e) {
            return false;
        }
        return true;      
    }
   
    public function update(array $object): bool
    {
        // TODO: Implement Update() method.
        try {
            if ($this->conn->isConnected()) {
                $sql = 'UPDATE shinycoffee.franchise
                        SET type=:type
                        WHERE cus_id = :cus_id;
                        UPDATE shinycoffee.customer
                        SET fullname=:fullname, email=:email, phone=:phone, address=:address
                        WHERE cus_id = :cus_id;';
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':cus_id', $object['cus_id']);
                $stmt->bindParam(':type', $object['type']);
                $stmt->bindParam(':fullname', $object['fullname']);
                $stmt->bindParam(':email', $object['email']);
                $stmt->bindParam(':phone', $object['phone']);
                $stmt->bindParam(':address', $object['address']);
                $stmt->execute();
            }
        }catch (PDOException $e) {
            return false;
        }
        return true;      
    }
    
    public function updateByStatus(int $id, int $condition):bool
    {
        // TODO: Implement Update() method.
        try {
            if ($this->conn->isConnected()) {
                $sql = 'UPDATE shinycoffee.customer
                        SET status = :status 
                        WHERE cus_id = (SELECT cus_id FROM shinycoffee.franchise
                                        WHERE cus_id = :cus_id)';
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':status', $condition);
                $stmt->bindParam(':cus_id', $id);
                $stmt->execute();
            }
        }catch (PDOException $e) {
            return false;
        }
        return true;
    }
    
    public function delete(int $id): bool
    {
        // TODO: Implement Delete() method.
        try {
            if ($this->conn->isConnected()) {
                $sql = 'DELETE FROM shinycoffee.franchise
                        WHERE cus_id = (SELECT cus_id FROM shinycoffee.customer
                                      WHERE cus_id=:id)';
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
            }
        }catch (PDOException $e) {
            return false;
        }
        return true;      
    }
     
    public function getALL(): array
    {
        // TODO: Implement getALL() method.
        try {
            if ($this->conn->isConnected()) {
                $sql = 'SELECT a.*, b.type
                        FROM shinycoffee.customer a, shinycoffee.franchise b
                           WHERE a.cus_id = b.cus_id';
                $stmt = $this->db->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Franchise', [0, 0, 0, 0, 0, 0, 0, 0]);
                $stmt->execute();
                return $stmt->fetchAll();
            }
            return [];
        } catch (PDOException $e) {
            return [];
        }
    }
    
    public function getByStatus(int $condition): array
    {
        // TODO: Implement getByStatus() method.
        try {
            if ($this->conn->isConnected()) {
                $sql = 'SELECT a.*, b.type 
                        FROM shinycoffee.customer a, shinycoffee.franchise b 
                        WHERE a.cus_id = b.cus_id && a.status=:status';
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':status', $condition);
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Franchise', [0, 0, 0, 0, 0, 0, 0, 0]);
                $stmt->execute();
                return $stmt->fetchAll();
            }
            return [];
        } catch (PDOException $e) {
            return [];
        }
    }
    
    public function countByStatus(int $status): int
    {
        // TODO: Implement FindByName() method.
        try {
            if ($this->conn->isConnected()) {
                $sql = 'SELECT a.*, b.type
                        FROM shinycoffee.customer a, shinycoffee.franchise b
                        WHERE a.cus_id = b.cus_id && a.status=:status';
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':status', $status);
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Franchise', [0, 0, 0, 0, 0, 0, 0, 0]);
                $stmt->execute();
                return $stmt->rowCount();
            }
            return 0;
        } catch (PDOException $e) {
            return 0;
        }
    }

    public function findByName(String $name): array
    {
        // TODO: Implement FindByName() method.
        try {
            if ($this->conn->isConnected()) {
                $sql = 'SELECT a.*, b.type 
                        FROM shinycoffee.customer a, shinycoffee.franchise b 
                        WHERE a.cus_id = b.cus_id && a.fullname like :fullname';
                $stmt = $this->db->prepare($sql);
                $name = "%$name%";
                $stmt->bindValue(':fullname', $name);
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Franchise', [0, 0, 0, 0, 0, 0, 0, 0]);
                $stmt->execute();
                return $stmt->fetchAll();
            }
            return [];
        } catch (PDOException $e) {
            return [];
        }       
    }

}

