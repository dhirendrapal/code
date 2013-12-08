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
	$ndd[] = $dd['Chart_title'];
}
print_r($ndd);