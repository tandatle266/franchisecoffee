<?php
    include_once('../vendors/security.php');
    include_once('includes/header.php');

spl_autoload_register(static function ($class) {
    $path = __DIR__ ."../vendors/$class.php";
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
                    <a href="customer.php" class="active"><span class="las la-users"></span>
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
            <div class="recent-grid-customer">           
                <div class="customers">
                    <div class="card">
                        <div class="card-header">
                            <h3> Franchises</h3>
<!--                            <button>See all <span class="las la-arrow-right"></span></button>-->
                        </div>
                        <div class="card-body">
                        <?php
                            $obj = new DBFranchise();
                            $check = $obj->getByStatus(1);
                                                 
                                                 foreach($check as $row)
	                                            {
                                                    switch($row->getType())
                                                    {
                                                        
                                                        case 1 : $type = 'Shiny store';break;
                                                        case 2 : $type = 'Shiny kiosk'; break;
                                                        case 3 : $type = 'Shiny cart'; break;
                                                        
                                                    }
                                                    echo '
                                                    <div class="custom">
                                                        <div class="customer">
                                                            <div class="info">
                                                                <span class="las la-user"></span>
                                                                <div>
                                                                    <h4>'.$row->getFullname().'</h4>
                                                                    <small>'.$type.'</small>
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
                                                         
                                                    </div> 
                                                    
                                                    ';
                                                }     

                                            ?>
                            <!-- <div class="custom">
                                <div class="customer">
                                    <div class="info">
                                        <span class="las la-user"></span>
                                        <div>
                                            <h4>Donald Trump</h4>
                                            <small>Shiny store</small>
                                        </div>
                                    </div>
                                    <div class="contact">
                                        <span class="las la-user-circle"></span>
                                        <span class="las la-comment"></span>
                                        <span class="las la-phone"></span>
                                    </div>
                                    
                                </div>
                                
                            </div> -->
                            
                            
                        
                        </div>
                        
                    </div> 
                </div>


                <?php
                    $count = $obj->getByStatus(2);
                    $store=0;
                    $kiosk=0;
                    $cart=0;
                    foreach ($count as $x){
                        switch($x->getType())
                        {

                            case 1 :$store++;break;
                            case 2 : $kiosk++; break;
                            case 3 : $cart++; break;

                        }
                    }
                ?>
                


                <div class="image">
                    <div class="franchise">
                        <img src="./img/cart(1).png" style="max-width:200px;max-height:200px">
                        <div class="content">
                            <h3 >Cart</h3>
                            <span class="las la-map-marker-alt">
                                 <?php
                                 echo $cart;

                                 ?>
                            </span>
                        </div>
                    </div>
                    <div class="franchise">
                        <img src="./img/store.png" style="max-width:300px;max-height:300px">
                        <div class="content">
                            <h3 >Store</h3>
                            <span class="las la-map-marker-alt">
                                <?php
                                echo $store;

                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="franchise">
                        <img src="./img/kiosk.png" style="max-width:200px;max-height:200px">
                        <div class="content">
                            <h3 >Kiosk</h3>
                            <span class="las la-map-marker-alt">
                                <?php


                                echo $kiosk;

                                ?>

                            </span>
                        </div>
                    </div>
                </div>

            </div>
         
        </main>

        <?php 
    /* include_once('includes/scripts.php');  */
    include_once('includes/footer.php'); 

?>