 <?php 
include_once '../config.php';
if(!isset($_SESSION)){
session_start();
if (!$_SESSION['logado'])
	header("Location:../index.php");
}
?> 


  
  <form action="?titulo=Alterar+Dados+De+Usuário&page=resultado.php" method="POST">
  <div class="mdl-card mdl-shadow--2dp demo-card-wide" >
  <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <input class="mdl-textfield__input" type="text" name="nome-usuario" value="<?php echo $_SESSION["nome"] ?>" />
    <label class="mdl-textfield__label" for="sample1">Insira o nome do Usuário...</label>
  </div>
  <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <input class="mdl-textfield__input" type="text" name="email-usuario" value="<?php echo $_SESSION["email"] ?>" />
    <label class="mdl-textfield__label" for="sample1">Insira o seu email...</label>
  </div>
  <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <input class="mdl-textfield__input" type="password" name="senha-usuario"  />
    <label class="mdl-textfield__label" for="sample1">Insira a nova senha...</label>
  </div>
  <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <input class="mdl-textfield__input" type="password" name="confirma-usuario"  />
    <label class="mdl-textfield__label" for="sample1">Repita a nova senha...</label>
  </div><br>
  <div class="mdl-card__actions mdl-card--border">
    <input type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" value="Alterar Dados"/>
  </div> 	
  </div>
  </form>

