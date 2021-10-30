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
                    <a href="product.php"><span class="las la-box"></span>
                    <span>Products</span></a>
                </li>
                <li>
                    <a href="task.php" class="active"><span class="las la-clipboard-list"></span>
                    <span>Tasks</span></a>
                </li>
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





            <div class="recent-grid-task">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3> Task Franchise</h3>
                        </div>
                       
                        <div class="card-body">                      

                            <div class="table-responsive" >

                            </div>

                        </div>
                    </div> 
                </div>
                <div class="customers">
                    <div class="card">
                        <div class="card-header">
                            <h3> Task Order</h3>
                        </div>
                        <div class="card-body">
                            <div class="customer">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
         
        </main>
                                

        <?php 
    include('includes/scripts.php'); 
    include_once('includes/footer.php'); 

?>


<script src='./js/ajax_task.js'></script>

