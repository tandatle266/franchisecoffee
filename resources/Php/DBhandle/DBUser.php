<?php
/*path for same current script file __DIR__
include_once(__DIR__."/DBConnection.php");
include_once(__DIR__."/DBService.php");
*/
/*path for different folder __DIR__."/../../" equivalent to root/Resources/login/
 if more than 1 sub-folder in parent folder you must write path directly or else it will return current script path

include_once(__DIR__."/../../php/account/InfoUser.php");
*/
//or we can use this function to autoload many file in same folder
spl_autoload_register(static function ($class) {
    $path = __DIR__ . "/$class.php";
    $path2 = __DIR__ . "/../account/$class.php";

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

class DBUser implements DBService
{
    private PDO $dsn;

    public function __construct()
    {
        $dbConnection = new DBConnection("shinycoffee");
        $this->dsn = $dbConnection->getdb();
    }

    /**
     * @param array $object
     * @return bool
     */
    public function insertInto(array $object): bool
    {
        //check if user is exist or not
        $result = $this->dsn->prepare('select user_name from account where user_name= ?;');
        $result->bindParam(1, $object['user_name']);
        try {
            $result->execute();
            $array = $result->fetchAll();
            //if exist then return false
            if ($array !== []) {
                return false;
            }
            //encrypt password using bcrypt
            $pass_hash = password_hash($object['password'], PASSWORD_DEFAULT);
            //prepare query
            $finalRes = $this->dsn->prepare('insert into user (fullname,idcard,email,phone,type) values(:fullname,:idcard,:email,:phone,:type);
                                                   insert into account values(LAST_INSERT_ID(),:user_name,:password);');
            $finalRes->bindParam(':fullname', $object['fullname']);
            $finalRes->bindParam(':idcard', $object['idcard']);
            $finalRes->bindParam(':email', $object['email']);
            $finalRes->bindParam(':phone', $object['phone']);
            $finalRes->bindParam(':type', $object['type']);
            $finalRes->bindParam(':user_name', $object['user_name']);
            $finalRes->bindParam(':password', $pass_hash);
            return $finalRes->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * @param array $object
     * @return bool
     */
    public function update(array $object): bool
    {
        print_r($object);
        $result = $this->dsn->prepare("update user set fullname=:fullname,idcard=:idcard,email=:email,phone=:phone,type=:type  where id=:id;");
        $result->bindParam(':id', $object['id']);
        $result->bindParam(':fullname', $object['fullname']);
        $result->bindParam(':idcard', $object['idcard']);
        $result->bindParam(':email', $object['email']);
        $result->bindParam(':phone', $object['phone']);
        $result->bindParam(':type', $object['type']);
        try {
            return $result->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        try {
            $result = $this->dsn->prepare("update user set status=0 where id=?;");
            $result->bindParam(1, $id);
            $result->execute();
        }catch (PDOException $e) {
            return false;
        }
        return true;
    }

    /**
     * @return array
     */
    public function getALL(): array
    {
        $result = $this->dsn->query('SELECT a.*,b.user_name FROM user a,account b where a.id = b.user_id');
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'InfoUser', [0, 0, 0, 0, 0, 0, 0, 0, 0]);
        try {
            $result->execute();
            return $result->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }

    /**
     * @param int $condition $condition is either 1 or 0
     * @return array
     */
    public function getByStatus(int $condition): array
    {
        if ($condition !== 1 && $condition !== 0) {
            return [];
        }
        $result = $this->dsn->prepare('select a.*,b.user_name from user a,account b where a.id=b.user_id and a.status = ?;');
        $result->bindParam(1, $condition);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'InfoUser', [0, 0, 0, 0, 0, 0, 0, 0, 0]);
        try {
            $result->execute();
            return $result->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }

    /**
     * @param string $name
     * @return array
     */
    public function findByName(string $name): array
    {
        $result = $this->dsn->prepare('select a.*,b.user_name from user a,account b where a.id=b.user_id and a.fullname = ?;');
        $result->bindParam(1, $name);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'InfoUser', [0, 0, 0, 0, 0, 0, 0, 0, 0]);
        try {
            $result->execute();
            return $result->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }
    /**
     * @param string $name
     * @return array
     */
    public function findById(int $id): array
    {
        $result = $this->dsn->prepare('select a.*,b.user_name from user a,account b where a.id=b.user_id and a.id=?;');
        $result->bindParam(1, $id);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'InfoUser', [0, 0, 0, 0, 0, 0, 0, 0, 0]);
        try {
            $result->execute();
            return $result->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }

    /**
     * this function is deprecated.
     * @param int $id
     * @param int $newStatus
     * @return bool always false
     */
    public function updateStatus(int $id, int $newStatus): bool
    {

        return false;
    }

    /**
     * @param string $user_name
     * @param string $password
     * @return bool
     */
    public function checkLogin(string $user_name, string $password): bool
    {
        //check user exist or not
        $result = $this->dsn->prepare('select password from account,user  where user_name=? and user.status=1 and user.id = account.user_id;');
        $result->bindParam(1, $user_name);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        try {
            $result->execute();
            $array = $result->fetchAll();
            //if user not exist then return false
            if ($array === []) {
                return false;
            }
            //check password if it correct or not;
            return password_verify($password, $array[0]['password']);

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * @param int $status
     * @return int
     */
    public function countByStatus(int $status): int
    {

        $result = $this->dsn->prepare('SELECT count(status) FROM user  where status = ?');
        $result->bindParam(1, $status);

        try {
            $result->execute();
            $arr = $result->fetch(PDO::FETCH_NUM);
            return $arr[0];
        } catch (PDOException $e) {
            return 0;
        }
    }
    public function changePassword(string $user_name,string $password):bool{
        $password_hash= password_hash($password,PASSWORD_DEFAULT);
        $result = $this->dsn->prepare('update account set password=?  where user_name=?');
        $result->bindParam(1, $password_hash);
        $result->bindParam(2,$user_name);
        try {
            $result->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function getType(string $user_name):string {
        $result = $this->dsn->prepare('select user.type from user,account where account.user_name=? and user.id=account.user_id');
        $result->bindParam(1, $user_name);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        try
        {
                $result->execute();
                $arr= $result->fetchAll();
                if($arr===[])
                    return '/0';
                return $arr[0]['type'];
        }catch (PDOException $e)
        {
            return '\0';
        }
    }
}





/**
 * @param string $condition only work with fullname,type and status
 * @param string $mode  ASC or DESC (default is ASC)
 * @return array array of InfoUser object
 */
//public function getSortWith(string $condition, string $mode='ASC'): array
//{
//    //if $mode is wrong then we return null;
//
//    if (strcasecmp($mode,'ASC')===0 || strcasecmp($mode,'DESC')===0) {
//
//
//        switch ($condition) {
//            case 'fullname':
//                $result = $this->dsn->query("SELECT a.*,b.user_name FROM user a,account b where a.id = b.user_id order by fullname $mode");
//                $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'InfoUser', [0, 0, 0, 0, 0, 0, 0, 0, 0]);
//                try {
//                    $result->execute();
//                    return $result->fetchAll();
//                } catch (PDOException $e) {
//                    return [];
//                }
//            case 'type':
//                $result2 = $this->dsn->query("SELECT a.*,b.user_name FROM user a,account b where a.id = b.user_id order by type $mode");
//                $result2->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'InfoUser', [0, 0, 0, 0, 0, 0, 0, 0, 0]);
//                try {
//                    $result2->execute();
//                    return $result2->fetchAll();
//                } catch (PDOException $e) {
//                    return [];
//                }
//            case 'status':
//                $result3 = $this->dsn->query("SELECT a.*,b.user_name FROM user a,account b where a.id = b.user_id order by status $mode");
//                $result3->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'InfoUser', [0, 0, 0, 0, 0, 0, 0, 0, 0]);
//                try {
//                    $result3->execute();
//                    return $result3->fetchAll();
//                } catch (PDOException $e) {
//                    return [];
//                }
//            case 'date':
//                $result4 = $this->dsn->query("SELECT a.*,b.user_name FROM user a,account b where a.id = b.user_id order by date $mode");
//                $result4->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'InfoUser', [0, 0, 0, 0, 0, 0, 0, 0, 0]);
//                try {
//                    $result4->execute();
//                    return $result4->fetchAll();
//                } catch (PDOException $e) {
//                    return [];
//                }
//        }
//    }
//    return [];
//}
