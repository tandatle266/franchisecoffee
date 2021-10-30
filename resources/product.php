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
                { echo '
                                <li>
                                    <a href="register.php"><span class="las la-user-circle"></span>
                                    <span>Accounts</span></a>
                                </li>
                                ';
                }
                ?>
                <li>
                    <a href="product.php"  class="active"><span class="las la-box"></span>
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
                Products
            </h1>
            <?php
                  include_once('includes/navbar.php'); 
            ?>





            <div class="recent-grid-register">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>All Products</h3>

                            <button type="button" name="add" id="add">Add <span class="las la-arrow-right"></span></button>
                        </div>
                       
                        <div class="card-body">
                        
                        
                        <?php
                            if(isset($_SESSION['status']) && $_SESSION['status'] !='' )
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

        <div class="bg-modal  product">
            <div class="modal-contents ">

                <div  class="close"> <span onclick="closeProductFunction()" class="las la-times"></span>
                    
                </div>
                <span class="las la-boxes avt"></span>

                    <form  id="myForm" action="ultis/code.php" method="POST" enctype="multipart/form-data">
                        <h1>Edit Product Item</h1>
                        <label for="itname">Item name:</label><br>
                        <input type="text" id="item_name" name="name" required>
                        <label for="price">Price:</label><br>
                        <input type="text"  id="item_price"  name="price" required>
                        <label for="ittype">Type:</label><br>
                        <select id="item_type" name="type" >
                            <option value="coffee">Coffee</option>
                            <option value="tea">Tea</option>
                        </select><br>
                        <label>Image:</label>
                        <input type="file" name="fileToUpload" id="fileToUpload">



                        <input type="hidden" name="action_pro" id="action_pro" value="insert" />
                        <input type="hidden" name="item_id" id="hidden_id" />
                        <input  type="submit"  id="form_action"  value="Insert"   />
                    </form>
            
            </div>          
        </div>

        <?php 
    include_once('includes/scripts.php'); 
    include_once('includes/footer.php'); 

?>
<script src='./js/ajax_pro.js'></script>