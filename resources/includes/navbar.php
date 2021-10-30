<?php
spl_autoload_register(static function ($class) {
    $path = __DIR__ . "/../../resources/Php/DBhandle/$class.php";
    if (file_exists($path)) {
        //tell php that $path is safe to run.
        /** @noinspection PhpIncludeInspection */
        include_once($path);
        return true;
    }


    return false;
});
?>
<!--<div class="search-wrapper">-->
<!--                <span class="las la-search"></span>-->
<!--                <input type="search" placeholder="Search here" />-->
<!--            </div>-->

            <div class="user-wrapper">
                <img src="./img/customer-3.jpg" width="30px" height="30px" alt="avatar">
                <div>
                <?php
                    $username = $_SESSION['username'];
                    echo'<h4>'.$username.'</h4>'     ;
                    switch($_SESSION['type']){
                        case  "A": $type ='Super Admin';break;
                        case  "B": $type ='Admin';break;
                        case  "C": $type ='Staff';break;
                    }
                        echo '
                        <div class="dropdown">
                        
                        <small>'.$type.'</small>                   
                        <div class="dropdown-content">
                            <form method="POST" action="./ultis/code.php">
                                <button   type="submit"   name="btn_out" >Log Out</button>
                            </form> 
                        </div>
                        </div>
                        '
                        

                        ;

                    ?>

                </div>
            </div>
        </header>


<main>
            <div class="cards">
                <div class="card-single">
                    <div>
                        <?php
                            $obj = new DBUser();
                            $row=$obj->countByStatus(1);
                            echo '<h1> '.$row.'</h1>';
                        ?>
                        
                        <span>Account</span>
                    </div>
                    <div>
                        <span class="las la-users"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <?php
                          //franchise
                            $obj = new DBFranchise();
                            $row=$obj->countByStatus(2);
                            echo '<h1> '.$row.'</h1>';
                        ?>
                        <span>Franchise</span>
                    </div>
                    <div>
                        <span class="las la-box"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <?php
                        //shopping
                        $obj = new DBShopping();
                        $row=$obj->countByStatus(2);
                        echo '<h1> '.$row.'</h1>';
                        ?>
                        <span>Order</span>
                    </div>
                    <div>
                        <span class="las la-shopping-bag"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div >
                        <div>
                        <div class="task">
                            <?php

                            $obj = new DBShopping();
                            $row= $obj->countByStatus(0);
                            $obj = new DBFranchise();
                            $row1=$obj->countByStatus(0);
                            echo '<h1> '.($row+$row1).'</h1>';
                            ?>
                            <h6>Waiting</h6>
                        </div>
                        <div class="task">
                            <?php
                            $obj = new DBShopping();
                            $row2= $obj->countByStatus(1);
                            $obj = new DBFranchise();
                            $row3=$obj->countByStatus(1);
                            echo '<h1> '.($row2+$row3).'</h1>';
                            ?>
                            <h6>Processing</h6>
                        </div>
                    </div>

                        <span>Task</span>

                    </div>
                    <div>
                        <span class="las la-clipboard-list"></span>
                    </div>
                </div>

            </div>
            
       
        
   
