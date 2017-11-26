<!DOCTYPE html>
<head>
  <title>Marek Zych</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Marek Zych nr indeksu 104 780</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="/Z1/ZAD1.php">Zadanie 1</a></li>
      <li><a href="/Z2/ZAD2.php">Zadanie 2</a></li>
      <li><a href="/Z3/index.php">Zadanie 3</a></li>
	  <li><a href="/Z4/ZAD4.php">Zadanie 4</a></li>
	  <li><a href="/Z5/index.php">Zadanie 5</a></li>
	  <li><a href="/Z6/ZAD6.php">Zadanie 6</a></li>
	  <li><a href="/Z7/index.php">Zadanie 7</a></li>
	  <li><a href="/Z8/index.php">Zadanie 8</a></li>
    </ul>
  </div>
</nav>
<?php
if ($_COOKIE['user'] == "")
{
	header('Location: index.php'); die();
}
echo '<a href="logout.php">Wyloguj</a><br><br>';
?>

<form action="odbierz.php" method="POST" ENCTYPE="multipart/form-data"> 
<input type="file" name="plik" accept=".jpg, .jpeg, .png, .txt, .pdf"/> 
<input type="submit" value="Wyślij plik"/> 

</form>
</body>
</html>