<?php
include_once '../config.php';
if(!isset($_SESSION)){
	session_start();
	if (!$_SESSION['logado'])
		header("Location:../index.php");
}
?>
<br>
<div class='mdl-card mdl-shadow--2dp 'id="div-xilo" >
<?php 

echo "<b>".$_GET["tituloObra"].": </b></br>";
echo "<a href='".$_GET["xilo"]."'><img src='".$_GET["xilo"]."'  id='xilo'/></a>"; ?><br><br>
<a href="?titulo=Excluir+Xilogravura&page=resultado.php&excluir=xilo&id=<?php echo $_GET["id"]; ?>&xilo=<?php echo $_GET["xilo"]; ?>"><button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent" style="margin-right: 10%; background: #CD0000; width: 250px; ">Excluir Xilogravura</button></a>
<br>
</div>