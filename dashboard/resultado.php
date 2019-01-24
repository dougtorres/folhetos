<?php



include_once '../config.php';
if (! isset ( $_SESSION )) {
	session_start ();
	if (! $_SESSION ['logado'])
		header ( "Location:../index.php" );
}

error_reporting(4);
// CADASTRAR AUTOR
if (isset ( $_POST ["nome-autor"] ) && isset ( $_POST ["estado"] )) {
	
	if (isset ( $_POST ["data_nasc"] ) && $_POST ["data_nasc"] != "0000") {
		
		$data_nasc = $_POST ["data_nasc"];
	} else {
		
		$data_nasc = null;
	}
	
	if (isset ( $_POST ["data_morte"] ) && $_POST ["data_morte"] != "0000") {
		
		$data_morte = $_POST ["data_morte"];
	} else {
		
		$data_morte = null;
	}
	
	if (isset ( $_POST ["pseudonimo-autor"] ))
		$pseudonimo = $_POST ["pseudonimo-autor"];
	else
		$pseudonimo = "";
	
	echo $data_morte;
	echo $data_nasc;
	$autor = new Autor ( $_POST ["nome-autor"], $pseudonimo, $data_nasc, $data_morte, $_POST ["estado"] );
	$obj = new AutorDAO ();
	switch ($obj->cadastrarAutor ( $autor )) {
		case 1 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>done</i> Autor Cadastrado Com Sucesso!</div><br>";
			echo "</div>";
			break;
		case 0 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Cadastro não realizado! <br>Verifique os dados inseridos e tente novamente.<br> Caso o erro persista, contate o Desenvolvedor.</div><br>";
			echo "</div>";
			break;
		case 2 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Cadastro não realizado! <br>Já existe um autor com esse nome!</div><br>";
			echo "</div>";
			break;
	}
} 

elseif (isset ( $_POST ["titulo-categoria"] )) {
	
	$categoria = new Categoria ( $_POST ["titulo-categoria"] );
	$obj = new CategoriaDAO ();
	switch ($obj->cadastrarCategoria ( $categoria )) {
		case 1 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>done</i> Categoria Cadastrada Com Sucesso!</div><br>";
			echo "</div>";
			break;
		case 0 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Cadastro n�o realizado! <br>Verifique os dados inseridos e tente novamente.<br> Caso o erro persista, contate o Desenvolvedor.</div><br>";
			echo "</div>";
			break;
		case 2 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Cadastro n�o realizado! <br>J� existe uma categoria com esse titulo!</div><br>";
			echo "</div>";
			break;
	}
} // CADASTRAR OBRA
elseif (isset ( $_POST ["titulo-obra"] ) && isset ( $_POST ["autor-obra"] ) && isset ( $_POST ["categoria-obra"] ) && isset ( $_POST ["conteudo"] ) && isset ( $_POST ["figura-obra"] ) && isset ( $_POST ["tema-obra"] ) && isset ( $_POST ["referencia-obra"] )) {
	
	$obra = new Obra ( $_POST ["titulo-obra"], $_POST ["autor-obra"], $_POST ["categoria-obra"], $_POST ["conteudo"], $_POST ["figura-obra"], $_POST ["tema-obra"], $_POST ["referencia-obra"] );
	
	$obj = new ObraDAO ();
	switch ($obj->cadastrarObra ( $obra )) {
		case 1 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>done</i> Obra Cadastrada Com Sucesso!</div><br>";
			echo "</div>";
			break;
		case 0 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Cadastro n�o realizado! <br>Verifique os dados inseridos e tente novamente.<br> Caso o erro persista, contate o Desenvolvedor.</div><br>";
			echo "</div>";
			break;
		case 2 :
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<br>";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Cadastro n�o realizado! <br>J� existe uma obra com esse titulo!</div><br>";
			echo "</div>";
			break;
	}
} 

