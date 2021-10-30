<?php

spl_autoload_register(static function ($class) {
    $path = __DIR__ . "/$class.php";
    $path2 = __DIR__ . "/../customer/$class.php";
    $path3 = __DIR__ . "/../item/$class.php";
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
    if (file_exists($path3)) {
        /** @noinspection PhpIncludeInspection */
        include_once($path3);
        return true;
    }
    return false;
});

class DBShopping implements DBService
{
    private PDO $dsn;

    public function __construct()
    {
        $dbConnection = new DBConnection("shinycoffee");
        $this->dsn = $dbConnection->getdb();
    }

// array object thứ 4 phải là số luong item thêm
    public function insertInto(array $object): bool
    {
        $result_cus = $this->dsn->prepare('INSERT into customer(fullname,email,phone,address) value (:fullname,:email,:phone,:address)');
        $result_cus->bindParam(':fullname', $object[0]);
        $result_cus->bindParam(':email', $object[1]);
        $result_cus->bindParam(':phone', $object[2]);
        $result_cus->bindParam(':address', $object[3]);
        $result_cus->execute();
        $temp = $this->dsn->lastInsertId();
        $k = 3;
        for ($i = 0; $i < ((count($object) - 4) / 2); $i++) {
            $this->InsertIntoItem($temp, $object[$k = $k+1], $object[$k = $k+1]);
        }
        return true;
    }

    public function InsertIntoItem(int $cus_id, int $item_id, int $quantity): bool
    {
        $result = $this->dsn->prepare('INSERT INTO shopping values(:cus_id,:item_id,:quantity) ');
        $result->bindParam(':cus_id', $cus_id);
        $result->bindParam(':item_id', $item_id);
        $result->bindParam(':quantity', $quantity);
        $result->execute();
        return true;
    }

    public function update(array $object): bool
    {
        $result = $this->dsn->prepare('UPDATE shopping SET item_id =:new_item_id && quantity =:new_quantity where cus_id=:cus_id && item_id=:item_id');
        $result->bindParam(':cus_id', $object[0]);
        $result->bindParam(':item_id', $object[1]);
        $result->bindParam('new_item_id', $object[2]);
        $result->bindParam(':new_quantity', $object[3]);
        $result->execute();
        return true;
    }

    public function updateQuantity(array $object): bool
    {
        $result = $this->dsn->prepare('UPDATE shopping SET quantity =:new_quantity where cus_id=:cus_id and item_id=:item_id');
        $result->bindParam(':cus_id', $object[0]);
        $result->bindParam(':item_id', $object[1]);
        $result->bindParam(':new_quantity', $object[2]);
        return true;

    }

    public function delete(int $id): bool
    {
        $result = $this->dsn->prepare("DELETE FROM shopping WHERE shopping.cus_id=:id");
        $result->bindParam(':id', $id);
        $result->execute();
        return true;
    }

    public function deleteItem(int $cus_id, int $item_id): bool
    {
        $result = $this->dsn->prepare("DELETE FROM shopping where shopping.cus_id=:cus_id && shopping.item_id=:item_id");
        $result->bindParam(':cus_id', $cus_id);
        $result->bindParam(':item_id', $item_id);
        $result->execute();
        return true;
    }

    public function getByStatus(int $condition): array
    {

        return $this->getData("&& c.status =" . $condition);
    }

    private function getData(string $condition): array
    {

        $result = $this->dsn->query("SELECT c.* 
                                                FROM customer c, ( SELECT DISTINCT a.cus_id 
                                                                    FROM customer a, shopping b
                                                                    WHERE a.cus_id = b.cus_id ) AS sdid 
                                                WHERE c.cus_id=sdid.cus_id 
                                                $condition
                                                ");
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Shopping', [0, 0, 0, 0, 0, 0, 0]);
        $result->execute();
        $temp = $result->fetchAll();

        foreach ($temp as $row) {
            $row->setArray($this->arrayProduct($row->getCusId()));
        }

        return $temp;
    }

    private function arrayProduct(string $cus_id): array
    {
        $result = $this->dsn->prepare('
            SELECT a.*, b.quantity
            FROM item a, shopping b
            WHERE a.item_id=b.item_id && b.cus_id =:cus_id');
        $result->bindParam(':cus_id', $cus_id);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Product', [0, 0, 0, 0, 0, 0]);
        $result->execute();
        return $result->fetchAll();
    }


    public function FindByName(string $name): array
    {
        $find = '%' . $name . '%';
        $result = $this->dsn->prepare('SELECT c.* 
                                                FROM customer c, ( SELECT DISTINCT a.cus_id 
                                                                    FROM customer a, shopping b
                                                                    WHERE a.cus_id = b.cus_id ) AS sdid 
                                                WHERE c.cus_id=sdid.cus_id && c.fullname LIKE :find
                                                ');
        $result->bindParam(':find', $find);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Shopping', [0, 0, 0, 0, 0, 0, 0]);
        $result->execute();
        $temp = $result->fetchAll();

        foreach ($temp as $row) {
            $row->setArray($this->arrayProduct($row->getCusId()));
        }

        return $temp;

    }

    public function getALL(): array
    {
        return $this->getData('');
    }

    public function UpdateStatus(int $id, int $newStatus): bool
    {
        $result = $this->dsn->prepare('UPDATE customer SET status =:status where cus_id=:cus_id');
        $result->bindParam(':status', $newStatus);
        $result->bindParam(':cus_id', $id);
        $result->execute();
        return true;
    }

    public function countALL(): int
    {
        $result = $this->dsn->query("SELECT count(dis.cus_id)
                                                from (SELECT DISTINCT b.cus_id
                                                            FROM shopping b) as dis

                                                ");
        $arr = $result->fetch(PDO::FETCH_NUM);
        return $arr[0];
    }

    public function countByStatus(int $status): int
    {
        $result = $this->dsn->query("SELECT count(sdid.cus_id)
                                                FROM  ( SELECT DISTINCT b.cus_id 
                                                                    FROM customer a, shopping b
                                                                    WHERE a.cus_id = b.cus_id && a.status = $status) AS sdid 
                                                ");
        $arr = $result->fetch(PDO::FETCH_NUM);
            return $arr[0];
    }


}

