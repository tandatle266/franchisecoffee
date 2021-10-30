<?php

//fetch.php
/* SELECT a.fullname,e.name,e.price,e.quantity
FROM customer a
INNER JOIN (
SELECT f.fullname,a.name,a.price,a.item_id,d.quantity
            FROM item a ,product d,
            (
            
            SELECT b.fullname,c.item_id
            FROM customer b,shopping c
            WHERE b.cus_id=c.cus_id) f
            WHERE d.item_id =f.item_id AND d.item_id =a.item_id

)e ON a.fullname=e.fullname
            
            
           SELECT f.fullname,a.name,a.price,a.item_id,d.quantity
            FROM item a ,product d,
            (
            
            SELECT b.fullname,c.item_id
            FROM customer b,shopping c
            WHERE b.cus_id=c.cus_id) f
            WHERE d.item_id =f.item_id AND d.item_id =a.item_id
            */

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


$out = array();
$prevSizeVal = null;
$sizeStartRow = 0;
$counter = 0;
$b = 1;


$obj = new  DBShopping();
$check = $obj->getByStatus(1);
$output = '
<table class="table-boder" id="dataTable" width="80%">
	<thead>
		<tr>
                        <td>Customer</td>
			<td>Item</td>
			<td>Cost</td>
			<td>Qty</td>
                        <td>Total</td>
			
			
		</tr>
	</thead>
';
if($check!==[])
{
	foreach($check as $rowarray)
	{
        foreach($rowarray->getArray() as $row) {

            $a = array();
            $a[1] = '<td>' . $row->getName() . '</td>';
            $a[2] = '<td>' . $row->getPrice() . '</td>';
            $a[3] = '<td>x ' . $row->getQuantity() . '</td>';
            $a[4] = '<td>' . $row->getPrice() * $row->getQuantity() . '</td>';
            $sizeCol = '';

            //now for the fun part with the size column
//            var_dump($rowarray->getCusId());
            if ($prevSizeVal !==$rowarray->getCusId() ) {

                $sizeStartRow = $counter;
                $sizeCol = '<td rowspan="1">' . $rowarray->getFullname() . '</td>';
            } else {
                //change the rowspan value at the start position, as we know it's increased
                $out[$sizeStartRow][0] = preg_replace('/rowspan="\d+"/', 'rowspan="' . ($counter - $sizeStartRow + $b) . '"', $out[$sizeStartRow][0]);

            }

            $a[0] = $sizeCol;

            $out[$counter] = $a; //add the row to the output. We may change the rowspan of the size cell later.
            $prevSizeVal = $rowarray->getCusId(); //update the previous size value
            $counter++;

        }
	}
	$length=count($out);
                for ($i = 0; $i < $length; $i++)
                {
                        $output.= '
                                        <tr>';
                        //loop the cells within the current row
                    $temp=count($out[$i]);
                        for ($j = 0; $j <$temp; $j++)
                        {
                                if($out[$i][$j] != '')
                                {
                                        $cell = $out[$i][$j];                        
                                        $output .= $cell;                                    
                                }
                                
                        }
                        $output.= '
                                        </tr>';
                }
            
                        
                        
                        
                            
                        
}
else
{
	$output .= '
	
	<tr>
		<td colspan="5" style="text-align: center;">Data not found</td>
	</tr>
	';
}
$output .= '
			</table>'
			;
echo $output;
?>