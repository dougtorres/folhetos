
 <?php 
include_once '../config.php';
if(!isset($_SESSION)){
session_start();
if (!$_SESSION['logado'])
	header("Location:../index.php");
}
?> 

  
  <form action="?titulo=Alterar+Categoria&page=resultado.php&id=<?php echo $_GET["id"]; ?>" method="POST">
  <div class="mdl-card mdl-shadow--2dp demo-card-wide" >
  <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <input class="mdl-textfield__input" type="text" name="novotitulo-categoria" value="<?php echo $_GET["categoria"];?>"/>
    <label class="mdl-textfield__label" for="sample1">Insira o nome da categoria...</label>
  </div><br>


  <div class="mdl-card__actions mdl-card--border">
    <input type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" value="Alterar Classe Temática"/>
  </div>
  </div>
  </form>

