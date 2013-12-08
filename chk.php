<?php
$data = array(
				'0' => array('prod_name'=>'T-shirt1',
							'Chart_title' => 'light',
							'column_heading' => 'price|qty',
							'price' => '17.65',
							'qty' => 5
						),
				'1' => array('prod_name'=>'T-shirt2',
							'Chart_title' => 'light',
							'column_heading' => 'price|qty',
							'price' => '16.65',
							'qty' => 4
						),
				'3' => array('prod_name'=>'T-shirt3',
							'Chart_title' => 'light',
							'column_heading' => 'price|qty',
							'price' => '12.65',
							'qty' => 8
						),
				'4' => array('prod_name'=>'shirt3',
							'Chart_title' => 'medium',
							'column_heading' => 'price',
							'price' => '21.65'
						),
				'5' => array('prod_name'=>'T-shirt4',
							'Chart_title' => 'light',
							'column_heading' => 'price|qty',
							'price' => '14.65',
							'qty' => 10
						),
				
			);
echo "<pre>";print_r($data);
$ndd = array();
$cur_title = '';
$column_heading ='';
$i=0;
$status=0;
foreach($data as $dd)
{

	if($cur_title != $dd['Chart_title']) {
		echo "<br>".$i."=====>";
		print_r($ndd);
		$cur_title = $dd['Chart_title'];
		foreach($ndd as $tt)
		{
			if(in_array($dd['Chart_title'],$tt))
			{
				$status = '1';
				break;
			}
			//print_r($tt);
		}
		if($status)
		{$ndd[$i]['chart_title'] = $cur_title; }
		//$j=0;

	}
	/*else{
		$i--;
	}*/
	if($column_heading != $dd['column_heading']) {
		$column_heading = $dd['column_heading'];
		$ndd[$i]['column_heading'] = $column_heading; 
	}
	/*if(in_array($dd['Chart_title'],$dd))
	{
		$ndd[$i][$j]['prod_name'] = $dd['prod_name']!=''?$dd['prod_name']:'';
		$ndd[$i][$j]['price'] = $dd['price']!=''?$dd['price']:'';
		$ndd[$i][$j]['qty'] = @$dd['qty']?$dd['qty']:'0';
	
	
	}
	$j++;*/
	$i++;
}
print_r($ndd);
die;
?>
<table cellpadding="2px;" border='1' style="width:100%;border:1px solid #000000;">
<?php
$cur_title = '';
$column_heading = '';
foreach($data as $rec)
{
	if($cur_title != $rec['Chart_title']) {
	$cur_title = $rec['Chart_title'];
	$crttab = 1;
?>
	<tr><td colspan='3'><?php echo $cur_title;?></td></tr>
	<tr><td>
		<?php //if($crttab) {?>
		<table cellpadding="1px;" border='1' width="100%">
		<tr>	<?php 
		if($column_heading != $rec['column_heading']) {
			$column_heading = $rec['column_heading'];
			$heading = explode('|',$column_heading);
			?><td>Prod Name</td>
	<?php
		foreach($heading as $col) { ?>
		<td><?php echo $col;?></td>
		<?php } } ?>		</tr>
		<?php //} 
		unset($rec['column_heading']) ?>
	<?php } $crttab = 0;unset($rec['Chart_title']);//unset($rec['column_heading']) ?>
	
		<tr>
		<?php foreach($rec as $nrec) {?>
		<td><?php //echo $nrec['prod_name'];
		echo $nrec ?></td>
		<?php } ?>
		</tr>
		<!--</table>-->
	</td></tr>
<?php
}
?>
</table>			
