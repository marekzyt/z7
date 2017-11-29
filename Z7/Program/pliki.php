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

.footer {
	position: fixed:
	bottom: 10px;
	left: 10px;
}
 
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
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link rel="stylesheet" href="style.css">
<div class="container" >
<?php
$nick = $_COOKIE['user'];
if ($_COOKIE['user'] == "")
{
	header('Location: index.php'); die();
}
echo '<a href="logout.php">Wyloguj</a><br><br>';
echo '<a href="podfolder.php?folder=Chmura/' . $nick . '/"><div class="addfolder2"></div></a><a href="wyslij.php?folder=Chmura/' . $nick . '/"><div class="addPlik2"></div></a><br><br>';

function fillArrayWithFileNodes( DirectoryIterator $dir )
{
    global $ignore;

    $data = array();
    foreach ( $dir as $node )
    {
        if (in_array($node, $ignore)) continue;

        if ( $node->isDir() && !$node->isDot() )
        {
            $path = $node->getPath();
			$path = $path .'\\'. $node->getFilename();
            $path = str_replace("\\", '/', $path);

            $data[$node->getFilename()] = array(
                    'type' => 'folder',
                    'name' => $node->getFilename(),
                    'path' => $path,
                    'files' => fillArrayWithFileNodes( new DirectoryIterator( $node->getPathname() ) )
            );
        }
        else if ( $node->isFile() && !$node->isDot() )
        {
            $path = $node->getPath();
			$path = $path .'\\'. $node->getFilename();
            $path = str_replace("\\", '/', $path);
            
			
            $data[] = array(
                'type' => 'file',
                'name' => $node->getFilename(),
                'path' => $path,
                'files' => false
            );
        }
    }
    return $data;
}

$tree = fillArrayWithFileNodes( new DirectoryIterator( 'Chmura/' . $nick) );
?>

<script>
var arrayToUL = function(obj, className, id) {
    var $ul = $('<ul class="'+className+'" '+ ((id!=undefined)?'id="'+id+'"':'') +'></ul>');
    jQuery.each(obj, function(i, val) {
        var $li = $('<li></li>');
        if (val.type == 'folder') {
            var $subUl = arrayToUL(val['files'], 'subfolder');
            $li.append($('<a href="podfolder.php?folder='+val.path+'/"><div class="addfolder"></div></a><a href="wyslij.php?folder='+val.path+'/"><div class="addPlik"></div></a><a class="folder" href="'+val.path+'" class="label">'+val.name+' <span class="count">['+$subUl.children('li').length+']</span> </a>'));
            $li.append($subUl);
        } else {
                $li.append($('<a class="file" target="_blank" href="'+val.path+'">'+val.name+'</a>'));
        }
            $ul.append($li);
    });
    return $ul;
};

var json = <?php echo json_encode($tree); ?>;    
var $ul = arrayToUL(json, 'folder-tree', 'folderTree');

$(function() {
    $('body').append($ul);
    $('.folder-tree .folder').on('click', function(e) {
        e.preventDefault();
        $(this).next().slideToggle();
    });
})
</script>
 
</div>
</body>
</html>