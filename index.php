<?php
 $search = array(
	   chr(145),
	   chr(146),
	   chr(147),
	   chr(148),
	   chr(150),
	   chr(151), 
	   chr(160), 
	   "<ul>", 
	   "</td>", 
	   chr(226), 
	   "aligncenter\"", 
	   "&amp;",
	   "&bull;");
	   
	   $replace = array("'","'",'&quot;','&quot;','&ndash;','&ndash;', " " , "<ul style=\"margin-left:-39px;list-style-image: url('arrow_right.png');\">", "</td></tr><tr>", "'", "\" style='clear: both;display: block;margin-top: 12px;margin-top: 0.857142857rem;margin-bottom: 12px;margin-bottom: 0.857142857rem;'", "&" ,  '<img src="arrow_right.png">');
		
echo "<pre>";
print_r($search);
print_r($replace);
echo "</pre>";

echo "Welcome Git!!";
?>
