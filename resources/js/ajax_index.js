$(document).ready(function(){

    $(document).on('click', '.btn-delete', function(){
        var id = $(this).attr('id');
        var action = 'delete';
        $.ajax({
            url:"ultis/code.php",
            method:"POST",
            data:{id:id, action_fb:action},
            dataType:"json",
            success:function(data)
            {
                if(data === 1){
                    window.location.href = "/Franchise/resources/index.php";
                }

            }
        });
    });


});