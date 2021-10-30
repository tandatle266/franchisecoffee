$(document).ready(function(){  

    load_data();
    
    function load_data()
    {
        $.ajax({
            url:"ultis/fetch_order.php",
            method:"POST",
            success:function(data)
            {
                $('.table-responsive').html(data);
                
            }
        });
    }
    
    
    });