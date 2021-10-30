<script src="../resources/js/script.js"></script>

<script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="../js/sweetalert.min.js"></script>


<?php
    if(isset($_SESSION['status']) && $_SESSION['status'] !='' )
    {
        ?>
            <script>
                swal({
                        title: "<?php echo $_SESSION['status'];?>",
                        icon: "<?php echo $_SESSION['status_code']; ?>",
                        button: "OK Done!",
                        });
            </script>
        <?php
        unset($_SESSION['status']);
        
    }
?>