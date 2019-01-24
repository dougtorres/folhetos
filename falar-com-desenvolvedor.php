
<!DOCTYPE HTML>
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
Falar com Desenvolvedor:
<br><br>
<div class="mdl-card mdl-shadow--2dp demo-card-wide section--center  mdl-grid--no-spacing">
 <form action="?enviar=true" method="POST" name="enviar">
	<div class="mdl-textfield mdl-js-textfield textfield-demo">
    <input class="mdl-textfield__input" type="text" name="nome" />
    <label class="mdl-textfield__label" for="sample1">Nome</label>
    </div>
    <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <input class="mdl-textfield__input" type="text" name="email" />
    <label class="mdl-textfield__label" for="sample1">Email</label>
    </div>
   <br>
   <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <input class="mdl-textfield__input" type="text" name="assunto" />
    <label class="mdl-textfield__label" for="sample1">Assunto</label>
    </div>
   <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <textarea class="mdl-textfield__input" type="text" name="mensagem" rows="4" cols="50" ></textarea>
     <label class="mdl-textfield__label" for="sample5">Digite a mensagem...</label>

    
</div>

  <div class="mdl-card__actions mdl-card--border">
    <input type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" value="Enviar"/>
  </div>
  </form>
</div><br>
<?php 

if(isset($_GET["enviar"]) && $_GET["enviar"] == "true" ){

$to = "douglastorr@gmail.com"; 
$subject = "Fale com o Desenvolvedor <".$_POST['assunto'].">"; 
$mensagem = "<strong>Nome: </strong>".$_POST["nome"]."<br><br> <strong>Mensagem: </strong>".$_POST['mensagem']; 
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'To: Douglas Torres <douglastorr@gmail.com>' . "\r\n";
$headers .= "From: ".$_POST["nome"]." < ".$_POST["email"]." > \r\n";

if(mail($to, $subject, $mensagem, $headers)){

  echo "Mensagem Enviada com Sucesso!</br>";
} //função que faz o envio do email. 

}

if(isset($_GET["error"])){
	
	echo $_GET["error"];
	echo "</br>";
}

?>
</div>
<footer id="page_login">
  <div id="options" class="demo-footer mdl-mini-footer">
          <div class="mdl-mini-footer--left-section">
            <ul class="mdl-mini-footer--link-list">
             <li><a href="index.php">Início</a></li>
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