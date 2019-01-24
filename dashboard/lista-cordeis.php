<?php
include_once '../config.php';
if (! isset ( $_SESSION )) {
	session_start ();
	if (! $_SESSION ['logado'])
		header ( "Location:../index.php" );
}

$obj= new ObraDAO ();
$obras = $obj->getObras ();

echo "<h6>Cordeis</h6>";
echo "<form method='POST' action='#'>
Registros por página: <input type='text' size=1 name='rg'/>
<input type='submit' value='ok' />
</form><br>";
echo "<table class='mdl-data-table mdl-js-data-table  mdl-shadow--2dp'>";
echo "<thead>";
echo "<tr>";
echo "<th class='mdl-data-table__cell--non-numeric'>Poeta</th>";
echo "<th class='mdl-data-table__cell--non-numeric'>Titulo</th>";
echo "<th class='mdl-data-table__cell--non-numeric'>Contexto</th>";
echo "<th class='mdl-data-table__cell--non-numeric'>Figura</th>";
echo "<th class='mdl-data-table__cell--non-numeric'>Tema</th>";
echo "<th class='mdl-data-table__cell--non-numeric'>Referência</th>";
echo "<th class='mdl-data-table__cell--non-numeric'>Classe Temática</th>";
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

	$aux = $obj->getTotalObras();
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
echo "<br>";

// Depois que selecionou todos os nome, pula uma linha para exibir os links(próxima, última...) echo "<br />"; 
// Faz uma nova seleção no banco de dados, desta vez sem LIMIT, 
// para pegarmos o número total de registros 
$sql_select_all = $obj->getObras();
// Executa o query da seleção acimas 
// Gera uma variável com o número total de registros no banco de dados 
$total_registros = $obj->getTotalObras(); 
// Gera outra variável, desta vez com o número de páginas que será precisa.
 // O comando ceil() arredonda "para cima" o valor 
$pags = ceil($total_registros/$qnt); 
// Número máximos de botões de paginação 
$max_links = 3;
 // Exibe o primeiro link "primeira página", que não entra na contagem acima(3) 
echo "<a href='?titulo=Editar Cordeis&page=lista-cordeis.php&p=1' target='_self'>Primeira Página</a> "; 
// Cria um for() para exibir os 3 links antes da página atual 
for($i = $p-$max_links; $i <= $p-1; $i++) {
 // Se o número da página for menor ou igual a zero, não faz nada
 // (afinal, não existe página 0, -1, -2..) 
if($i <=0) { 
//faz nada 
// Se estiver tudo OK, cria o link para outra página 
} else { 
echo "<a href='?titulo=Editar Cordeis&page=lista-cordeis.php&p=$i' target='_self'>  $i </a> "; 
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
echo "<a href='?titulo=Editar Cordeis&page=lista-cordeis.php&p=$i' target='_self'> $i </a> ";
 }
 }
 // Exibe o link "última página" 
echo "<a href='?titulo=Editar Cordeis&page=lista-cordeis.php&p=$pags' target='_self'>Última Página</a> ";
echo "<br><br>";
echo "Total: $total_registros registros";

 ?>

