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
                    <a href="index.php" class="active"><span class="las la-igloo"></span>
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
                Dashboard
            </h1>
            <?php
                  include_once('includes/navbar.php'); 
            ?>
    <div class="recent-grid-index" >


        <div class="customers">
            <div class="card">
                <div class="card-header">
                    <h3>Feedbacks</h3>

<!--                    <button type="button" name="delete_multi" class="btn_delete_all">Delete <span class="las la-arrow-right"></span></button>-->

                </div>
                <div class="card-body">

                    <?php
                    $obj = new DBFeedBack();
                    $check = $obj->getALL();


                    foreach($check as $row)
                    {
                        echo '                        
                                                            <div class="custom">
                                                       
                                                                <div class="customer">                                                      
                                                                    <div class="info">                                                         
                                                                        <span class="las la-user"></span>
                                                                        <div>
                                                                            <h4>'.$row->getFullname().'</h4>
                                                                            <small>'.$row->getDate().'</small>                                                             
                                                                           </div>
                                                                    </div>
                                                                    <div class="contact">
                                                                        <div class="dropdown">
                                                                            <span class="las la-map-marked"></span>
                                                                            <div class="dropdown-content">
                                                                                <p>'.$row->getAddress().'</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="dropdown">    
                                                                        <span class="las la-comment"></span>
                                                                        <div class="dropdown-content">
                                                                            <p>'.$row->getEmail().'</p>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="dropdown">     
                                                                    <span class="las la-phone"></span>
                                                                    <div class="dropdown-content">
                                                                            <p>'.$row->getPhone().'</p>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                        
                                                                </div>
                                                                <div class="comment">
                                                                        
                                                                        <p>'.$row->getContent().'</p>
                                                                </div>
                                                                <form id="regis_form"  method="POST">
                                                                    <button type="submit"  class="btn-delete" id="' . $row->getCusid() . '"  name="delete_feedback">
                                                                    <span class="las la-trash-alt"></span>
                                                                    </button>
                                                                </form>
                                                            </div> 
                                                            
                                                            ';
                    }

                    ?>





            </div>
        </div>
    </div>
    </div>
         
        </main>

        <?php 
    /* include_once('includes/scripts.php');  */
        include('includes/scripts.php');
        include_once('includes/footer.php');

?>
        <script src='./js/ajax_index.js'></script>