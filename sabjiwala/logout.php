<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php

session_start();

unset($_SESSION["username"]);
unset($_SESSION["uname"]);
		$_SESSION['loginstatus']="";
		session_destroy();
		header("location:../index.php");
?>
</body>
</html>