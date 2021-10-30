$(document).ready(function(){

    load_data();

    function load_data()
    {
        $.ajax({
            url:"ultis/fetch_task.php",
            method:"POST",
            success:function(data)
            {
                $('.table-responsive').html(data);

            }
        });
        $.ajax({
            url:"ultis/fetch_task_order.php",
            method:"POST",
            success:function(data)
            {
                $('.customer').html(data);

            }
        });
    }

    $(document).on('click', '.btn_edit', function(){
        var id = $(this).attr('id');
        var action = $(this).attr('name');
        $.ajax({
            url:"ultis/code.php",
            method:"POST",
            data:{id:id, action_task:action},
            dataType:"json",
            success:function(data)
            {

                if(data === 1){
                    window.location.href = "/Franchise/resources/task.php";
                }
            }


        });

    });
    $(document).on('click', '.btn_edit_order', function(){
        var id = $(this).attr('id');
        var action = $(this).attr('name');
        $.ajax({
            url:"ultis/code.php",
            method:"POST",
            data:{id:id, action_task_order:action},
            dataType:"json",
            success:function(data)
            {

                if(data === 1){
                    window.location.href = "/Franchise/resources/task.php";
                }
            }


        });

    });
    $(document).on('click', '.btn_delete_order', function(){
        var id = $(this).attr('id');
        var action = $(this).attr('name');
        $.ajax({
            url:"ultis/code.php",
            method:"POST",
            data:{id:id, action_task_order:action},
            dataType:"json",
            success:function(data)
            {

                if(data === 1){
                    window.location.href = "/Franchise/resources/task.php";
                }
            }


        });

    });
    $(document).on('click', '.btn_delete_task', function(){
        var id = $(this).attr('id');
        var action = $(this).attr('name');
        $.ajax({
            url:"ultis/code.php",
            method:"POST",
            data:{id:id, action_task_order:action},
            dataType:"json",
            success:function(data)
            {

                if(data === 1){
                    window.location.href = "/Franchise/resources/task.php";
                }
            }


        });

    });
});