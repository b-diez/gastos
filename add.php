<!--html>
<head>
	<title>Gastos</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
</head>
<body-->
<?php
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
//    echo "Connected successfully</br></br>";

    $period = date("Y-m");
    
    $sql = "SELECT sum(importe) as suma FROM gastos WHERE LEFT(fecha,7) = '$period'";
    $monthly = $conn->query($sql);

    $sql = "SELECT * FROM categorias";
    $cats = $conn->query($sql);
    //Últimas 10 transacciones
    $sql = 
        "
        SELECT
            importe
            ,concepto
            ,LEFT(fecha,10) AS fecha
            ,nombre
        FROM `gastos_view` 
        ORDER BY fecha DESC
        LIMIT 50
        ";
//--WHERE LEFT(fecha,7) = '$period'
    $trans = $conn->query($sql);
    //gastos por categoría
    $sql = "SELECT nombre, SUM(importe) AS suma FROM `gastos_view` WHERE LEFT(fecha,7) = '$period' GROUP BY nombre ORDER BY nombre";
    $gastoscat = $conn->query($sql);
    $conn->close();
?>

Añadir nuevo gasto:<br><br>

<form action="/" method="post">
    Importe: <input type="text" name="importe"><br>
    Concepto: <input type="text" name="concepto"><br>
    Categoría: <select name="categoria">
        <?php foreach($cats as $c): ?>
            <option value="<?= $c['id']; ?>"><?= $c['nombre']; ?></option>
        <?php 
            endforeach; 
        ?>
    </select><br><br>
    <input type="submit" value="Añadir">
</form>
<br>

<?php
//Mostrar importe del mes en curso y desglose por categorías
    echo "Gastos de $period: ";
    foreach($monthly as $m):
?>
<b>
<?php
        $total = $m['suma'];
        echo number_format($m['suma'],2);
        echo " €<br>";
?>
</b>
<?php
    endforeach;
?>
<br>
<?php foreach($gastoscat as $g): 
?>
<?php echo "| ", $g['nombre'], ": ", number_format($g['suma'],2), " €";?>
<br>
<?php echo "| ", str_repeat(".",round($g['suma']/$total*50));?>
<br>
<?php endforeach; ?>
<br>

<!--Tabla con últimas transacciones-->
<table style="width:100%">
  <tr>
    <th>Importe</th>
    <th>Concepto</th>
    <th>Fecha</th>
    <th>Categoría</th>
  </tr>
<?php foreach($trans as $t): 
?>
  <tr>
    <td><?php echo $t['importe'];?></td>
    <td><?php echo $t['concepto'];?></td>
    <td><?php echo $t['fecha'];?></td>
    <td><?php echo $t['nombre'];?></td>
  </tr>
<?php endforeach; ?>
</table> 
<!--/body>
</html-->