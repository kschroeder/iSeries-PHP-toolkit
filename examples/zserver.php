<?php 
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	?>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">

<title>i5_program_call</title>
<link rel="stylesheet" type="text/css" href="php.css">
</head><body>
<center>
<h3>Calling an RPG program using i5_program_call</h3>
<form method="post" action="zserver">

<table border="0">
<tbody><tr>
<th align="right">Code:</th>
<td><input name="code" type="text"></td>

<th align="right">(Valid Code is 1 or 2)</th>
</tr>

<tr>
<td colspan="2" align="right"><input type="reset"> <input value="Call 
program" type="submit"></td>
</tr>

</tbody></table>
</form>
</center>
</body></html>
	<?php
	exit;
}
?>
#Valid code value is 1 or 2.

<?php

require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance()->setFallbackAutoloader(true);

set_include_path(
	get_include_path()
	. PATH_SEPARATOR
	. realpath(dirname(__FILE__).'/../library')
);

require_once 'models/CommonPgm.php';
$mgr = new Itk_Connection_Manager(
	array(
		'adapter'		=> 'Live',
		'username'		=> '',
		'password'		=> '',
		'host'			=> '127.0.0.1'			
	)
);
Itk_PgmAbstract::setDefaultAdapter($mgr->getAdapter());

$model = new Model_CommonPgm();
$model->CODE = $_POST['code'];
$result = $model->execute();
echo "The return values are: <br>", "Code: ", $result->CODE, "<br> Description: ", $result->DESC,"<br>";