elseif (isset ( $_POST ["tipo-consulta"] ) && isset ( $_POST ["pesquisa"] )) {
	
	if ($_POST ["tipo-consulta"] == "obra") {
		$obj = new ObraDAO ();
		$resultado = $obj->PesquisarObra ( $_POST ["pesquisa"] );
		switch ($resultado) {
			
			case 1 :
				echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
				echo "<br>";
				echo "<div align='center'><i class='material-icons'>highlight_off</i> Ocorreu um erro! <br>Verifique os dados inseridos e tente novamente.<br> Caso o erro persista, contate o Desenvolvedor.</div><br>";
				echo "</div>";
				break;
			case 0 :
				echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
				echo "<br>";
				
				echo "<div align='center'><i class='material-icons'>highlight_off</i> Nenhum resultado encontrado!</div><br>";
				echo "</div>";
				break;
			default :
				echo "<form method='POST' action='imprimir.php' target='print' >";
			echo "<input type='hidden' name='dados' value='".serialize($resultado)."'/><br>";
			echo "<input type='submit' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' onclick=window.open('imprimir.php','print','scrollbars=no,menubar=no,height=600,width=800,resizable=yes,toolbar=no,status=no'); value='Imprimir'/>";
			echo "</form><br>";
				echo "<table class='mdl-data-table mdl-js-data-table  mdl-shadow--2dp'>";
				echo "<thead>";
				echo "<tr>";
				echo "<th class='mdl-data-table__cell--non-numeric'>Titulo</th>";
				echo "<th class='mdl-data-table__cell--non-numeric'>Autor</th>";
				echo "<th class='mdl-data-table__cell--non-numeric'>Categoria</th>";
				echo "<th class='mdl-data-table__cell--non-numeric'>Conteudo/Contexto</th>";
				echo "<th class='mdl-data-table__cell--non-numeric'></th>";
				echo "<th class='mdl-data-table__cell--non-numeric'></th>";
				echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
				
				foreach ( $resultado as $row ) {
					echo "<tr>";
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $row ["titulo"] . "</td>";
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $row ["nome"] . "</td>";
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $row ["categoria"] . "</td>";
					echo "<td class='mdl-data-table__cell--non-numeric'><a href='?titulo=Conteudo/Contexto&page=contexto.php&contexto=" . $row ["contexto"] . "&tituloObra=" . $row ["titulo"] . "'>Exibir</a></td>";
					echo "<td class='mdl-data-table__cell--non-numeric'><a href='?titulo=Alterar+Obra&page=alterar-obra.php&tituloObra=" . $row ["titulo"] . "&autor=" . $row ["nome"] . "&categoria=" . $row ["categoria"] . "&id=" . $row ["id"] . "'>Alterar</a></td>";
					echo "<td class='mdl-data-table__cell--non-numeric'><a href='?titulo=Excluir+Obra&page=excluir-obra.php&id=" . $row ["id"] . "'>Excluir</a></td>";
					echo "</tr>";
				}
				echo "</tbody>";
				echo "</table>";
				break;
		}
	} elseif ($_POST ["tipo-consulta"] == "categoria") {
		
		$obj = new CategoriaDAO ();
		$resultado = $obj->PesquisarCategoria ( $_POST ["pesquisa"] );
		switch ($resultado) {
			
			case 1 :
				echo "<br>";
				echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
				echo "<div align='center'><i class='material-icons'>highlight_off</i> Ocorreu um erro! <br>Verifique os dados inseridos e tente novamente.<br> Caso o erro persista, contate o Desenvolvedor.</div><br>";
				echo "</div>";
				break;
			case 0 :
				echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
				echo "<br>";
				
				echo "<div align='center'><i class='material-icons'>highlight_off</i> Nenhum resultado encontrado!</div><br>";
				echo "</div>";
				break;
			default :
				echo "<form method='POST' action='imprimir.php' target='print' >";
			echo "<input type='hidden' name='dados' value='".serialize($resultado)."'/><br>";
			echo "<input type='submit' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' onclick=window.open('imprimir.php','print','scrollbars=no,menubar=no,height=600,width=800,resizable=yes,toolbar=no,status=no'); value='Imprimir'/>";
			echo "</form><br>";
				echo "<table class='mdl-data-table mdl-js-data-table  mdl-shadow--2dp'>";
				echo "<thead>";
				echo "<tr>";
				echo "<th class='mdl-data-table__cell--non-numeric'>Categoria</th>";
				echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
				
				foreach ( $resultado as $row ) {
					echo "<tr>";
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $row ["titulo"] . "</td>";
					echo "</tr>";
				}
				echo "</tbody>";
				echo "</table>";
				break;
		}
	} elseif ($_POST ["tipo-consulta"] == "autor") {
		
		$obj = new AutorDAO ();
		$resultado = $obj->PesquisarAutor ( $_POST ["pesquisa"] );
		switch ($resultado) {
			
			case 1 :
				echo "<br>";
				echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
				echo "<div align='center' class='mdl-card mdl-shadow--2dp'><i class='material-icons'>highlight_off</i> Ocorreu um erro! <br>Verifique os dados inseridos e tente novamente.<br> Caso o erro persista, contate o Desenvolvedor.</div><br>";
				echo "</div>";
				break;
			case 0 :
				echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
				echo "<br>";
				
				echo "<div align='center'><i class='material-icons'>highlight_off</i> Nenhum resultado encontrado!</div><br>";
				echo "</div>";
				break;
			default : 
				echo "<form method='POST' action='imprimir.php' target='print' >";
			echo "<input type='hidden' name='dados' value='".serialize($resultado)."'/><br>";
			echo "<input type='submit' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' onclick=window.open('imprimir.php','print','scrollbars=no,menubar=no,height=600,width=800,resizable=yes,toolbar=no,status=no'); value='Imprimir'/>";
			echo "</form><br>";
				echo "<table class='mdl-data-table mdl-js-data-table  mdl-shadow--2dp'>";
				echo "<thead>";
				echo "<tr>";
				echo "<th class='mdl-data-table__cell--non-numeric'>Autor</th>";
				echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
				
				foreach ( $resultado as $row ) {
					echo "<tr>";
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $row ["nome"] . "</td>";
					echo "</tr>";
				}
				echo "</tbody>";
				echo "</table>";
				break;
		}
	}
} // ALTERAR OBRA
elseif (isset ( $_GET ["id"] ) && isset ( $_POST ["novotitulo-obra"] ) && isset ( $_POST ["novoautor-obra"] ) && isset ( $_POST ["novacategoria-obra"] ) && isset ( $_POST ["novoconteudo"] ) && isset ( $_POST ["novafigura-obra"] ) && isset ( $_POST ["novotema-obra"] ) && isset ( $_POST ["novareferencia-obra"] )) {
	
	$obj = new ObraDAO ();
	switch ($obj->alterarObra ( $_GET ["id"], $_POST ["novotitulo-obra"], $_POST ["novoautor-obra"], $_POST ["novacategoria-obra"], $_POST ["novoconteudo"], $_POST ["novafigura-obra"], $_POST ["novotema-obra"], $_POST ["novareferencia-obra"] )) {
		case 1 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>done</i> Obra Alterada Com Sucesso!</div><br>";
			echo "</div>";
			break;
		case 0 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Alteração não realizada! <br>Verifique os dados inseridos e tente novamente.<br> Caso o erro persista, contate o Desenvolvedor.</div><br>";
			echo "</div>";
			break;
	}
} 

