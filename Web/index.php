<?php 
	require "../vendor/autoload.php";
    $request = new OCFram\HTTPRequest;
    
echo $request->method();
 ?>