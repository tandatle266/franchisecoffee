<?php


include_once(__DIR__ .'/includes/header.php');
include_once(__DIR__ .'/../vendors/security.php');
spl_autoload_register(static function ($class) {
    $path = __DIR__ ."/../vendors/$class.php";
    $path2 = __DIR__ . "/../resources/Php/DBhandle/$class.php";
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
?>

<ul>
                <li>
                    <a href="index.php" ><span class="las la-igloo"></span>
                    <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="customer.php"><span class="las la-users"></span>
                    <span>Franchise</span></a>
                </li>
                <li>
                    <a href="order.php" class="active"><span class="las la-shopping-bag"></span>
                    <span>Orders</span></a>
                </li>
    <?php
    $username = $_SESSION['username'];
    $obj = new DBUser();
    $type=$obj->getType((string)$username);
    $_SESSION['type']=$type;
    if($type!=="C")
    {
        echo '
                    <li>
                        <a href="register.php"><span class="las la-user-circle"></span>
                        <span>Accounts</span></a>
                    </li>
                    ';
    }
    ?>
                <li>
                    <a href="product.php"><span class="las la-box"></span>
                    <span>Products</span></a>
                </li>
    <?php
    if($type!=="C")
    {
        echo '
                <li>
                    <a href="task.php"><span class="las la-clipboard-list"></span>
                    <span>Tasks</span></a>
                </li>
                          ';
    }
    ?>
            </ul>

        </div>
    </div>


<div class="main-content">
        <header>
            <h1>
                <label for="nav-toggle">
                    <span class="las la-bars"></span>
                </label>
                Accounts
            </h1>
            <?php
                  include_once('includes/navbar.php'); 
            ?>
        </header>




            <div class="recent-grid-register">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>All Orders</h3>

<!--                            <button type="button" name="add" id="add">Register <span class="las la-arrow-right"></span></button>-->
                        </div>
                       
                        <div class="card-body">

                        <?php
                            if(isset($_SESSION['status'])  )
                            {
                               
                                echo '<h2>'.$_SESSION['status'].' </h2>';
                                unset($_SESSION['status']);
                                
                            }
                        ?>

                            <div class="table-responsive" style="margin-left:10%;">
                                    
                            </div>
                        </div>
                    </div> 
                </div>

            </div>
         
        </main>
                        

        

         <!-- Modal Edit -->

         <!-- <div class="bg-modal ">
            <div class="modal-contents">

             <div onclick="someOtherFunction()" class="close"> <span class="las la-times"></span>
                
                </div>
                <span class="las la-user-secret avt"></span>

                <form  id="myForm"  method="POST">
                    <h1>Edit User Profile</h1>
                    <label for="user">User name:</label><br>
                    <input type="text" id="edit_user"  name="edit_username" required>
                    <label for="psw">Password:</label><br>
                    <input type="text"  id="edit_psw"  name="edit_psw" required>
                    <select id="edit_ad" name="edit_ad" >
                        <option value="1">Super Admin</option>
                        <option value="2">Admin</option>
                        <option value="3">Staff</option>
                        
                    
                    </select>
                    <input type="hidden" name="action" id="action" value="insert" />
					<input type="hidden" name="hidden_id" id="hidden_id" />
                    <input  type="submit"  id="form_action"  value="Insert"   />
                </form>
            </div>
         
        </div> -->

        <?php 
    include('includes/scripts.php'); 
    include_once('includes/footer.php'); 

?>


    <script src='./js/ajax_order.js'></script>
<!-- <script src='./js/sweetalert.min.js'></script>
 -->