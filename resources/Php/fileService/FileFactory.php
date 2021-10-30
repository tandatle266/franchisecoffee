<?php

class FileFactory
{
    private string $dir = __DIR__."/uploads";
    private array $allowType = ['jpg', 'png', 'jpeg'];        //file that allow to upload
    //max size is 1mb
    private int $maxSize = 1000000;

    /**
     * @param string $fileName $_FILES["inputName"]["name"]
     * @param string $filePath $_files["inputName"]["tmp_name"]
     * @param int $fileSize $_files["inputName"]["size"]
     * @return bool
     */
    public function uploadImgItem(string $fileName, string $filePath, int $fileSize): bool
    {
        $path = $this->dir . "/item/";
        return $this->uploadImg($path, $fileName, $filePath, $fileSize);
    }

    /**
     * @param string $fileName $_FILES["inputName"]["name"]
     * @param string $filePath $_files["inputName"]["tmp_name"]
     * @param int $fileSize $_files["inputName"]["size"]
     * @return bool
     */
    public function uploadImgUser(string $fileName, string $filePath, int $fileSize): bool
    {
        $path = $this->dir . "/user/";
        return $this->uploadImg($path, $fileName, $filePath, $fileSize);
    }


    public function deleteImgItem(string $name): bool
    {
        $path = $this->dir . "/item/";
        return $this->deleteImg($name, $path);
    }

    public function deleteImgUser(string $name): bool
    {
        $path = $this->dir . "/user/";
        return $this->deleteImg($name, $path);
    }

    private function deleteImg(string $fileName, string $filePath): bool
    {
        $path = $filePath . $fileName;
        foreach ($this->allowType as $x) {
            $checkPath = $path . ".$x";
            if (realpath($checkPath) && is_writable($checkPath)) {
                try {
                    return unlink($checkPath);
                } catch (Exception $e) {
                    return false;
                }
            }
        }
        return false;
    }
    /**
     * @param string $path path where file will be store
     * @param string $fileName
     * @param string $filePath
     * @param int $fileSize
     * @return bool
     */
    private function uploadImg(string $path, string $fileName, string $filePath, int $fileSize): bool
    {
        //where file will be store
        $targetFile = $path . basename($fileName);
        //get extension
        $imgType = pathinfo($targetFile, PATHINFO_EXTENSION);
        $check = getimagesize($filePath);
        //if file is not img or file is exist or file is larger than 1MB or extension is not allow then return false
        if ($this->maxSize < $fileSize || $check === false || file_exists($targetFile) || !in_array($imgType, $this->allowType, true)) {
            return false;
        }

        //start upload file
        if (move_uploaded_file($filePath, $targetFile)) {
            return true;
        }

        return false;
    }


}



