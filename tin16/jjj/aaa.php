<?php
echo "<html><head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<link href='./main.css' rel='stylesheet' type='text/css' />";
echo "<style type='text/css'>
body{ text-align:center} 
#divcenter{margin:0 auto;width:800px}</style>
</head><body>";

echo "</body></html>";
?>
<?php
include_once("/var/www/counter.php");
upcounter(__FILE__)
?>