elseif (isset ( $_GET ["id"] ) && isset ( $_POST ["novotitulo-categoria"] )) {
	
	$obj = new CategoriaDAO ();
	switch ($obj->alterarCategoria ( $_GET ["id"], $_POST ["novotitulo-categoria"] )) {
		case 1 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>done</i> Categoria Alterada Com Sucesso!</div><br>";
			echo "</div>";
			break;
		case 0 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Alteração não realizada! <br>Verifique os dados inseridos e tente novamente.<br> Caso o erro persista, contate o Desenvolvedor.</div><br>";
			echo "</div>";
			break;
	}
}

// ALTERAR AUTOR
elseif (isset ( $_GET ["id"] ) && isset ( $_POST ["novonome-autor"] ) && isset ( $_POST ["novoestado"] )) {
	
	if (isset ( $_POST ["novadata_nasc"] ) && $_POST ["novadata_nasc"] != "0000") {
		
		$novadata_nasc = $_POST ["novadata_nasc"];
	} else {
		
		$novadata_nasc = null;
	}
	
	if (isset ( $_POST ["novadata_morte"] ) && $_POST ["novadata_morte"] != "0000") {
		
		$novadata_morte = $_POST ["novadata_morte"];
	} else {
		
		$novadata_morte = null;
	}
	
	if (isset ( $_POST ["novopseudonimo-autor"] ))
		$pseudonimo = $_POST ["novopseudonimo-autor"];
	else
		$pseudonimo = "";
	
	$obj = new AutorDAO ();
	switch ($obj->alterarAutor ( $_GET ["id"], $_POST ["novonome-autor"], $pseudonimo, $novadata_nasc, $novadata_morte, $_POST ["novoestado"] )) {
		case 1 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>done</i> Autor Alterado Com Sucesso!</div><br>";
			echo "</div>";
			break;
		case 0 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Alteração não realizada! <br>Verifique os dados inseridos e tente novamente.<br> Caso o erro persista, contate o Desenvolvedor.</div><br>";
			echo "</div>";
			break;
	}
} 

