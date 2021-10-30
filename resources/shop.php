
<!DOCTYPE html>
<html lang="vi">
<head>
    <!-- cần thiết khi thiết kế responsive website -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!--  sắp xếp file theo order (thể hiện file nào sẽ bị overwriten) !-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">    <link href="../vendors/css/normalize.css" rel="stylesheet" type="text/css">
    <link href="../vendors/css/Grid.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../vendors/css/ionicons.min.css">
    <link href="../resources/css/styleshop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../resources/css/queriesshop.css" type="text/css">
    <!-- favicons-->
    <link rel="apple-touch-icon" sizes="180x180" href="../resources/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../resources/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../resources/favicons/favicon-16x16.png">
    <link rel="manifest" href="../resources/favicons/site.webmanifest">
    <link rel="mask-icon" href="../resources/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="../resources/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="../resources/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!--/favicons-->

    <title>shop Shiny</title>

</head>

<body>

<header>
    <nav class="">
        <div class="row">
            <img src="../resources/img/white-logo.png" alt="Shiny Coffee logo-white" class="logo">
            <img src="../resources/img/color-logo.png" alt="Shiny Coffee logo" class="logo-black">


            <ul class="main-nav js--main-nav ">

                <li>
                    <a href="./index.html">Trang chủ</a>
                </li>
                <li>
                    <a href="#section-shop">Cửa Hàng</a>
                </li>
                <li>
                    <a href="./franchise.html">NHƯỢNG QUYỀN</a>
                </li>
                <li>
                    <a href="./aboutUs.html">Tìm hiểu thêm</a>
                </li>
                <li class="link-cart--hover" >
                    <a  class="icon--cart"><span class="glyphicon glyphicon-shopping-cart my-cart-icon"><span class="badge badge-notify my-cart-badge"></span></span></a>
                </li>

            </ul>
            <a class="mobile-nav-icon js--mobile-nav-icon"><i class="ion-navicon-round"></i></a>
            <a  class="mobile-icon--cart mobile-nav-icon"><span class="glyphicon glyphicon-shopping-cart my-cart-icon"><span class="badge badge-notify my-cart-badge"></span></span>
            </a>
        </div>
    </nav>

    <div class="hero-text-box">
        <h1>Nắm bắt cơ hội.<br>Cùng nhau tỏa sáng.</h1>
    </div>
</header>
<section class="section-shop js--section-sticky" id="section-shop">
    <div class="shop__header"></div>
    <div id="card_shop" class="row shop__content">
    </div>
    <div class="shop__footer"></div>
