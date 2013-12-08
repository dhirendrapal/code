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
	if(!in_array($dd['Chart_title'], $ndd))
	{
		$ndd[] = $dd['Chart_title'];
	}	
}
$i=0;
$ndata =array();
foreach($ndd as $rec)
{
	$ndata[$i]['Chart_title'] = $rec;
	$j=0;
	foreach($data as $res)
	{
		if(in_array($rec, $res))
		{
			$ndata[$i]['column_heading'] = $res['column_heading'];
			unset($res['column_heading']);
			unset($res['Chart_title']);
			$ndata[$i][$j] = $res;
		}
		$j++;
	}
	$j=0;
	$i++;
}
print_r($ndd);print_r($ndata);
?>