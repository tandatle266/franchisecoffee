<?php

//fetch.php
include_once(__DIR__ .'/../../vendors/security.php');
spl_autoload_register(static function ($class) {
    $path = __DIR__ . "/../../resources/Php/DBhandle/$class.php";
    $path2 = __DIR__ . "/../../resources/Php/account/$class.php";
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

$type = $_SESSION['type'];
$obj = new DBUser();
$arr = $obj->getByStatus(1);
$output = '
<table class="table-boder" id="dataTable" width="80%">
	<thead>
		<tr>
			<td>ID</td>
			<td>UserName</td>
			<td>Date </td>
			<td>Type</td>
			<th colspan="2">Action</th>   
		</tr>
	</thead>
';
if($arr!==[]) {
    foreach ($arr as $row) {
        switch ($row->getType()) {
            case 'A' :
                $role_name = 'Sp_Admin';
                break;
            case 'B' :
                $role_name = "Admin";
                break;
            case 'C' :
                $role_name = "Staff";
                break;
        }
        $output .= '
		<tbody>
		<tr>
			<td>' . $row->getId() . '</td>
			<td>' . $row->getUserName() . '</td>
			<td>' . $row->getDate() . '</td>
			<td>' . $role_name . '</td>
			<td>';
        if($type =='B') {
            if($role_name == "Staff") {
                $output .= '
			    <form method = "POST" id = "regis_form" >
					<input type = "hidden" id = "regis_id" name = "edit_id" value = "' . $row->getId() . ' " >
					<button   type = "button" class="btn-edit" id = "' . $row->getId() . '"  name = "edit_btn" >
					<span class="las la-edit" ></span >
					</button > 
					</form >';
            }
        }
        else{
            $output .= '
			    <form method = "POST" id = "regis_form" >
					<input type = "hidden" id = "regis_id" name = "edit_id" value = "' . $row->getId() . ' " >
					<button   type = "button" class="btn-edit" id = "' . $row->getId() . '"  name = "edit_btn" >
					<span class="las la-edit" ></span >
					</button > 
					</form >
            
			</td>
			<td>
				<form id="regis_form" action="ultis/code.php" method="POST">
					<input type="hidden" name="delete_id" value="' . $row->getId() . ' ">
					<button type="button"  class="btn-delete" id="' . $row->getId() . '"  name="delete_btn">
					<span class="las la-trash-alt"></span>
					</button>
				</form>
				
			</td>
		</tr>
		';
        }
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