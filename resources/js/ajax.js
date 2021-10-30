$(document).ready(function(){  

    load_data();

    function load_data()
    {
        $.ajax({
            url:"ultis/fetch.php",
            method:"POST",
            success:function(data)
            {
                $('.table-responsive').html(data);
                
            }
        });
    }
    
    $(".bg-modal").hide();
    
    $('#add').click(function(){
		$(".bg-modal").show();
		$('#action').val('insert');
		$('#form_action').val('Insert');
		$('#myForm')[0].reset();
        $('#form_action').attr('disabled', false);
        $(".user_hide").show();
		
	});
    

    $('#myForm').on('submit', function(event){
        
        $(".bg-modal").show();
        $('#form_action').attr('disabled', 'disabled');
		var form_data = $(this).serialize();
			$.ajax({
				url:"ultis/code.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					$(".bg-modal").hide();
					 load_data();
					$('#form_action').attr('disabled', false);
				}
			});
		
		
	});
    $(document).on('click', '.btn-edit', function(){
        $(".bg-modal").show();
        $(".user_hide").hide();
        var id = $(this).attr('id');
		var action = 'fetch_single';
        $.ajax({
			url:"ultis/code.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
                $('#full_name').val(data.fullname);
				$('#id_card').val(data.idcard);
                $('#email').val(data.email);
                $('#phone').val(data.phone);
				$("div.modal-contents select").val(data.type);
                $('#action').val('update');
				$('#hidden_id').val(data.id);
				$('#form_action').val('Update');
                $(".bg-modal").show();

				}
			});
    });


    $(document).on('click', '.btn-delete', function(){
        var id = $(this).attr('id');
        var action = 'delete';
        $.ajax({
            url:"ultis/code.php",
            method:"POST",
            data:{id:id, action:action},
            dataType:"json",
            success:function(data)
            {
                if(data === 1){

                    window.location.href = "/Franchise/resources/register.php";
                }

            }
        });
    });

    
});  
