<!--html>
<head>
	<title>Gastos</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
</head>
<body-->
<?php
    $period = date("yy-m");
    $importe = $_POST["importe"];
    $concepto = $_POST["concepto"];
    $id_categoria = $_POST["categoria"];

    $servername = "*****";
    $database = "*****";
    $username = "*****";
    $password = "*****";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    $conn->set_charset("utf8");
    
    // Check connection
    if ($conn->connect_error) {
      echo "I'm dead";
      die("Connection failed: " . $conn->connect_error);
    } 
    
//Nombre de la categoría
    $categoria_q = $conn->query("SELECT nombre FROM categorias WHERE id = $id_categoria");
    foreach($categoria_q as $c): $categoria = $c['nombre'];
    endforeach;

//Insert de valores
    $insert_q = "INSERT INTO gastos (importe, concepto, id_categoria) VALUES ($importe, '$concepto', $id_categoria)";
    $conn->query($insert_q);
    echo "Añadidos $importe € de $concepto en $categoria.<br><br>";

    $conn->close();
?>
<!--/body>
</html--> 