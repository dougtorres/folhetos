
<?php 

include('config.php');
if(isset($_POST["email"]) && isset($_POST["senha"])){

$login = new login();
if($login->logar($_POST["email"], $_POST["senha"]))
{
	header("Location:dashboard/");
}
else{
	//echo "Senha invalida! ";
	header("Location:index.php?error=Login+Incorreto!");
}
}elseif (isset($_GET["logout"])){
	$login = new login();
	$login->logout();
	header("Location:./index.php");
}else{
	header("Location:index.php?error=Login+Incorreto!");
	
}
?>