</section>
<div class="form--layout " id="redisplay" >
    <div class="form--registration row ">
        <div class=" col span-9-of-10">
            <form method="post" action="shop.php" class="contact-form-shop" id="form-registration" autocomplete="off">
                <input type="hidden" name="getitem" id="getitem">
                <div class="row">
                    <div class="col span-1-of-3">
                        <label for="name">họ và tên:</label>
                    </div>
                    <div class="col span-2-of-3">
                        <input type="text" name="name" id="name" placeholder="nhập họ và tên của bạn" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col span-1-of-3">
                        <label for="email">Email:</label>
                    </div>
                    <div class="col span-2-of-3">
                        <input type="email" name="email" id="email" placeholder="nhập email của bạn" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col span-1-of-3">
                        <label for="phone">số điện thoại:</label>
                    </div>
                    <div class="col span-2-of-3">
                        <input type="phone" name="phone" id="phone" placeholder="nhập số điện thoại của bạn" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col span-1-of-3">
                        <label for="address">địa chỉ giao hàng:</label>
                    </div>
                    <div class="col span-2-of-3">
                        <input type="address" name="address" id="address" placeholder="nhập địa chỉ của bạn" required>
                    </div>
                </div>
                <div class=" display-btn-submit">
                    <div class=" ">
                        <input class="btn my-cart-close" type="button"  id="my-cart-close" name="my-cart-close" onclick="mycartclose()" value="Thoát">
                    </div>
                    <div class="  ">
                        <input class="btn my-cart-checkout" type="submit" id="my-cart-checkout" name="my-cart-checkout" value="Gửi">

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<footer>
    <div class="row">
        <div class="col span-1-of-2">
            <ul class="footer-nav">
                <li>
                    <a href="#">Giới thiệu</a>
                </li>
                <li>
                    <a href="#">cửa hàng</a>
                </li>

                <li>
                    <a href="https://www.apple.com/app-store/" target="_blank">IOS App</a>
                </li>
                <li>
                    <a href="https://play.google.com/store" target="_blank">Android App</a>
                </li>
            </ul>
        </div>
        <div class="col span-1-of-2">
            <ul class="social-link">
                <li>
                    <a href="https://facebook.com/" target="_blank">
                        <i class="ion-social-facebook"></i>
                    </a>
                </li>
                <li>
                    <a href="https://twitter.com/" target="_blank">
                        <i class="ion-social-twitter"></i>
                    </a>
                </li>
                <li>
                    <a href="https://instagram.com/" target="_blank">
                        <i class="ion-social-instagram"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p>ĐỊA CHỈ: 17A Cộng Hòa phương 12 quận Tân Bình TP.HCM</p>
        </div>
        <div cart="col "></div>
    </div>
    <div class="row">
        <div class="col" >
            <p>Số Điện Thoại:0341234567</p>

        </div>

    </div>
    <div class="row">
        <div class="col ">
            <p>email: Shinycoffee@email.com</p>
        </div>

    </div>

    <div class="row">
        <p>
            Copyright of &copy; 2021 by Shiny Coffee. All rights reserved
        </p>
    </div>
    <script>
        function formdisplay(){
            if(document.getElementById('my-cart-empty-message')==null){
                document.getElementById("redisplay").className += " form-display-on";
            }else { alert("chưa có gì trong giỏ hàng");
            }

        }
        function mycartclose(){
            document.getElementById("redisplay").classList.remove("form-display-on");
        }
        function card_shop({id,img, name, price}){
            const card = document.getElementById('card_shop');
            if(card){
                const card_item = document.createElement('div');
                card_item.classList.add('card');
                card_item.classList.add('col');

                card_item.classList.add('span-1-of-5');
                card_item.innerHTML=`
                         <a href="#" class="card-link ">
                        <div class="card-img">
                            <img src="${img}" alt="hình cafe" class="img--coffee">
                        </div>
                        <div class="card-name">
                            <h3 class="name-item">${name}</h3>
                        </div>
                        <div class="card-prices">
                            <h4 class="prices-item">${price} VNĐ</h4>
                        </div>
                    </a>

                    <div class="card-btn">
                        <button class="btn btn-danger my-cart-btn" id="cart-item+${id}"
                                        data-id="${id}" data-name="${name}"
                                            data-price="${price}"
                                                data-quantity="1" data-image="${img}"
                                                     >
                                    ĐẶT HÀNG

                        </button>
                    </div>`;
                card.appendChild(card_item);
            }

        }
        function mytest(checkoutString){

            document.getElementById("getitem").value=[checkoutString]

        }
    </script>
</footer>

<!--download jquery from google hosted libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- help css media queries can execute in old browsers-->
<script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/src/respond.js"></script>
<!-- enbale html5 elements in older browsers not supported html5 -->
<script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/src/html5shiv.js"></script>
<!-- enbale pseudo class css3 in older browsers not supported -->
<script src="https://cdn.jsdelivr.net/npm/selectivizr2@1.0.9/selectivizr2.min.js"></script>
<!-- trigger elements when scrolling to it -->

<script src="../vendors/js/jquery-2.2.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

<script src="../resources/js/scriptlayoutshop.js"></script>

<script src="../resources/js/scriptShop.js"></script>
<script src="../resources/js/jquery.mycart.js"></script>
<script src="../vendors/js/jquery.waypoints.min.js"></script>

<script>
    if (window.history.replaceState) {
        window.history.replaceState (null, null, window.location.href);
    }
</script>
</body>

</html>

<?php
include "../resources/Php/DBhandle/DBItem.php";
include "../resources/Php/DBhandle/DBShopping.php";
$conn = new DBItem();
$result=$conn->getALL();

foreach ($result as $row) {

    ?>
    <script>

        card_shop({
            id:<?=json_encode($row->getItemId())?>,
            img: '../resources/Php/fileService/uploads/item/'+<?=json_encode($row->getImage())?>,
            name:   <?=json_encode($row->getName())?>,
            price: <?=json_encode($row->getPrice())?>,

        })
    </script>
    <?php

}
$conn=null;
?>
<?php
if(isset($_POST['my-cart-checkout'])){
    $array=[$_POST['name'],$_POST['email'],$_POST['phone'],$_POST['address']];
    $integerIDs = array_map('intval', explode(',', $_POST['getitem']));
    $result=array_merge($array,$integerIDs);
    $conn= new DBShopping();
    $conn->insertInto($result);
    $conn=null;
}
unset($_POST, $result);




