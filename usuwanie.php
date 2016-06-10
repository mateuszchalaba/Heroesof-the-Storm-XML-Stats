<html>
<head>
	<link rel="stylesheet" href="bootstrap-3.3.6-dist\css\bootstrap.css" />
	<meta charset="UTF-8" />
	 <title>HOTS</title>
	<link rel="shortcut icon" href="logo.png"/>
</head>
<body>
<?php


if(isset($_REQUEST['oks']))
{
$xml = new DOMDocument("1.0","UTF-8");
	$xml->load("ajax.xml");
$sname = $_REQUEST['nazwa'];
$xpath = new DOMXPATH($xml);

foreach($xpath->query("/postacie/postac[nazwa='$sname']") as $node)
{
	$node->parentNode->removeChild($node);
}
$xml->save('ajax.xml');
echo '<script type="text/javascript">alert("Usunieto!");</script>';
}
?>

<center><h1>Usun postać</h1></center><br/><br/>

<form class="form-horizontal"  action="usuwanie.php" method="post">
  <div class="form-group">
    <label class="col-sm-2 control-label">Nazwa</label>
    <div class="col-sm-10">
      <input type="text" name="nazwa" class="form-control" required />
    </div>
  </div>

 
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" name="oks" class="btn btn-default" value="Usun" />
    </div>
  </div>
</form>
</br><center>
<form action="index.html">
<input type="submit" class="btn btn-info" value="Podgląd">
</form>
<br/>
<form action="dodawanie.php">
<input type="submit" class="btn btn-success" value="Dodawanie">
</form>
</center>
</body>
</html>