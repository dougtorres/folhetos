<!DOCTYPE HTML>
<html lang="pt-br">
<head>
	<?php 
 header('Content-Type: text/html; charset=utf-8');
 setlocale(LC_ALL, 'pt_BR.utf8');
	include_once '../autor.php';
	include_once '../categoria.php';
	include_once '../obra.php';
	include_once '../config.php';
	include_once '../config.php';
if(!isset($_SESSION)){
session_start();
if (!$_SESSION['logado'])
	header("Location:../index.php");
}
	?>
    <meta charset=UTF-8"/>
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link rel="stylesheet" href="minified/themes/default.min.css" type="text/css" media="all" />
<script type="text/javascript" src="minified/jquery.sceditor.bbcode.min.js"></script>
<script src="languages/pt-BR.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <title>Dashboard</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/touch/chrome-touch-icon-192x192.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->

    <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="material.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
   
    </style>
  </head>
  <body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--white mdl-color--grey-100 mdl-color-text--grey-600" id="header-titulo">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title"><?php if(isset($_GET["titulo"])) echo $_GET["titulo"];?></span>
          
      </header>
      <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header><br><br>
          <div class="demo-avatar-dropdown">
            <span style="margin-left: 4%;">Olá, <?php echo $_SESSION["nome"];?></span>
            <div class="mdl-layout-spacer"></div>
            <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
              <i class="material-icons">arrow_drop_down</i>
            </button>
            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
              <a href="?titulo=Alterar+Dados+De+Usuário&page=alterar-usuario.php" style="text-decoration:none" ><button class="mdl-menu__item">Alterar Dados de Usuário</button></a>
              <a href="../creditos.php" style="text-decoration:none" ><button class="mdl-menu__item">Créditos</button></a>
              <a href="../sobre.php" style="text-decoration:none" ><button class="mdl-menu__item">Sobre</button></a>
              <a href="../login.php?logout=true" style="text-decoration:none" ><button class="mdl-menu__item">Sair</button></a>
            </ul>
          </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons">home</i>Home</a>
          <a class="mdl-navigation__link" href="?titulo=Cadastrar+Autor&page=cadastrar-autor.php"><i class="mdl-color-text--blue-grey-400 material-icons">perm_identity</i>Cadastrar Poeta</a>
          <a class="mdl-navigation__link" href="?titulo=Cadastrar+Cordel&page=cadastrar-obra.php"><i class="mdl-color-text--blue-grey-400 material-icons">local_library</i>Cadastrar Cordel</a>
          <a class="mdl-navigation__link" href="?titulo=Cadastrar+Categoria&page=cadastrar-categoria.php"><i class="mdl-color-text--blue-grey-400 material-icons">grade</i>Cadastrar Classe Temática</a>
          <a class="mdl-navigation__link" href="?titulo=Realizar+Consulta&page=consultar.php"><i class="mdl-color-text--blue-grey-400 material-icons">search</i>Consultar</a>
            <a class="mdl-navigation__link" href="?titulo=Editar+Dados&page=editar-dados.php"><i class="mdl-color-text--blue-grey-400 material-icons">border_color</i>Editar Dados</a>
          <div class="mdl-layout-spacer"></div>
          <a class="mdl-navigation__link" href="../falar-com-desenvolvedor.php"><i class="mdl-color-text--blue-grey-400 material-icons">bug_report</i>Contatar Desenvolvedor</a>
        </nav>
      </div>
      <main class="mdl-layout__content mdl-color--grey-100" id="conteudo">
      
        <div class="mdl-grid demo-content">
        <div class="demo-charts  mdl-cell mdl-cell--6-col">
          <?php 
          
          if(isset($_GET["page"])) include $_GET['page'];
          
          ?>
        </div>
          </div>
          </main>
    <script src="../mdl/material.min.js"></script>
  </body>
</html>