elseif (isset ( $_GET ["id"] ) && isset ( $_GET ["excluir"] )) {
	
	switch ($_GET ["excluir"]) {
		
		case "obra" :
			$obj = new ObraDAO ();
			switch ($obj->excluirObra ( $_GET ["id"] )) {
				case 1 :
					echo "<br>";
					echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
					echo "<div align='center'><i class='material-icons'>done</i> Obra Excluida Com Sucesso!</div><br>";
					echo "</div>";
					break;
				case 0 :
					echo "<br>";
					echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
					echo "<div align='center'><i class='material-icons'>highlight_off</i> Exclusão não realizada! <br>Verifique os dados inseridos e tente novamente.<br> Caso o erro persista, contate o Desenvolvedor.</div><br>";
					echo "</div>";
					break;
			}
			break;
		case "categoria" :
			$obj3 = new CategoriaDAO ();
			switch ($obj3->excluirCategoria ( $_GET ["id"] )) {
				
				case 2 :
					echo "<br>";
					echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
					echo "<div align='center'><i class='material-icons'>highlight_off</i> Esta categoria não pode ser excluida!<br>Verifique se ela está ligada a alguma obra</div><br>";
					echo "</div>";
					break;
				case 1 :
					echo "<br>";
					echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
					echo "<div align='center'><i class='material-icons'>done</i> Categoria Excluida Com Sucesso!</div><br>";
					echo "</div>";
					break;
				case 0 :
					echo "<br>";
					echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
					echo "<div align='center'><i class='material-icons'>highlight_off</i> Exclusão não realizada! <br>Verifique os dados inseridos e tente novamente.<br> Caso o erro persista, contate o Desenvolvedor.</div><br>";
					echo "</div>";
					break;
			}
			break;
		
		case "autor" :
			$obj = new AutorDAO ();
			switch ($obj->excluirAutor ( $_GET ["id"] )) {
				
				case 2 :
					echo "<br>";
					echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
					echo "<div align='center'><i class='material-icons'>highlight_off</i> Este autor não pode ser excluido!<br>Verifique se ele está ligado a alguma obra</div><br>";
					echo "</div>";
					break;
				case 1 :
					echo "<br>";
					echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
					echo "<div align='center'><i class='material-icons'>done</i> Autor Excluido Com Sucesso!</div><br>";
					echo "</div>";
					break;
				case 0 :
					echo "<br>";
					echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
					echo "<div align='center'><i class='material-icons'>highlight_off</i> Exclusão não realizada! <br>Verifique os dados inseridos e tente novamente.<br> Caso o erro persista, contate o Desenvolvedor.</div><br>";
					echo "</div>";
					break;
			}
			break;
	}
} 

elseif (isset ( $_POST ["nome-usuario"] ) && isset ( $_POST ["email-usuario"] ) && isset ( $_POST ["senha-usuario"] )) {
	
	if ($_POST ["senha-usuario"] == $_POST ["confirma-usuario"]) {
		$obj = new UsuarioDAO ();
		switch ($obj->alterarDados ( $_POST ["nome-usuario"], $_POST ["email-usuario"], $_POST ["senha-usuario"] )) {
			case 1 :
				echo "<br>";
				echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
				echo "<div align='center'><i class='material-icons'>done</i> Dados Alterados Com Sucesso!</div><br>";
				echo "</div>";
				break;
			case 0 :
				echo "<br>";
				echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
				echo "<div align='center'><i class='material-icons'>highlight_off</i> Alteração não realizada! <br>Verifique os dados inseridos e tente novamente.<br> Caso o erro persista, contate o Desenvolvedor.</div><br>";
				echo "</div>";
				break;
		}
	} else {
		echo "<br>";
		echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
		echo "<div align='center'><i class='material-icons'>highlight_off</i> As senhas não conferem!</div><br>";
		echo "</div>";
	}
} 

//CONSULTAR AUTOR

