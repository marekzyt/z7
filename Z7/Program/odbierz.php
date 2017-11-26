<!DOCTYPE HTML>  
<html>
<head>
<!--<meta http-equiv="refresh" content="10" />-->
<title>Marek Zych</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
.error {color: #FF0000;}
 
table {
    border-collapse: collapse;
    width: 100%;
}
 
th, td {
    text-align: left;
    padding: 8px;
}
 
tr:nth-child(even){background-color: #f2f2f2}
 
</style>
</head>
<body>  
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Marek Zych nr indeksu 104 780</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="http://www.nielubieprogramowac.hekko24.pl">Home</a></li>
      <li><a href="/Z1/ZAD1.php">Zadanie 1</a></li>
      <li><a href="/Z2/ZAD2.php">Zadanie 2</a></li>
      <li><a href="/Z3/index.php">Zadanie 3</a></li>
	  <li><a href="/Z4/ZAD4.php">Zadanie 4</a></li>
	  <li><a href="/Z5/index.php">Zadanie 5</a></li>
	  <li><a href="/Z6/ZAD6.php">Zadanie 6</a></li>
	  <li class="active"><a href="/Z7/Program/index.php">Zadanie 7</a></li>
	  <li><a href="/Z8/index.php">Zadanie 8</a></li>
    </ul>
  </div>
</nav>
 
<div class="container">


<?php 
if ($_COOKIE['user'] == "")
{
	header('Location: index.php'); die();
}
echo '<a href="logout.php">Wyloguj</a><br><br>';

$nick = $_COOKIE['user'];

	$max_rozmiar = 1000000000;

	if (is_uploaded_file($_FILES['plik']['tmp_name']))
	{
		if ($_FILES['plik']['size'] > $max_rozmiar) 
		{
			echo "Przekroczenie rozmiaru $max_rozmiar"; 
		}
		else
		{
			echo 'Odebrano plik: '.$_FILES['plik']['name'].'<br/>';
			if (isset($_FILES['plik']['type'])) 
			{
				echo 'Typ: '.$_FILES['plik']['type'].'<br/>'; 
			}
			move_uploaded_file($_FILES['plik']['tmp_name'],$_SERVER['DOCUMENT_ROOT']. '/Z7/Chmura/'.$nick.'/'.$_FILES['plik']['name']);
			echo $_SERVER['DOCUMENT_ROOT']. '/Z7/Chmura/'.$nick.'/'.$_FILES['plik']['name'];
		}
	}
	else 
	{
		echo 'Błąd przy przesyłaniu danych!';
	}
//////////////////////////////echo '<a href="XXXXXXXXX.php">Przejdź do swojego katalogu</a>';//////////////
echo '<a href="wyslij.php">Wyślij nowy plik</a>';
?>
</tbody></table>
</article>
</div>
</body>
</html>