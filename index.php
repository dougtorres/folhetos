<!DOCTYPE HTML>
<?php 

include_once "config.php";
header('Content-Type: text/html; charset=utf-8');
setlocale(LC_ALL, 'pt_BR.utf8'); 
?>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="mdl/material.min.css">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
<script src="mdl/material.min.js"></script>
<link rel="stylesheet"
	href="https://fonts.googleapis.com/icon?family=Material+Icons">
<title></title>
</head>
<body>
<div id="content" class="container" align="center">
<br>
<br>
<br>
<br>
<br>
<div class="mdl-card mdl-shadow--2dp demo-card-wide section--center  mdl-grid--no-spacing" id="caixa-login">
 <form action="login.php" method="POST">

    <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <input class="mdl-textfield__input" type="text" name="email" />
    <label class="mdl-textfield__label" for="sample1">Email</label>
    </div>
   <br>
    <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <input class="mdl-textfield__input" type="password" name="senha" />
    <label class="mdl-textfield__label" for="sample1">Senha</label>
</div>

  <div class="mdl-card__actions mdl-card--border">
    <input type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" value="logar"/>
  </div>
  </form>
</div><br>
<?php 

if(isset($_GET["error"])){
	
	echo $_GET["error"];
	echo "</br>";
}

?>
<a href="?recuperar=true" id="esqueceu">Esqueceu a senha?</a>
<?php 

$usuario = new usuarioDAO();
$dados = $usuario->getUsuario();
if(isset($_GET["recuperar"]) && $_GET["recuperar"] == "true" ){


$to = $dados[0]["email"]; 
$subject = "Recuperar Dados de Login - Folhetos"; 
$mensagem = "Olá <strong>".$dados[0]["nome"]."</strong><br><br> Os seus dados de login são:  <br><br>Email: <strong>".$dados[0]["email"]."</strong><br> Senha: <strong>".$dados[0]["senha"]."</strong>"; 
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'To: '.$dados[0]["nome"].' '.$dados[0]["email"].'' . "\r\n";
$headers .= "From: Folhetos < naoresponder@folhetos.com > \r\n";

if(mail($to, $subject, $mensagem, $headers)){

  echo "</br>Os dados foram enviados para <strong>".$dados[0]["email"]." </strong> </br>";
}
}
?>
</div>
<footer id="page_login">
  <div id="options" class="demo-footer mdl-mini-footer">
          <div class="mdl-mini-footer--left-section">
            <ul class="mdl-mini-footer--link-list">
             
              <li><a href="sobre.php">Sobre o Projeto</a></li>
                   <li><a href="creditos.php">Créditos</a></li>
            </ul>

           
          </div>
<div class="mdl-mini-footer--right-section" >
           <ul class="mdl-mini-footer--link-list" >
              
 <li><a href="falar-com-desenvolvedor.php">Desenvolvido por Douglas Torres</a></li>
            </ul>
          </div>
        </div>
        </footer>
</body>
</html>