elseif (isset ( $_POST ["op-autor"] ) && isset ( $_POST ["tipo-consulta-autor"] ) && isset ( $_POST ["pesquisa-autor"] )) {
	
	$obj = new AutorDAO ();
	$resultado = $obj->consultaAvancada ( $_POST ["op-autor"], $_POST ["tipo-consulta-autor"], $_POST ["pesquisa-autor"] );
	switch ($resultado) {
		case 1 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Alteração não realizada! <br>Verifique os dados inseridos e tente novamente.<br> Caso o erro persista, contate o Desenvolvedor.</div><br>";
			echo "</div>";
			break;
		case 2 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Nenhuma op��o selecionada</div><br>";
			echo "</div>";
			break;
		case 0 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Nenhum resultado foi retornado</div><br>";
			echo "</div>";
			break;
		default :
			echo "<form method='POST' action='imprimir.php' target='print' >";
			echo "<input type='hidden' name='dados' value='".serialize($resultado)."'/><br>";
			echo "<input type='submit' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' onclick=window.open('imprimir.php','print','scrollbars=no,menubar=no,height=600,width=800,resizable=yes,toolbar=no,status=no'); value='Imprimir'/>";
			echo "</form><br>";
			echo "Total de registro encontrados: ".$resultado["total"];
			echo "<br>";
			echo "<br>";
			echo "<table class='mdl-data-table mdl-js-data-table  mdl-shadow--2dp'>";
			echo "<thead>";
			echo "<tr>";
			if (isset ( $resultado [0] ["nome"] )){
				$nomeSet = 1;
				echo "<th class='mdl-data-table__cell--non-numeric'>Nome</th>";
			}
			if (isset ( $resultado [0] ["pseudonimo"] )){
				$pseudonimoSet =1;
				echo "<th class='mdl-data-table__cell--non-numeric'>Pseud�nimo</th>";
			}
			elseif (isset ( $resultado [2] ["pseudonimo"] )){
				$pseudonimoSet =1;
				echo "<th class='mdl-data-table__cell--non-numeric'>Pseud�nimo</th>";
			}
			if (isset ( $resultado [0] ["data_nasc"] )){
				$data_nascSet = 1;
				echo "<th class='mdl-data-table__cell--non-numeric'>Data de Nascimento</th>";
			}
			if (isset ( $resultado [0] ["data_morte"] )){
				$data_morteSet = 1;
				echo "<th class='mdl-data-table__cell--non-numeric'>Data de Morte</th>";
			}
			if (isset ( $resultado [0] ["estado"] )){
				$estadoSet = 1;
				echo "<th class='mdl-data-table__cell--non-numeric'>Estado</th>";
			}
			echo "<th class='mdl-data-table__cell--non-numeric'></th>";
			echo "<th class='mdl-data-table__cell--non-numeric'></th>";
			echo "</tr>";
			
			echo "</thead>";
			echo "<tbody>";
			
			foreach ( $resultado as $row ) {
				
				if (isset ( $row ["data_nasc"] ) && $row ["data_nasc"] == 0) {
					$data_nasc = "Sem informação";
				} 
				elseif ( isset($row ["data_nasc"] ) && $row ["data_nasc"] != 0) {
					$data_nasc = $row ["data_nasc"];
				}
				if (isset ( $row ["data_morte"] ) && $row ["data_morte"] == 0) {
					
					$data_morte = "Sem informação";
				} elseif ( isset($row ["data_morte"] ) && $row ["data_morte"] != 0) {
					$data_morte = $row ["data_morte"];
				}
	
				echo "<tr>";
				if (isset($nomeSet) && $nomeSet == 1)
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $row ["nome"] . "</td>";
				if (isset($pseudonimoSet) && $pseudonimoSet == 1)
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $row["pseudonimo"] . "</td>";
				if (isset($data_nascSet) && $data_nascSet == 1)
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $data_nasc . "</td>";
				if (isset($data_morteSet ) && $data_morteSet ==1)
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $data_morte . "</td>";
				if (isset($estadoSet) && $estadoSet ==1)
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $row ["estado"] . "</td>";
				echo "<td><a href='?titulo=Alterar+Autor&page=alterar-autor.php&id=" . $row ["id"] . "&autor=" . $row ["nome"] . "&data_nasc=" . $row ["data_nasc"] . "&data_morte=" . $row ["data_morte"] . "&estado=" . $row ["estado"] . "&pseudonimo=" . $row ["pseudonimo"] . "'>Alterar</a></td>";
				echo "<td><a href='?titulo=Excluir+Autor&page=excluir-autor.php&id=" . $row ["id"] . "'>Excluir</a></td>";
				echo "</tr>";
			}
			
			echo "</tbody>";
			echo "</table>";
			break;
	}
}

