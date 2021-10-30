<?php
spl_autoload_register(static function ($class) {
    $path = __DIR__ . "/$class.php";
    $path2 = __DIR__ . "/../item/$class.php";
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

class DBItem implements DBService
{
    private DBConnection $conn;
    private PDO $db;

    public function __construct()
    {
        $this->conn = new DBConnection("shinycoffee");
        $this->db = $this->conn->getdb();
    }

    function InsertInto(array $object): bool
    {
        // TODO: Implement InsertInto() method.
        try {
            if ($this->conn->isConnected()) {
                $sql = "INSERT INTO shinycoffee.item (name, price, type, image)
                        values (:name, :price, :type, :image)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':name', $object['name']);
                $stmt->bindParam(':price', $object['price']);
                $stmt->bindParam(':type', $object['type']);
                $stmt->bindParam(':image', $object['image']);
                $stmt->execute();
            }
        }catch (PDOException $e) {
            return false;
        }
        return true;
    }


    function Update(array $object): bool
    {
        // TODO: Implement Update() method.
        try {
            if ($this->conn->isConnected()) {
                $sql = "UPDATE shinycoffee.item SET name=:name, 
                            price=:price, type=:type, image=:image
                        WHERE item_id=:item_id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':item_id', $object['item_id']);
                $stmt->bindParam(':name', $object['name']);
                $stmt->bindParam(':price', $object['price']);
                $stmt->bindParam(':type', $object['type']);
                $stmt->bindParam(':image', $object['image']);
                $stmt->execute();
            }
        }catch (PDOException $e) {
            return false;
        }
        return true;
    }

    function Delete(int $id): bool
    {
        // TODO: Implement Delete() method.
        try {
            if ($this->conn->isConnected()) {
                $sql = 'DELETE FROM shinycoffee.item WHERE item_id = :item_id';
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':item_id', $id);
                $stmt->execute();
            }
        }catch (PDOException $e) {
            return false;
        }
        return true;
    }

    function getALL(): array
    {
        // TODO: Implement getALL() method.
        try {
            if ($this->conn->isConnected()) {
                $sql = 'SELECT * FROM shinycoffee.item';
                $stmt = $this->db->query($sql);
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Item', [0, 0, 0, 0, 0]);
                $stmt->execute();
                $temp = $stmt->fetchAll();
                return $temp;
            }
        } catch (PDOException $e) {
            return [];
        }
    }

    function getByStatus(int $condition): array
    {
        // TODO: Implement getByStatus() method.
        return [];
    }

    function FindByName(string $name): array
    {
        // TODO: Implement FindByName() method.
        try {
            if ($this->conn->isConnected()) {
                $sql = 'SELECT * FROM shinycoffee.item WHERE name like :name';
                $stmt = $this->db->prepare($sql);
                $name = "%$name%";
                $stmt->bindValue(':name', $name);
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Item', [0, 0, 0, 0, 0]);
                $stmt->execute();
                $temp = $stmt->fetchAll();
                return $temp;
            }
        } catch (PDOException $e) {
            return [];
        }
    }

    function FindById(int $id): array
    {
        // TODO: Implement FindByName() method.
        try {
            if ($this->conn->isConnected()) {
                $sql = 'SELECT * FROM shinycoffee.item WHERE item_id like :id';
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':id', $id);
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Item', [0, 0, 0, 0, 0]);
                $stmt->execute();
                $temp = $stmt->fetchAll();
                return $temp;
            }
        } catch (PDOException $e) {
            return [];
        }
    }

    function countByStatus(int $staus): int
    {
        // TODO: Implement FindByName() method.
        return 0;
    }

}

?>