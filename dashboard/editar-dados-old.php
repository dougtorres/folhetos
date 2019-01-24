<?php
include_once '../config.php';
if (! isset ( $_SESSION )) {
	session_start ();
	if (! $_SESSION ['logado'])
		header ( "Location:../index.php" );
}

$obj3 = new ObraDAO ();
$obras = $obj3->getObras ();

echo "<h6>Cordeis</h6>";
echo "<table class='mdl-data-table mdl-js-data-table  mdl-shadow--2dp'>";
echo "<thead>";
echo "<tr>";
echo "<th class='mdl-data-table__cell--non-numeric'>Poeta</th>";
echo "<th class='mdl-data-table__cell--non-numeric'>Titulo</th>";
echo "<th class='mdl-data-table__cell--non-numeric'>Contexto</th>";
echo "<th class='mdl-data-table__cell--non-numeric'>Figura</th>";
echo "<th class='mdl-data-table__cell--non-numeric'>Tema</th>";
echo "<th class='mdl-data-table__cell--non-numeric'>Refer�ncia</th>";
echo "<th class='mdl-data-table__cell--non-numeric'>Classe Temática</th>";
echo "<th class='mdl-data-table__cell--non-numeric'></th>";
echo "<th class='mdl-data-table__cell--non-numeric'></th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
foreach ( $obras as $row ) {
	echo "<tr>";
	echo "<td class='mdl-data-table__cell--non-numeric'>" . $row ["nome"] . "</td>";
	echo "<td class='mdl-data-table__cell--non-numeric'>" . $row ["titulo"] . "</td>";
	echo "<td class='mdl-data-table__cell--non-numeric'><a href='?titulo=Conteudo/Contexto&page=contexto.php&contexto=" . $row ["contexto"] . "&tituloObra=" . $row ["titulo"] . "'>Exibir Contexto</a></td>";
	echo "<td class='mdl-data-table__cell--non-numeric'>" . $row ["figura"] . "</td>";
	echo "<td class='mdl-data-table__cell--non-numeric'>" . $row ["tema"] . "</td>";
	echo "<td class='mdl-data-table__cell--non-numeric'><a href='?titulo=Referencia&page=referencia.php&referencia=" . $row ["referencia"] . "&tituloObra=" . $row ["titulo"] . "'>Exibir Referencia</a></td>";
	echo "<td class='mdl-data-table__cell--non-numeric'>" . $row ["categoria"] . "</td>";
	echo "<td class='mdl-data-table__cell--non-numeric'><a href='?titulo=Alterar+Obra&page=alterar-obra.php&tituloObra=" . $row ["titulo"] . "&autor=" . $row ["nome"] . "&categoria=" . $row ["categoria"] . "&id=" . $row ["id"] . "&contexto=" . $row ["contexto"] . "&figura=" . $row ["figura"] . "&tema=" . $row ["tema"] . "&referencia=" . $row ["referencia"] . "'>Alterar</a></td>";
	echo "<td class='mdl-data-table__cell--non-numeric'><a href='?titulo=Excluir+Obra&page=excluir-obra.php&id=" . $row ["id"] . "'>Excluir</a></td>";
	echo "</tr>";
}
echo "</tbody>";
echo "</table>";

$obj = new CategoriaDAO ();
$categorias = $obj->getCategorias ();

echo "<h6>Classes Temáticas</h6>";
echo "<table class='mdl-data-table mdl-js-data-table  mdl-shadow--2dp'>";
echo "<thead>";
echo "<tr>";
echo "<th class='mdl-data-table__cell--non-numeric'>Classe Temática</th>";
echo "<th class='mdl-data-table__cell--non-numeric'></th>";
echo "<th class='mdl-data-table__cell--non-numeric'></th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
foreach ( $categorias as $row ) {
	echo "<tr>";
	echo "<td class='mdl-data-table__cell--non-numeric'>" . $row ["titulo"] . "</td>";
	echo "<td><a href='?titulo=Alterar+Categoria&page=alterar-categoria.php&id=" . $row ["id"] . "&categoria=" . $row ["titulo"] . "'>Alterar</a></td>";
	echo "<td><a href='?titulo=Excluir+Categoria&page=excluir-categoria.php&id=" . $row ["id"] . "'>Excluir</a></td>";
	echo "</tr>";
}
echo "</tbody>";
echo "</table>";
$obj2 = new AutorDAO ();
$autores = $obj2->getAutores ();
echo "<h6>Poetas</h6>";
echo "<table class='mdl-data-table mdl-js-data-table  mdl-shadow--2dp'>";
echo "<thead>";

echo "<th class='mdl-data-table__cell--non-numeric'>Poeta</th>";
echo "<th class='mdl-data-table__cell--non-numeric'>Pseudônimo</th>";
echo "<th class='mdl-data-table__cell--non-numeric'>Ano do Nascimento</th>";
echo "<th class='mdl-data-table__cell--non-numeric'>Ano da Morte</th>";
echo "<th class='mdl-data-table__cell--non-numeric'>Estado</th>";
echo "<th class='mdl-data-table__cell--non-numeric'></th>";
echo "<th class='mdl-data-table__cell--non-numeric'></th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
foreach ( $autores as $row ) {
	if ($row ["data_nasc"] == "0") {
		
		$data_nasc = "Sem informação";
	} else {
		
		$data_nasc = $row ["data_nasc"];
	}
	
	if ($row ["data_morte"] == "0") {
		
		$data_morte = "Sem informação";
	} else {
		
		$data_morte = $row ["data_morte"];
	}
	echo "<tr>";
	echo "<td class='mdl-data-table__cell--non-numeric'>" . $row ["nome"] . "</td>";
	echo "<td class='mdl-data-table__cell--non-numeric'>" . $row ["pseudonimo"] . "</td>";
	echo "<td class='mdl-data-table__cell--non-numeric'>" . $data_nasc . "</td>";
	echo "<td class='mdl-data-table__cell--non-numeric'>" . $data_morte . "</td>";
	echo "<td class='mdl-data-table__cell--non-numeric'>" . $row ["estado"] . "</td>";
	echo "<td><a href='?titulo=Alterar+Autor&page=alterar-autor.php&id=" . $row ["id"] . "&autor=" . $row ["nome"] . "&data_nasc=" . $row ["data_nasc"] . "&data_morte=" . $row ["data_morte"] . "&estado=" . $row ["estado"] . "&pseudonimo=" . $row ["pseudonimo"] . "'>Alterar</a></td>";
	echo "<td><a href='?titulo=Excluir+Autor&page=excluir-autor.php&id=" . $row ["id"] . "'>Excluir</a></td>";
	echo "</tr>";
}
echo "</tbody>";
echo "</table>";

?>