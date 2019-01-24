<?php
include_once '../config.php';
if (! isset ( $_SESSION )) {
	session_start ();
	if (! $_SESSION ['logado'])
		header ( "Location:../index.php" );
}

$obj = new AutorDAO ();
$autores = $obj->getAutores ();

echo "<h6>Poetas</h6>";
echo "<form method='POST' action='#'>
Registros por página: <input type='text' size=1 name='rg'/>
<input type='submit' value='ok' />
</form><br>";
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

$p = $_GET["p"];
//verifica se a variável tá declarada, senão deixa na primeira página como padrão 
if(isset($p)) { 
$p = $p; 
} 
else {

$p = 1;

}
 // Defina aqui a quantidade máxima de registros por página. 
if(isset($_POST["rg"]) && $_POST["rg"] != 0){

	$aux = $obj->getTotalAutor();
	if($_POST["rg"] > $aux){
		$qnt = $aux;
	}else {
	$qnt = $_POST["rg"];
}
} 
else {

	$qnt = 10;
}

// O sistema calcula o início da seleção calculando:
 // (página atual * quantidade por página) - quantidade por página 
$inicio = ($p*$qnt) - $qnt; 
$sql_query = $obj->getPaginas($inicio, $qnt);

foreach ($sql_query as $row) {
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
echo "<br>";

// Depois que selecionou todos os nome, pula uma linha para exibir os links(próxima, última...) echo "<br />"; 
// Faz uma nova seleção no banco de dados, desta vez sem LIMIT, 
// para pegarmos o número total de registros 
$sql_select_all = $obj->getAutores();
// Executa o query da seleção acimas 
// Gera uma variável com o número total de registros no banco de dados 
$total_registros = $obj->getTotalAutor(); 
// Gera outra variável, desta vez com o número de páginas que será precisa.
 // O comando ceil() arredonda "para cima" o valor 
$pags = ceil($total_registros/$qnt); 
// Número máximos de botões de paginação 
$max_links = 3;
 // Exibe o primeiro link "primeira página", que não entra na contagem acima(3) 
echo "<a href='?titulo=Editar Poetas&page=lista-autores.php&p=1' target='_self'>Primeira Página</a> "; 
// Cria um for() para exibir os 3 links antes da página atual 
for($i = $p-$max_links; $i <= $p-1; $i++) {
 // Se o número da página for menor ou igual a zero, não faz nada
 // (afinal, não existe página 0, -1, -2..) 
if($i <=0) { 
//faz nada 
// Se estiver tudo OK, cria o link para outra página 
} else { 
echo "<a href='?titulo=Editar Poetas&page=lista-autores.php&p=$i' target='_self'>  $i </a> "; 
} 
} 
// Exibe a página atual, sem link, apenas o número
echo $p." "; 
// Cria outro for(), desta vez para exibir 3 links após a página atual 
for($i = $p+1; $i <= $p+$max_links; $i++) { 
// Verifica se a página atual é maior do que a última página. Se for, não faz nada. 
if($i > $pags) {
 //faz nada 
} 
// Se tiver tudo Ok gera os links. 
else {
echo "<a href='?titulo=Editar Poetas&page=lista-autores.php&p=$i' target='_self'> $i </a> ";
 }
 }
 // Exibe o link "última página" 
echo "<a href='?titulo=Editar Poetas&page=lista-autores.php&p=$pags' target='_self'>Última Página</a> ";
echo "<br><br>";
echo "Total: $total_registros registros";

 ?>