//CONSULTA AVAN�ADA DE CLASSES TEM�TICAS
elseif (isset ( $_POST ["tipo-consulta-categoria"] ) && isset ( $_POST ["pesquisa-categoria"] )) {

	$obj = new CategoriaDAO ();
	$resultado = $obj->consultaAvancada ($_POST ["tipo-consulta-categoria"], $_POST ["pesquisa-categoria"] );
	switch ($resultado) {
		case 1 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Alteração não realizada! <br>Verifique os dados inseridos e tente novamente.<br> Caso o erro persista, contate o Desenvolvedor.</div><br>";
			echo "</div>";
			break;
		case 2 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Nenhuma opção selecionada</div><br>";
			echo "</div>";
			break;
		case 0 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Nenhum resultado foi retornado</div><br>";
			echo "</div>";
			break;
		default :
			echo "<form method='POST' action='imprimir.php' target='print' >";
			echo "<input type='hidden' name='dados' value='".serialize($resultado)."'/><br>";
			echo "<input type='submit' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' onclick=window.open('imprimir.php','print','scrollbars=no,menubar=no,height=600,width=800,resizable=yes,toolbar=no,status=no'); value='Imprimir'/>";
			echo "</form><br>";
			echo "<table class='mdl-data-table mdl-js-data-table  mdl-shadow--2dp'>";
			echo "<thead>";
			echo "<tr>";
			if (isset ( $resultado [0] ["titulo"] )){
				$tituloSet = 1;
				echo "<th class='mdl-data-table__cell--non-numeric'>Classe Temática</th>";
				echo "<th class='mdl-data-table__cell--non-numeric'></th>";
			}
			echo "</tr>";
				
			echo "</thead>";
			echo "<tbody>";
				
			foreach ( $resultado as $row ) {

				echo "<tr>";
				if (isset($tituloSet) && $tituloSet == 1)
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $row ["titulo"] . "</td>";
				echo "</tr>";
			}
				
			echo "</tbody>";
			echo "</table>";
			break;
	}
}

//CONSULTA AVAN�ADA CORDEL

