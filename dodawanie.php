<html>
<head>
 <title>HOTS</title>
	<link rel="shortcut icon" href="logo.png"/>
	<link rel="stylesheet" href="bootstrap-3.3.6-dist\css\bootstrap.css" />
	<meta charset="UTF-8" />

</head>
<body>
<?php
if(isset($_REQUEST['ok'])){
	$xml = new DOMDocument("1.0","UTF-8");
	$xml->load("ajax.xml");
	
	$rootTag = $xml->getElementsByTagName("postacie")->item(0);
	$postacTag = $xml->createElement("postac");
	$nazwaTag = $xml->createElement("nazwa",$_REQUEST['nazwa']);
	$typTag = $xml->createElement("typ",$_REQUEST['typ']);
	$uniwersumTag = $xml->createElement("uniwersum",$_REQUEST['uniwersum']);
	$zwyciestwaTag = $xml->createElement("zwyciestwa",$_REQUEST['zwyciestwa']);
	$popularnoscTag = $xml->createElement("popularnosc",$_REQUEST['popularnosc']);
	$miniaturaTag = $xml->createElement("miniatura",$_REQUEST['miniatura']);
	$opisTag = $xml->createElement("opis",$_REQUEST['opis']);
	
	
	$postacTag->appendChild($nazwaTag);
	$postacTag->appendChild($typTag);
	$postacTag->appendChild($uniwersumTag);
	$postacTag->appendChild($zwyciestwaTag);
	$postacTag->appendChild($popularnoscTag);
	$postacTag->appendChild($miniaturaTag);
		$postacTag->appendChild($opisTag);

	$rootTag->appendChild($postacTag);
	
	$xml->save("ajax.xml");
	echo '<script type="text/javascript">alert("Dodano!");</script>';
}


?>
<!--
<form action="index.php" method="post">
<input type="text"  name="nazwa" /><br/>
<input type="text" name="typ" /><br/>
<input type="text" name="uniwersum" /><br/>
<input type="text" name="zwyciestwa" /><br/>
<input type="text" name="popularnosc" /><br/>

<input type="submit" name="ok" value="add"/>

</form>
-->
<center><h1>Dodaj postać</h1></center><br/><br/>

<form class="form-horizontal"  action="dodawanie.php" method="post">
  <div class="form-group">
    <label class="col-sm-2 control-label">Nazwa</label>
    <div class="col-sm-10">
      <input type="text" name="nazwa" class="form-control" required />
    </div>
  </div>
   <div class="form-group">
    <label class="col-sm-2 control-label">Miniatura</label>
    <div class="col-sm-10">
      <input type="text" name="miniatura" class="form-control" required />
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Typ</label>
    <div class="col-sm-10">
      <select name="typ" class="form-control" required >
        <option>Zabojca</option>
		<option>Wojownik</option>
		<option>Pomocnik</option>
		<option>Specjalista</option>
      </select>
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-2 control-label">Uniwersum</label>
    <div class="col-sm-10">
      <select name="uniwersum" class="form-control" required >
        <option>Warcraft</option>
		<option>Diablo</option>
		<option>Starcraft</option>
		<option>Overwatch</option>
		<option>Blizzard Origins</option>
      </select>
    </div>
  </div>
   <div class="form-group">
    <label class="col-sm-2 control-label">Zwyciestwa</label>
    <div class="col-sm-10">
      <input type="number" name="zwyciestwa" min="0" max="100" step="0.1" class="form-control" required />
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-2 control-label">Popularnosc</label>
    <div class="col-sm-10">
      <input type="number" name="popularnosc" min="0" max="100" step="0.1" class="form-control" required />
    </div>
  </div>
     <div class="form-group">
    <label class="col-sm-2 control-label">Opis</label>
    <div class="col-sm-10">
      <textarea class="form-control" name="opis" rows="3" required ></textarea>
    </div>
  </div>
 
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" name="ok" class="btn btn-default" value="Dodaj" />
    </div>
  </div>
</form>
</br><center>
<form action="index.html">
<input type="submit" class="btn btn-info" value="Podgląd">
</form>
<br/>
<form action="usuwanie.php">
<input type="submit" class="btn btn-danger" value="Usuwanie">
</form>
</center>
</body>
</html>