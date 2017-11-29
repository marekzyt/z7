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
$servername = "localhost";
$username = "marekzyt";
$password = "marekzyt12345";
$dbname = "marekzyt_zad7";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST["rejestruj"]))
{
    $nick = $_POST['nick'];
    $pass = $_POST['pass'];
	$imie = $_POST['imie'];
    if(empty($nick) || empty($pass) || empty($imie)) echo '<font color=#E10000>Wpisz wszystkie pola!</font><br/>';
    else
    {  
		$sql = "SELECT idusers FROM users WHERE login='" . $nick . "'";
		$result = mysqli_query($conn, $sql);
		if($result->num_rows == 0) 
		{
			$kolor = "#" . dechex(rand(0x000000,0xFFFFFF));
			$sql = "INSERT INTO `users`(`login`, `pass`, `name`, `blokada`) VALUES ('" . $nick . "', '" . $pass .  "', '" . $imie .  "', 0)";
			mysqli_query($conn, $sql);
			'<a href="login.php">Przejdź do logowania</a></font>';
			
			
			
			mkdir ('Chmura/' . $nick . '/', 0777);
			echo '<a href="pliki.php"><font color=#aeb30d> Przejdź do plików</font></a><br>';
			
			header('Location: login.php'); die();
		}
		else 
		{
			echo '<font color=#E10000>Uzytkownik istnieje</font><br/>';  
		}
	}
}
echo '<form action="rejestruj.php" method="POST">
Imie: <br /><input type="text" name="imie"><br />
<br />Nick: <br /><input type="text" name="nick">
<br />Hasło: <br /><input type="password" name="pass"><br />

<input type="submit" name="rejestruj" value="Zarejestruj"></form><br/>';
?>
</tbody></table>
</article>
</div>
</body>
</html>