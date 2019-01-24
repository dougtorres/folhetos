<?php
include_once '../config.php';
if (! isset ( $_SESSION )) {
	session_start ();
	if (! $_SESSION ['logado'])
		header ( "Location:../index.php" );
}
?>
<br>
<div class='mdl-card mdl-shadow--2dp '>
	<br>
<?php
if(isset($_GET ["tituloObra"])){
echo "<b>" . $_GET ["tituloObra"] . ": </b></br>";
}
echo $_GET ["contexto"];
?><br>
	<br>
</div>