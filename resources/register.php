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
                    <a href="order.php"><span class="las la-shopping-bag"></span>
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
                        <a href="register.php" class="active"><span class="las la-user-circle"></span>
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





            <div class="recent-grid-register">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>All Accounts</h3>

                            <button type="button" name="add" id="add">Register <span class="las la-arrow-right"></span></button>
                        </div>
                       
                        <div class="card-body">

                        <?php
                            if(isset($_SESSION['status']))
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

         <div class="bg-modal">
            <div class="modal-contents">

             <div onclick="someOtherFunction()" class="close"> <span class="las la-times"></span>
                
                </div>

                <form  id="myForm"  method="POST" novalidate>
                    <h1>Edit User Profile</h1>
                    <label for="user">Full name:</label><br>
                    <input type="text" id="full_name" name="fullname" required>
                    <label for="user">Id card:</label><br>
                    <input type="text" id="id_card" name="idcard" required>
                    <label for="user">Email:</label><br>
                    <input type="text" id="email" name="email" required>
                    <label for="user">Phone:</label><br>
                    <input type="text" id="phone" name="phone" required>
                    <div class="user_hide">
                    <label  for="user">User name:</label><br>
                    <input type="text" id="edit_user"  name="user_name" required>
                    </div>
                    <div class="user_hide">
                    <label  for="psw">Password:</label><br>
                    <input type="password"  id="edit_psw"  name="password" required>
                    </div>
                    <select id="edit_ad" name="type" >
                        <option value='A' <?php if($type==="B") echo 'disabled'; ?>>Super Admin</option>
                        <option value='B'>Admin</option>
                        <option value='C' selected>Staff</option>
                    </select>
                    <input type="hidden" name="action" id="action" value="insert" />
					<input type="hidden" name="id" id="hidden_id" />
                    <input  type="submit"  id="form_action"  value="Insert"   />

                </form>
            </div>
         
        </div>

        <?php 
    include('includes/scripts.php'); 
    include_once('includes/footer.php'); 

?>


<script src='./js/ajax.js'></script>
<script src='./js/sweetalert.min.js'></script>
