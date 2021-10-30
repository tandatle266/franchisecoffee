<?php

//fetch.php
include_once(__DIR__ .'/../../vendors/security.php');
spl_autoload_register(static function ($class) {
    $path = __DIR__ . "/../../resources/Php/DBhandle/$class.php";
    $path2 = __DIR__ . "/../../resources/Php/customer/$class.php";

    if (file_exists($path)) {
        //tell php that $path is safe to run.
        /** @noinspection PhpIncludeInspection */
        include_once($path);
        return true;
    }if (file_exists($path2)) {
        //tell php that $path is safe to run.
        /** @noinspection PhpIncludeInspection */
        include_once($path2);
        return true;
    }

});
$obj =new DBShopping();
$check = $obj->getAll();



$output = '
<table class="table-boder" id="dataTable" width="100%">
	<thead>
		<tr>
			<td>Icon</td>
			<td>Name</td>
			<td>Customer</td>
            <td>Actions</td>			
		</tr>
	</thead>
';
if($check !=[])
{
    foreach($check as $row)
    {
        switch($row->getStatus())
        {

            case 0 : $type = '<span class="las la-exclamation icon">';
                $name = 'Waiting';
                $action = '
                                    <button   type="button" class="btn_edit_order btn" id="'.$row->getCusid().'"  name="processing"> 
                                    <span class="las la-ellipsis-h"></span>
                                    </button>
                                    <button   type="button" class="btn_edit_order btn" id="'.$row->getCusid().'"  name="done" >
                                    <span class="las la-check"></span>
                                    </button>';
                break;
            case 1 : $type = '<span class="las la-ellipsis-h icon"></span>';
                $name = 'Processing';
                $action = '<button   type="button" class="btn_edit_order btn" id="'.$row->getCusid().'"  name="waiting" > 
                                    <span class="las la-exclamation"></span>
                                    </button>
                                     
                                    <button   type="button" class="btn_edit_order btn" id="'.$row->getCusid().'"  name="done" >
                                    <span class="las la-check"></span>
                                    </button>';
                break;
            case 2 : $type = '<span class="las la-check icon"></span>';
                $name = 'Done!';
                $action = '<button   type="button" class="btn_edit_order btn" id="'.$row->getCusid().'"  name="waiting" >
                                    <span class="las la-exclamation"></span>
                                    </button>
                                    <button   type="button" class="btn_edit_order btn" id="'.$row->getCusid().'"  name="processing" >
                                    <span class="las la-ellipsis-h"></span>
                                    </button>';
                break;

        }
        $username = $_SESSION['username'];
        $obj = new DBUser();
        $type1=$obj->getType((string)$username);
        if($type1!=="C")
        {
            $action .='<button   type="button" class="btn_delete_order btn" id="'.$row->getCusid().'"  name="delete_task_order" >
                                    <span class="las la-times"></span>
                                    </button>';
        }
        $output .= '
		<tbody>
		<tr>
            <td>'. $type.'</td>
			<td>'. $name.'</td>
			<td>'. $row->getFullname().'</td>
			
            
			
			<td>
			
				<form method="POST" id="regis_form">
					<input type="hidden" id="regis_id" name="edit_id" value="'. $row->getCusid().' ">
                    '.$action.'
                    
                

					
				</form>
					
			</td>
			
		</tr>
		';
    }
}
else
{
    $output .= '
	<tbody>
	<tr>
		<td colspan="4" style="text-align: center;">Data not found</td>
	</tr>
	';
}
$output .= '</tbody>
			</table>'
;
echo $output;
?>