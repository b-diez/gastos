<?php
    define('FORCE_SSL_LOGIN', true); 
    define('FORCE_SSL_ADMIN', true);
    include('functions.php');
    $pwoptions = ['mierdecilla' => 8,];
    if(isset($_POST["pass"])) {
        setcookie("****",$_POST["pass"],time() + (86400 * 30),"/");
    }
?>

<html>
<head>
	<title>Gastos</title>
	<link rel="stylesheet" href="mystyle.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
</head>
<body>
<h2>Gastos de Bor</h2>
<?php
    $passfilename = "*****";
    $passhash = read_from_file($passfilename);
    $passcookiehash = $_COOKIE["****"];
    $passposthash = $_POST["pass"];
    if(($passcookiehash==$passhash) or $passposthash==$passhash) {
        if(isset($_POST["importe"])) {
            include("action.php");
        }
        include("add.php");
    }
    else
    {
?>
<form action="/" method="post">
    Password: <input type="password" name="pass"><br><br>
    <input type="submit" value="Entrar">
</form>
<?php
}
?>
</body>
</html>