elseif (isset ( $_POST ["op-cordel"] ) && isset ( $_POST ["tipo-consulta-cordel"] ) && isset ( $_POST ["pesquisa-cordel"] )) {

	$obj = new ObraDAO ();
	$resultado = $obj->consultaAvancada ( $_POST ["op-cordel"], $_POST ["tipo-consulta-cordel"], $_POST ["pesquisa-cordel"] );
	$resultado2 = $resultado;
	switch ($resultado) {
		case 1 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Alteração não realizada! <br>Verifique os dados inseridos e tente novamente.<br> Caso o erro persista, contate o Desenvolvedor.</div><br>";
			echo "</div>";
			break;
		case 2 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Nenhuma op��o selecionada</div><br>";
			echo "</div>";
			break;
		case 0 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Nenhum resultado foi retornado</div><br>";
			echo "</div>";
			break;
		default :
			echo "<form method='POST' action='imprimir.php' target='print' >";
			echo "<input type='hidden' name='dados' value='".serialize($resultado2)."'/><br>";
			echo "<input type='submit' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' onclick=window.open('imprimir.php','print','scrollbars=no,menubar=no,height=600,width=800,resizable=yes,toolbar=no,status=no'); value='Imprimir'/>";
			echo "</form><br>";
			echo "Total de registro encontrados: ".$resultado[1]["total"];
			echo "<br>";
			echo "<br>";
			echo "<table class='mdl-data-table mdl-js-data-table  mdl-shadow--2dp'>";
			echo "<thead>";
			echo "<tr>";
			if (isset ( $resultado [0] ["nome"] )){
				$poetaSet = 1;
				echo "<th class='mdl-data-table__cell--non-numeric'>Poeta</th>";
			}
			if (isset ( $resultado [0] ["titulo"] )){
				$tituloSet =1;
				echo "<th class='mdl-data-table__cell--non-numeric'>Titulo</th>";
			}
			
			if (isset ( $resultado [0] ["contexto"] )){
				$contextoSet = 1;
				echo "<th class='mdl-data-table__cell--non-numeric'>Contexto</th>";
			}
			if (isset ( $resultado [0] ["figura"] )){
				$figuraSet = 1;
				echo "<th class='mdl-data-table__cell--non-numeric'>Figura</th>";
			}
			if (isset ( $resultado [0] ["tema"] )){
				$temaSet = 1;
				echo "<th class='mdl-data-table__cell--non-numeric'>Tema</th>";
			}
			if (isset ( $resultado [0] ["referencia"] )){
				$referenciaSet = 1;
				echo "<th class='mdl-data-table__cell--non-numeric'>Referência</th>";
			}
			if (isset ( $resultado [0] ["classe"] )){
				$classeSet = 1;
				echo "<th class='mdl-data-table__cell--non-numeric'>Classe Temática</th>";
			}
			echo "<th class='mdl-data-table__cell--non-numeric'></th>";
			echo "<th class='mdl-data-table__cell--non-numeric'></th>";
			echo "</tr>";
				
			echo "</thead>";
			echo "<tbody>";
				
			foreach ( $resultado as $row ) {

				echo "<tr>";
				if (isset($poetaSet) && $poetaSet == 1)
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $row ["nome"] . "</td>";
				if (isset($tituloSet) && $tituloSet == 1)
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $row["titulo"] . "</td>";
				if (isset($contextoSet) && $contextoSet == 1)
					echo "<td class='mdl-data-table__cell--non-numeric'><a href='?titulo=Conteudo/Contexto&page=contexto.php&contexto=" . $row ["contexto"] . "'>Exibir Contexto</a></td>";
				if (isset($figuraSet ) && $figuraSet ==1)
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $row ["figura"] . "</td>";
				if (isset($temaSet) && $temaSet ==1)
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $row ["tema"] . "</td>";
				if (isset($referenciaSet) && $referenciaSet ==1)
					echo "<td class='mdl-data-table__cell--non-numeric'><a href='?titulo=Referencia&page=referencia.php&referencia=" . $row ["referencia"]."'>Exibir Referencia</a></td>";
				if (isset($classeSet) && $classeSet ==1)
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $row ["classe"] . "</td>";


				echo "<td class='mdl-data-table__cell--non-numeric'><a href='?titulo=Alterar+Obra&page=alterar-obra.php&tituloObra=" . $row ["titulo"] . "&autor=" . $row ["nome"] . "&categoria=" . $row ["categoria"] . "&id=" . $row ["id"] . "'>Alterar</a></td>";
				echo "<td class='mdl-data-table__cell--non-numeric'><a href='?titulo=Excluir+Obra&page=excluir-obra.php&id=" . $row ["id"] . "'>Excluir</a></td>";
				echo "</tr>";
			}
				
			echo "</tbody>";
			echo "</table>";
			

			
			break;
	}
}

//CONSULTA DIVERSAS


elseif (isset ( $_POST ["op-diverso"] ) && isset ( $_POST ["tipo-consulta-diverso"] ) && isset ( $_POST ["pesquisa-diverso"] )) {

	$obj = new ObraDAO ();
	$resultado = $obj->consultaAvancadaDiversa ( $_POST ["op-diverso"], $_POST ["tipo-consulta-diverso"], $_POST ["pesquisa-diverso"] );
	switch ($resultado) {
		case 1 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Alteração não realizada! <br>Verifique os dados inseridos e tente novamente.<br> Caso o erro persista, contate o Desenvolvedor.</div><br>";
			echo "</div>";
			break;
		case 2 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Nenhuma opção selecionada</div><br>";
			echo "</div>";
			break;
		case 0 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Nenhum resultado foi retornado</div><br>";
			echo "</div>";
			break;
		default :
			echo "<form method='POST' action='imprimir.php' target='print' >";
			echo "<input type='hidden' name='dados' value='".serialize($resultado)."'/><br>";
			echo "<input type='submit' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' onclick=window.open('imprimir.php','print','scrollbars=no,menubar=no,height=600,width=800,resizable=yes,toolbar=no,status=no'); value='Imprimir'/>";
			echo "</form><br>";
			echo "Total de Registros encontrados: ".$resultado[5]["total"];
			echo "<br>";
			echo "<br>";
			echo "<table class='mdl-data-table mdl-js-data-table  mdl-shadow--2dp'>";
			echo "<thead>";
			echo "<tr>";
			if (isset ( $resultado [0] ["nome"] )){
				$NomePoetaSet = 1;
				echo "<th class='mdl-data-table__cell--non-numeric'>Poeta</th>";
			}
			if (isset ( $resultado [0] ["tema"] )){
				$temaSet =1;
				echo "<th class='mdl-data-table__cell--non-numeric'>Tema</th>";
			}
			
			if (isset ( $resultado [0] ["estado"] )){
				$estadoSet =1;
				echo "<th class='mdl-data-table__cell--non-numeric'>Estado</th>";
				echo "<th class='mdl-data-table__cell--non-numeric'>Quantidade</th>";
			}
				
			echo "</tr>";

			echo "</thead>";
			echo "<tbody>";

			foreach ( $resultado as $row ) {

				echo "<tr>";
				if (isset($NomePoetaSet) && $NomePoetaSet == 1)
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $row ["nome"] . "</td>";
		
				if (isset($temaSet) && $temaSet == 1)
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $row["tema"] . "</td>";
				
				if (isset($estadoSet) && $estadoSet == 1){
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $row["estado"] . "</td>";
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $row["count(a.estado)"] . "</td>";
				}
				

				echo "</tr>";
			}

			echo "</tbody>";
			echo "</table>";
				
			break;
	}
}

