<?php


class LogFile
{
    private static string $user;
    private static string $dateTime;
    private static string $dir = __DIR__."/../../log/";

    public static function setLogFile(string $user): void
    {
        self::$user = $user;
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        self::$dateTime= date('y-m-d');

    }

    public static function updateLogFile(string $action, string $object):bool
    {
        $fileName=self::$dateTime;
        try {
            $getFile = fopen(self::$dir . "$fileName.txt", 'ab+');
            $time = date('h:i:s A');
            fwrite($getFile, $time."-".self::$user . ":$action-$object".PHP_EOL);
           return fclose($getFile);
        }catch(Exception $e)
        {
            return false;
        }
    }
}
