$(document).ready(function(){  

    load_data();

    function load_data()
    {
        $.ajax({
            url:"ultis/fetch_pro.php",
            method:"POST",
            success:function(data)
            {
                $('.table-responsive').html(data);
                
            }
        });
    }
    
    $(".product").hide();
    
    $('#add').click(function(){
		$(".product").show();
		$('#action_pro').val('insert_pro');
		$('#form_action').val('Insert');
		$('#myForm')[0].reset();
        $('#form_action').attr('disabled', false);
        
		
	});
    


    $(document).on('click', '.btn-edit', function(){
        $(".product").show();
        var id = $(this).attr('id');
		var action_pro = 'fetch_single_pro';
        $.ajax({
			url:"ultis/code.php",
			method:"POST",
			data:{id:id, action_pro:action_pro},
			dataType:"json",
			success:function(data)
			{
                $('#item_name').val(data.name);
				$('#item_price').val(data.price);
				$(".modal-contents select").val(data.type);
                $('#action_pro').val('update_pro');
				$('#hidden_id').val(data.id);
				$('#form_action').val('Update');
                $(".product").show();

				}
			});
    });
	$(document).on('click', '.btn-delete', function(){
		var id = $(this).attr('id');
		var action = 'delete_pro';
		$.ajax({
			url:"ultis/code.php",
			method:"POST",
			data:{id:id, action_pro:action},
			dataType:"json",
			success:function(data)
			{
				if(data === 1){
					window.location.href = "/Franchise/resources/product.php";
				}

			}
		});
	});
    
  
    

});  