//ESTATISTICAS

elseif (isset ( $_POST ["tipo-estatistica"] ) && isset($_POST["argumento-estatistica"]) && isset ( $_POST ["pesquisa-estatistica"] )) {

	$obj = new ObraDAO ();
	$resultado = $obj->consultaEstatistica( $_POST ["tipo-estatistica"], $_POST["argumento-estatistica"], $_POST ["pesquisa-estatistica"] );
	switch ($resultado) {
		case 1 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Alteração não realizada! <br>Verifique os dados inseridos e tente novamente.<br> Caso o erro persista, contate o Desenvolvedor.</div><br>";
			echo "</div>";
			break;
		case 2 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Nenhuma op��o selecionada</div><br>";
			echo "</div>";
			break;
		case 0 :
			echo "<br>";
			echo " <div class='mdl-card mdl-shadow--2dp demo-card-wide' >";
			echo "<div align='center'><i class='material-icons'>highlight_off</i> Nenhum resultado foi retornado</div><br>";
			echo "</div>";
			break;
		default :
			echo "<form method='POST' action='imprimir.php' target='print' >";
			echo "<input type='hidden' name='dados' value='".serialize($resultado)."'/><br>";
			echo "<input type='submit' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect' onclick=window.open('imprimir.php','print','scrollbars=no,menubar=no,height=600,width=800,resizable=yes,toolbar=no,status=no'); value='Imprimir'/>";
			echo "</form><br>";

			echo "<table class='mdl-data-table mdl-js-data-table  mdl-shadow--2dp'>";
			echo "<thead>";
			echo "<tr>";
			if (isset ( $resultado [0] ["Numero de Poetas No Estado Selecionado"] )){
				$numeroPoetaEstado = 1;
				echo "<th class='mdl-data-table__cell--non-numeric'>Numero de Poetas no Estado Selecionado</th>";
			}
			if (isset ( $resultado [0] ["Numero de Cordeis No Estado Selecionado"] )){
				$numeroCordelEstado = 1;
				echo "<th class='mdl-data-table__cell--non-numeric'>Numero de Cordeis no Estado Selecionado</th>";
			}
			if (isset ( $resultado [0] ["Numero de Poetas que usam o Tema Selecionado"] )){
				$numeroPoetasTema = 1;
				echo "<th class='mdl-data-table__cell--non-numeric'>Numero de Poetas que usam o Tema Selecionado</th>";
			}
			if (isset ( $resultado [0] ["Numero de Cordeis com o Tema Selecionado"] )){
				$numeroCordelTema = 1;
				echo "<th class='mdl-data-table__cell--non-numeric'>Numero de Cordeis com o Tema Selecionado</th>";
			}
				

			echo "</tr>";

			echo "</thead>";
			echo "<tbody>";

			foreach ( $resultado as $row ) {

				echo "<tr>";
				if (isset($numeroPoetaEstado) && $numeroPoetaEstado == 1)
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $row ["Numero de Poetas No Estado Selecionado"] . "</td>";
				if (isset($numeroCordelEstado ) && $numeroCordelEstado  == 1)
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $row["Numero de Cordeis No Estado Selecionado"] . "</td>";
				if (isset($numeroPoetasTema ) && $numeroPoetasTema  == 1)
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $row["Numero de Poetas que usam o Tema Selecionado"] . "</td>";
				if (isset($numeroCordelTema ) && $numeroCordelTema  == 1)
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $row["Numero de Cordeis com o Tema Selecionado"] . "</td>";


				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";

			break;
	}
}
?>
