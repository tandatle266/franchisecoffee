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
class DBFeedBack implements DBService
{
    private PDO $dsn;
    public function __construct()
    {
        $dbConnection = new DBConnection("shinycoffee");
        $this->dsn = $dbConnection->getdb();
    }

    public function InsertInto(array $object): bool
    {

        $result = $this -> dsn ->prepare('INSERT INTO customer (fullname, email, phone, address) VALUES (:fullname,:email,:phone,:address);
                                                    INSERT INTO feedback  VALUE (LAST_INSERT_ID() ,:research,:content )');
        $result->bindParam(':fullname',$object['fullname']);
        $result->bindParam(':email',$object['email']);
        $result->bindParam(':phone',$object['phone']);
        $result->bindParam(':address',$object['address']);
        $result->bindParam(':research',$object['research']);
        $result->bindParam(':content',$object['content']);
        try{
            return $result->execute();
        }catch (PDOException $e)
        {
            return false;
        }
    }

    public function Update(array $object): bool
    {
//        $result = $this -> dsn ->prepare('UPDATE feedback SET research= :research ,content = :content WHERE cus_id= :cus_id');
//        $result->bindParam(':research',$object[1]);
//        $result->bindParam(':content',$object[2]);
//        $result->bindParam(':cus_id',$object[0]);
//        $result->execute();
        return false;
    }
    public function Delete(int $id): bool
    {
        $result = $this -> dsn ->prepare('DELETE FROM customer  WHERE  cus_id = :id');
        $result->bindParam(':id',$id);
        try{
           return $result->execute();
        }catch (PDOException $e){
            return false;
        }

    }

    public function getALL(): array
    {
        $result = $this->dsn->query('SELECT c.*,f.research,f.content FROM customer c,feedback f where c.cus_id = f.cus_id');
        $result->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Feedback',[0,0,0,0,0,0,0,0,0]);
        try{
            $result->execute();
            return $result->fetchAll();
        }catch (PDOException $e){
            return [];
        }

    }

    public function getByStatus(int $condition): array
    {
        $result = $this->dsn->prepare('SELECT c.*,f.research,f.content FROM customer c,feedback f where c.cus_id = f.cus_id and c.status = :status');
        $result->bindParam(':status',$condition);
        $result->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Feedback',[0,0,0,0,0,0,0,0,0]);
        try{
            $result->execute();
            return $result->fetchAll();
        }catch (PDOException $e){
            return [];
        }
    }


    public function FindByName(string $name): array
    {
        $find = "%$name%" ;
        $result = $this->dsn->prepare("SELECT c.*,f.research,f.content FROM customer c,feedback f where c.cus_id = f.cus_id and c.fullname like :find ");
        $result->bindParam(':find',$find);
        $result->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Feedback',[0,0,0,0,0,0,0,0,0]);
        try{
            $result->execute();
            return $result->fetchAll();
        }catch (PDOException $e){
            return [];
        }
    }

    public function UpdateStatus(int $id, int $newStatus ): bool
    {
        $result = $this -> dsn ->prepare('UPDATE customer SET status = :status  WHERE cus_id= :cus_id');
        $result->bindParam(':cus_id',$id);
        $result->bindParam(':status',$newStatus);
        try{
            return $result->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    public function countByStatus(int $status): int
    {
        return 0;
    }
}


//function getSortWith( string $condition , string $mode='ASC' ): array
//{
//    if(strcmp('ASC',$mode) !== 0 && strcmp('DESC',$mode) !== 0)
//    {
//        return [];
//    }
//
//    switch ($condition){
//        case 'cus_id':
//            $result = $this->dsn->query("SELECT c.*,f.research,f.content FROM customer c,feedback f where c.cus_id = f.cus_id order by c.cus_id $mode ");
//            $result->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Feedback',[0,0,0,0,0,0,0,0,0]);
//            try{
//                $result->execute();
//                return $result->fetchAll();
//            }catch (PDOException $e){
//                return [];
//            }
//        case 'fullname':
//            $result1 = $this->dsn->query("SELECT c.*,f.research,f.content FROM customer c,feedback f where c.cus_id = f.cus_id order by c.fullname $mode ");
//            $result1->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Feedback',[0,0,0,0,0,0,0,0,0]);
//            try{
//                $result1->execute();
//                return $result1->fetchAll();
//            }catch (PDOException $e){
//                return [];
//            }
//        case 'status':
//            $result2 = $this->dsn->query("SELECT c.*,f.research,f.content FROM customer c,feedback f where c.cus_id = f.cus_id order by c.status $mode ");
//            $result2->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Feedback',[0,0,0,0,0,0,0,0,0]);
//            try{
//                $result2->execute();
//                return $result2->fetchAll();
//            }catch (PDOException $e){
//                return [];
//            }
//        case 'date':
//            $result3 = $this->dsn->query("SELECT c.*,f.research,f.content FROM customer c,feedback f where c.cus_id = f.cus_id order by c.date $mode ");
//            $result3->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Feedback',[0,0,0,0,0,0,0,0,0]);
//            try{
//                $result3->execute();
//                return $result3->fetchAll();
//            }catch (PDOException $e){
//                return [];
//            }
//        case 'research':
//            $result4 = $this->dsn->query("SELECT c.*,f.research,f.content FROM customer c,feedback f where c.cus_id = f.cus_id order by f.research $mode ");
//            $result4->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Feedback',[0,0,0,0,0,0,0,0,0]);
//            try{
//                $result4->execute();
//                return $result4->fetchAll();
//            }catch (PDOException $e){
//                return [];
//            }
//        default:
//            return [];
//    }
//}



