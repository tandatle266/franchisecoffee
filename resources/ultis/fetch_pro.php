<?php

//fetch.php
include_once(__DIR__ .'/../../vendors/security.php');
spl_autoload_register(static function ($class) {
    $path = __DIR__ . "/../../resources/Php/DBhandle/$class.php";
    $path2 = __DIR__ . "/../../resources/Php/item/$class.php";
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
$username = $_SESSION['username'];
$obj1 = new DBUser();
$type = $obj1->getType((string)$username);


$obj = new DBItem();
$arr = $obj->getALL();
$output = '
<table class="table-boder" id="dataTable" width="80%">
	<thead>
		<tr>
			<td>Id</td>
			<td>Name</td>
			<td>Price</td>
			<td>Type</td>
			<td>Image</td>
			<th colspan="2">Action</th>   
		</tr>
	</thead>
';
if($arr!==[]) {
    foreach ($arr as $row) {

        $output .= '
		<tbody>
		<tr>
			<td>' . $row->getItemId() . '</td>
			<td>' . $row->getName() . '</td>
			<td>' . $row->getPrice() . '</td>
			<td>' . $row->getType() . '</td> 	
			
			<td><img src="./Php/fileService/uploads/item/' . $row->getImage() . '"   width="50" height="60"></td>';



        if ($type !== "C") {
            $output .=

                '
            <td>    
                <form method="POST" id="regis_form">
					<input type="hidden" id="regis_id" name="edit_id" value="' . $row->getItemId() . ' ">
					<button   type="button" class="btn-edit" id="' . $row->getItemId() . '"  name="edit_btn" >
					<span class="las la-edit"></span>
					</button> 
					</form>
					
			</td>
			<td>
				<form id="regis_form"  method="POST">
					<button type="submit"  class="btn-delete" id="' . $row->getItemId() . '"  name="delete_pro">
					<span class="las la-trash-alt"></span>
					</button>
					</form>
				
			</td>
		</tr>';
        } else {
            $output .=
                '<td colspan="2">
				
				
			</td>
		</tr>';

        }
    }

}






else
{
    $output .= '
	<tbody>
	<tr>
		<td colspan="7" style="text-align: center;">Data not found</td>
	</tr>
	';
}
$output .= '</tbody>
			</table>'
;
echo $output;
?>