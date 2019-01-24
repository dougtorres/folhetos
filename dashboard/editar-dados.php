<?php
include_once '../config.php';
if (! isset ( $_SESSION )) {
	session_start ();
	if (! $_SESSION ['logado'])
		header ( "Location:../index.php" );
}
?>

<br>
<a href='?titulo=Editar+Classes+Temáticas&page=lista-classes.php&p=1'><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" data-upgraded=",MaterialButton,MaterialRipple">Classes Temáticas</button></a>&nbsp&nbsp&nbsp
<a href='?titulo=Editar+Cordeis&page=lista-cordeis.php&p=1'><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" data-upgraded=",MaterialButton,MaterialRipple">Obras</button></a>&nbsp&nbsp&nbsp
<a href='?titulo=Editar+Poetas&page=lista-autores.php&p=1'><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" data-upgraded=",MaterialButton,MaterialRipple">Poetas</button></a>&nbsp&nbsp&nbsp
<a href='?titulo=Figuras&page=lista-figuras.php&p=1'><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" data-upgraded=",MaterialButton,MaterialRipple">Figuras</button></a>&nbsp&nbsp&nbsp
<a href='?titulo=Temas&page=lista-temas.php&p=1'><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" data-upgraded=",MaterialButton,MaterialRipple">Temas</button></a>