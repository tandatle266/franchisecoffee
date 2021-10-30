<?php
    session_start();

spl_autoload_register(static function ($class) {
    $path = __DIR__ . "/../Php/DBhandle/$class.php";
    $path2 = __DIR__ . "/../Php/account/$class.php";
    $path3 = __DIR__ . "/../Php/item/$class.php";
    $path4 = __DIR__ . "/../Php/fileService/$class.php";
    $path5 = __DIR__ . "/../Php/customer/$class.php";
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
    if (file_exists($path4)) {
        /** @noinspection PhpIncludeInspection */
        include_once($path4);
        return true;
    }
    if (file_exists($path5)) {
        /** @noinspection PhpIncludeInspection */
        include_once($path5);
        return true;
    }


    return false;
});



if(isset($_POST["action_pro"])) 
{
    if($_POST["action_pro"] === "insert_pro")
	{
        /* $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $item_image = basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $_SESSION['status'] = "Image already exists 2.";
            $_SESSION['status_code'] = "success";
            header('Location:  /Franchise/resources/product.php'); 
            $uploadOk = 0;
        }
              
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) { */




        $_POST['image'] = $_FILES["fileToUpload"]["name"];

        $obj = new DBItem();
        $check = $obj->InsertInto($_POST);

        $obj = new FileFactory();
        $result = $obj->uploadImgItem($_FILES["fileToUpload"]["name"], $_FILES["fileToUpload"]["tmp_name"], $_FILES["fileToUpload"]["size"]);





          if($check){
            $_SESSION['status'] = "Item Product Added";
            $_SESSION['status_code'] = "success";
            header('Location:  /Franchise/resources/product.php');

          } else {
            $_SESSION['status'] = "Item Product NOT Added";
            $_SESSION['status_code'] = "error";
            header('Location:  /Franchise/resources/product.php');
          }
        
    }

    if($_POST["action_pro"] === "fetch_single_pro")
	{
        $id = $_POST['id'];

        $obj = new DBItem();
        $result = $obj->FindById($id);
        foreach ($result as $row)
        {
        $output['id'] = $row->getItemId();
        $output['name'] = $row->getName();
        $output['price'] = $row->getPrice();
        $output['type'] = $row->getType();
        $output['image'] = $row->getImage();
        }

        echo json_encode($output);
	}

    if($_POST["action_pro"] === "update_pro")
	{   $obj = new DBItem();
        $result=0;
	    if($_FILES["fileToUpload"]["size"]!=0) {

            $_POST['image'] = $_FILES["fileToUpload"]["name"];
            $obj = new FileFactory();
            $result = $obj->uploadImgItem($_FILES["fileToUpload"]["name"], $_FILES["fileToUpload"]["tmp_name"], $_FILES["fileToUpload"]["size"]) ;

        }else
        {
            $result= 1;
            $obj2= $obj->FindById($_POST['item_id']);
            $_POST['image']=$obj2[0]->getImage();
        }
        $obj = new DBItem();
	    $check = $obj->Update($_POST);
        $obj = new FileFactory();


            if ($check && $result) {

                $_SESSION['status'] = "Item Product Updated";
                $_SESSION['status_code'] = "success";
                header('Location:  /Franchise/resources/product.php');

            } else {
//                $a = $_POST['image'];
//                $b = explode('.', $a);

//                $del = $obj->deleteImgItem((string)$b[0]);
                $_SESSION['status'] = "Image already exists. Please Upload Again";
                $_SESSION['status_code'] = "error";
                header('Location:  /Franchise/resources/product.php');
            }


	}
    if($_POST["action_pro"] === "delete_pro")
    {
        $id = $_POST['id'];
        $obj = new DBItem();
        $c = $obj->FindById($id);
        foreach($c as $row)
        {$d = $row->getImage();}
        $check = $obj->Delete($id);
        $b = explode( '.', $d );

        $obj = new FileFactory();
        $del = $obj->deleteImgItem((string)$b[0]);

        if( $check)
        {
            $_SESSION['status'] = "Item Data is Deleted";
            $_SESSION['status_code'] = "success";

        }
        else
        {
            $_SESSION['status'] = "Item Data is NOT DELETED";
            $_SESSION['status_code'] = "error";

        }
        echo true;
    }

    
}




    if(isset($_POST['action'])) {

	if($_POST["action"] === "insert")
	{  
        $obj = new DBUser();
        $check = $obj->insertInto($_POST);
//        print_r($check);
		if($check) {
            $_SESSION['status'] = " Added";
            $_SESSION['status_code'] = "success";
            LogFile::setLogFile($_SESSION['username']);
            LogFile::updateLogFile("insert",$_POST["user_name"]);

            header('Location:  /Franchise/resources/register.php');
        }
	}

    
    if($_POST["action"] === "fetch_single")
	{
        $id = $_POST['id'];
        $obj = new DBUser();
        $row = $obj->findById($id);
            $output['fullname'] = $row[0]->getFullname();
			$output['idcard'] = $row[0]->getIdcard();
			$output['email'] = $row[0]->getEmail();
            $output['phone'] = $row[0]->getPhone();
            $output['type'] = $row[0]->getType();
            $output['id'] = $row[0]->getId();

		echo json_encode($output);
	}

    if($_POST["action"] == "update")
	{
        $obj = new DBUser();
        $check = $obj->update($_POST);

       if($check) {
           $_SESSION['status'] = " Updated";
           $_SESSION['status_code'] = "success";
           LogFile::setLogFile($_SESSION['username']);
           LogFile::updateLogFile("update",$_POST["user_name"]);

       }
	}
    if($_POST["action"] === "delete")
    {
        LogFile::setLogFile($_SESSION['username']);
        LogFile::updateLogFile("delete",$_SESSION['username']);
        $id = $_POST['id'];
        $obj = new DBUser();
        $check = $obj->delete($id);

        echo $check;
            $_SESSION['status'] = "Your Data is Deleted";
            $_SESSION['status_code'] = "success";

//            header('Location:  /Franchise/resources/register.php');

//        }
//        else
//        {
//            $_SESSION['status'] = "Your Data is NOT DELETED";
//            $_SESSION['status_code'] = "error";
//            header('Location:  /Franchise/resources/register.php');
//        }


    }
   

	
}
if(isset($_POST['action_task'])) {
	switch($_POST['action_task'])
    {
        case 'waiting':     $status = 0; break;
        case 'processing':  $status = 1; break;
        case 'done':        $status = 2; break;
    }
        $id = $_POST['id'] ;
	    $obj = new DBFranchise();
	    $check = $obj->UpdateByStatus($id, $status);

        echo $check;
	
}
if(isset($_POST['action_task_order'])) {
$id = $_POST['id'];
$obj = new DBShopping();
if($_POST['action_task_order']=== 'delete_task_order')
{
    $check = $obj->delete($id);
    echo $check;
}else if($_POST['action_task_order']=== 'delete_task')
{
    $obj1= new DBFranchise();
    $check = $obj1->Delete($id);
    echo $check;
}

else {
    switch ($_POST['action_task_order']) {
        case 'waiting':
            $status = 0;
            break;
        case 'processing':
            $status = 1;
            break;
        case 'done':
            $status = 2;
            break;
    }

    $check = $obj->UpdateStatus($id, $status);

    echo $check;
}

}
if(isset($_POST['action_fb'])) {
    if ($_POST['action_fb'] == "delete") {

        $id = $_POST['id'];
        $obj = new DBFeedBack();
        $check = $obj->Delete($id);

        echo $check;

    }
}

    
    if(isset($_POST['btn_out'])){

        session_destroy();
        unset($_SESSION['username']);
        header('Location:  /Franchise/resources/index.php');  

    }







?>