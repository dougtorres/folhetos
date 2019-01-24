<?php
include_once '../config.php';
if(!isset($_SESSION)){
	session_start();
	if (!$_SESSION['logado'])
		header("Location:../index.php");
}
?>
<br>
<div class='mdl-card mdl-shadow--2dp ' align="center" >
<br>
<div align='center'><i class='material-icons'>info</i> Deseja mesmo excluir esta categoria?</div><br>
<br>
<div>
<a href="?titulo=Excluir+Categoria&page=resultado.php&excluir=categoria&id=<?php echo $_GET["id"]; ?>">
<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent" style="margin-right: 10%; background: #CD0000;">Sim
</button></a>
<a href="?titulo=Editar+Dados&page=editar-dados.php">
<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Não
</button></a>
</div>
<br>
</div>