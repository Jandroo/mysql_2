<!DOCTYPE html>
<html>
 <head>
  	<title>Exemple de lectura de dades a MySQL</title>
 	<meta charset="utf-8">
 	<style>
 		body{
 		}
 		table,td {
 			border: 1px solid black;
 			border-spacing: 0px;
 		}
 	</style>
 </head>
 
 <body>
 	<h1>Exemple de lectura de dades a MySQL</h1>

 <?php
  //connexió dins block try-catch:
  //  prova d'executar el contingut del try
  //  si falla executa el catch
  try {
    $hostname = "localhost";
    $dbname = "world";
    $username = "root";
    $pw = "anovoa1996";
    $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
  } catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
  }
  $continent = $_POST['Continent'];
  //preparem i executem la consulta
  $query = $pdo->prepare("select Name, Population FROM country where Continent='".$continent."';");
  $query->execute();

?>
 	<!-- (3.1) aquí va la taula HTML que omplirem amb dades de la BBDD -->
 	<table>
 	<!-- la capçalera de la taula l'hem de fer nosaltres -->
 	<thead><td colspan="4" align="center" bgcolor="cyan">Llistat de Ciutats</td></thead>
 	<?php
 		# (3.2) Bucle while
		  $row = $query->fetch();
		  while ( $row ) {
		  	echo "<tr>";
			    echo "<td>". $row['Name']. "</td>";
			    echo "<td>". $row['Population']. "</td>";
		    echo "</tr>";
		    $row = $query->fetch();
		  }
		   $query = $pdo->prepare("select sum(Population) as Total FROM country where Continent='".$continent."';");
		   $query->execute();

  		  $row = $query->fetch();
		  while ( $row ) {
		  	echo "<tr>";
		  		echo "<td>TOTAL</td>";
			    echo "<td>". $row['Total']. "</td>";
		    echo "</tr>";
		    $row = $query->fetch();
		  }
		  unset($pdo); 
  		  unset($query);
 	?>
  	<!-- (3.6) tanquem la taula -->
 	</table>	
 </body>
</html>