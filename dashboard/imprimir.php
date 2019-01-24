<?php
 header('Content-Type: text/html; charset=utf-8');
$resultado =  unserialize($_REQUEST['dados']);
print_r($resultado);
$texto = "";
$texto .="Total de ".$resultado["total"]." registros.";
$texto .= "<br>";
$texto .= "<br>";
$texto .= "<table border=1 >";
			$texto .= "<thead>";
			$texto .= "<tr>";
			if (isset ( $resultado [0] ["nome"] )){
				$poetaSet = 1;
				$texto .= "<th>Poeta</th>";
			}

			if (isset ( $resultado [0] ["pseudonimo"] )){
				$pseudonimoSet =1;
				$texto .= "<th>Pseudônimo</th>";
			}
			if (isset ( $resultado [0] ["data_nasc"] )){
				$datanascSet =1;
				$texto .= "<th>Data de Nascimento</th>";
			}
			if (isset ( $resultado [0] ["data_morte"] )){
				$datamorteSet =1;
				$texto .= "<th>Data de Falecimento</th>";
			}
			if (isset ( $resultado [0] ["titulo"] )){
				$tituloSet =1;
				$texto .= "<th>Titulo</th>";
			}
			
			if (isset ( $resultado [0] ["categoria"] )){
				$categoriaSet = 1;
				$texto .= "<th >Classe Temática</th>";
			}
			if (isset ( $resultado [0] ["contexto"] )){
				$contextoSet = 1;
				$texto .= "<th >Contexto</th>";
			}
                       
			if (isset ( $resultado [0] ["figura"] )){
				$figuraSet = 1;
				$texto .= "<th>Figura</th>";
			}
			if (isset ( $resultado [0] ["tema"] )){
				$temaSet = 1;
				$texto .= "<th >Tema</th>";
			}
			if (isset ( $resultado [0] ["referencia"] )){
				$referenciaSet = 1;
				$texto .= "<th >Referência</th>";
			}
			if (isset ( $resultado [0] ["classe"] )){
				$classeSet = 1;
				$texto .= "<th >Classe Temática</th>";
			}
			if (isset ( $resultado [0] ["estado"] )){
				$estadoSet = 1;
				$texto .= "<th >Estado</th>";
			}
			if (isset ( $resultado [0] ["count(a.estado)"] )){
				$quantidadeSet =1;
				$texto .= "<th>Quantidade</th>";
			}
			if (isset ( $resultado [0] ["Numero de Poetas No Estado Selecionado"] )){
				$numPoetaEstadoSet = 1;
				$texto .= "<th >Número de Poetas No Estado Selecionado</th>";
			}
			if (isset ( $resultado [0] ["Numero de Cordeis No Estado Selecionado"] )){
				$numCordeisEstadoSet = 1;
				$texto .= "<th >Número de Cordeis No Estado Selecionado</th>";
			}
			if (isset ( $resultado [0] ["Numero de Poetas que usam o Tema Selecionado"] )){
				$numPoetasUsaTemaSet = 1;
				$texto .= "<th >Número de Poetas que usam o Tema Selecionado</th>";
			}
			if (isset ( $resultado [0] ["Numero de Cordeis com o Tema Selecionado"] )){
				$numCordeisComTemaSet = 1;
				$texto .= "<th >Número de Cordeis com o Tema Selecionado</th>";
			}
			$texto .= "</tr>";
				
			$texto .= "</thead>";
			$texto .= "<tbody>";
				
			foreach ( $resultado as $row ) {

				$texto .= "<tr>";
				if (isset($poetaSet) && $poetaSet == 1)
					$texto .= "<td >" . $row ["nome"] . "</td>";
				if (isset($pseudonimoSet) && $pseudonimoSet == 1)
					$texto .= "<td >" . $row ["pseudonimo"] . "</td>";
				if (isset($datanascSet) && $datanascSet == 1){
					if($row["data_nasc"] == 0)
					$texto .= "<td > --- </td>";
					else
					$texto .= "<td >" . $row ["data_nasc"] . "</td>";
				}
				if (isset($datamorteSet) && $datamorteSet == 1){
					if($row["data_morte" == 0])
					$texto .= "<td > --- </td>";
					else
					$texto .= "<td >" . $row ["data_morte"] . "</td>";
				}
				if (isset($tituloSet) && $tituloSet == 1)
					$texto .= "<td >" . $row["titulo"] . "</td>";
                                if (isset($categoriaSet) && $categoriaSet == 1)
					$texto .= "<td >" . $row ["categoria"] . "</td>";
				if (isset($contextoSet) && $contextoSet == 1)
					$texto .= "<td >" . $row ["contexto"] . "</td>";
				if (isset($figuraSet ) && $figuraSet ==1)
					$texto .= "<td >" . $row ["figura"] . "</td>";
				if (isset($temaSet) && $temaSet ==1)
					$texto .= "<td >" . $row ["tema"] . "</td>";
				if (isset($referenciaSet) && $referenciaSet ==1)
					$texto .= "<td >". $row ["referencia"]."</td>";
				if (isset($classeSet) && $classeSet ==1)
					$texto .= "<td '>" . $row ["classe"] . "</td>";
				if (isset($estadoSet) && $estadoSet ==1)
					$texto .= "<td '>" . $row ["estado"] . "</td>";
				if (isset($quantidadeSet) && $quantidadeSet ==1)
					$texto .= "<td '>" . $row ["count(a.estado)"] . "</td>";
				if (isset($numPoetaEstadoSet ) && $numPoetaEstadoSet  ==1)
					$texto .= "<td '>" . $row ["Numero de Poetas No Estado Selecionado"] . "</td>";
				if (isset($numCordeisEstadoSet) && $numCordeisEstadoSet ==1)
					$texto .= "<td '>" . $row ["Numero de Cordeis No Estado Selecionado"] . "</td>";
				if (isset($numPoetasUsaTemaSet) && $numPoetasUsaTemaSet ==1)
					$texto .= "<td '>" . $row ["Numero de Poetas que usam o Tema Selecionado"] . "</td>";
				if (isset($numCordeisComTemaSet) && $numCordeisComTemaSet ==1)
					$texto .= "<td '>" . $row ["Numero de Cordeis com o Tema Selecionado"] . "</td>";
				$texto .= "</tr>";
			}
				
			$texto .= "</tbody>";
			$texto .= "</table>";
			
			echo $texto;

			
			
?>		