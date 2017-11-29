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

if($_COOKIE['login'] == 'zalogowany') 
{
	echo '<a href="logout.php">Wyloguj</a><br><br>';
	$nick2 = $_COOKIE['user'];
	
	$sql = "SELECT name FROM users WHERE login LIKE'" . $nick2 . "'" ;
	$result = mysqli_query($conn, $sql);
	$wynik = mysqli_fetch_array($result);
    
	echo '<font color=#aeb30d>"' . $wynik['name'] . '"</font> jesteś już zalogowany<br><br><br>';
	echo '<a href="pliki.php"><font color=#aeb30d> Przejdź do plików</font></a><br>';
}
else
{
    if(isset($_POST['ok']))
    {
        $nick = $_POST['nick'];
        $pass = $_POST['pass'];
        if(empty($nick) || empty($pass)) echo '<font color=#E10000>Wpisz wszystkie pola!</font><br/>';
        else
        {  
			$sql = "SELECT COUNT(*) FROM users WHERE login LIKE '" . $nick . "' AND pass LIKE '" . $pass . "'" ;
			$jest = mysqli_query($conn, $sql);
			$obecny = mysqli_fetch_array($jest)['COUNT(*)'];
			
			$sql = "SELECT blokada FROM users WHERE login LIKE '" . $nick . "' AND pass LIKE '" . $pass . "'" ;
			$czy = mysqli_query($conn, $sql);
			$blokada = mysqli_fetch_array($czy);
			
            if($obecny == 1)
            {
				if($blokada['blokada'] < 3)
				{
					$czas = time();
					setcookie("user", "$nick", $czas+3600);
					setcookie("haslo", "$pass ", $czas+3600);
					setcookie("login", "zalogowany", $czas+3600);
				
					if($blokada['blokada'] != 0)
					{
						$sql = "UPDATE users SET blokada=0 WHERE login LIKE'" . $nick . "' AND pass LIKE'" . $pass . "'" ;
						mysqli_query($conn, $sql);
					
						$sql = "SELECT data FROM logi WHERE login LIKE '" . $nick . "' AND powodzenie=1 ORDER BY data DESC LIMIT 1" ;
						$czas = mysqli_query($conn, $sql);
						$data = mysqli_fetch_array($czas);
					
						echo "<script language='javascript' type='text/javascript'>alert('Ostatnio " . $data['data'] . " nastąpiło błędne logowanie!'); </script>"; 
					}
					$sql = "INSERT INTO `logi`(login, powodzenie) VALUES ('" . $nick . "', 0)" ;
					$result = mysqli_query($conn, $sql);
				
				
					$sql = "SELECT imie FROM users WHERE login LIKE'" . $nick . "' AND pass LIKE'" . $pass . "'" ;
					$result = mysqli_query($conn, $sql);
					$wynik = mysqli_fetch_array($result);
					echo '<a href="logout.php">Wyloguj</a><br><br>';
					echo 'WITAJ!!! <font color=#aeb30d>' . $wynik['imie'] . '</font> zostałes poprawnie zalogowany!<br><br>';
					echo '<a href="pliki.php"><font color=#aeb30d> Przejdź do plików</font></a><br>';
				}
				else
				{
					echo 'PRZYKRO NAM!!! Konto <font color=#aeb30d>' . $nick . '</font> zostało zablokowane<br><br><br>';
					echo '<a href="index.php">Strona główna</a>';
				}
            } 
            else
            {
				$sql = "SELECT COUNT(*) FROM users WHERE login LIKE '" . $nick . "'" ;
				$jest2 = mysqli_query($conn, $sql);
				$obecny2 = mysqli_fetch_array($jest2)['COUNT(*)'];
				
				$sql = "SELECT blokada FROM users WHERE login LIKE '" . $nick . "'" ;
				$czy = mysqli_query($conn, $sql);
				$blokada = mysqli_fetch_array($czy);
			
				if($obecny2 == 1)
				{
					$AktualnaBlokada = $blokada['blokada'] + 1;
					echo '<font color=#aeb30d>Niestety podałes niepoprawne dane!</font><br/>';
					echo '<a href="index.php">Strona główna</a>';
					$sql = "INSERT INTO `logi`(login, powodzenie) VALUES ('" . $nick . "', 1)" ;
					$result = mysqli_query($conn, $sql);
					$sql = "UPDATE users SET blokada=" . $AktualnaBlokada . " WHERE login LIKE '" . $nick . "'" ;
					mysqli_query($conn, $sql);
				}
				else
				{
					echo '<font color=#aeb30d>Niestety podałes niepoprawne dane!</font><br/>';
					echo '<a href="index.php">Strona główna</a>';
				}
            }
            
        }
    }
    else
    {
		//formularz logowania
        echo '<form action="login.php" method="POST">
		Nick: <br />
        <input type="text" name="nick"><br />
        Hasło: <br />
        <input type="password" name="pass"><br />
        <input type="submit" name="ok" value="Zaloguj">
        </form><br/>';
    }
}
?>
</tbody></table>
</article>
</div>
</body>
</html>