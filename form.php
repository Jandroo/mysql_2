<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>

<form action="index.php" method="post">
Continent: 

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

  //preparem i executem la consulta
  $query = $pdo->prepare("select distinct Continent FROM country");
  $query->execute();

  //anem agafant les fileres d'amb una amb una
  echo "<select name='Continent'>";
  $row = $query->fetch();
  while ( $row ) {
    echo "<option>". $row['Continent']. "</option>";
    $row = $query->fetch();
  }
  echo "</select>";
  //eliminem els objectes per alliberar memòria 
  unset($pdo); 
  unset($query)


?>
 	<input type="submit" name="submit"/>
</form>
</body>
</html>