<?php

include 'banco.php';

class UsuarioDAO {
	private $bd;
	function __construct() {
		$dados = dados ();
		$this->bd = new PDO ( "mysql:host=" . $dados ["host"] . ";dbname=" . $dados ["banco"], $dados ["usuario"], $dados ["senha"], array (
				PDO::ATTR_PERSISTENT => true 
		) );
	}
	public function alterarDados($novoNome, $novoEmail, $novaSenha) {
		$stmt = $this->bd->prepare ( "UPDATE usuario SET nome = :novoNome, email = :novoEmail, senha = :novaSenha WHERE id = 1" );
		if ($stmt) {
			$stmt->bindParam ( ":novoNome", $novoNome, PDO::PARAM_STR );
			$stmt->bindParam ( ":novoEmail", $novoEmail, PDO::PARAM_STR );
			$stmt->bindParam ( ":novaSenha", $novaSenha, PDO::PARAM_STR );
			$stmt->execute ();
			if ($stmt->rowCount () > 0)
				return 1;
			else
				return 0;
		} else
			return 0;
	}
	public function getUsuario() {
		$stmt = $this->bd->prepare ( "SELECT * FROM usuario ORDER BY nome" );
		if ($stmt) {
			$stmt->execute ();
			$resultado = $stmt->fetchAll ();
			if (is_array ( $resultado ))
				return $resultado;
			else
				return false;
		} else
			return false;
	}
}
class AutorDAO {
	private $bd;
	function __construct() {
		$dados = dados ();
		$this->bd = new PDO ( "mysql:host=" . $dados ["host"] . ";dbname=" . $dados ["banco"], $dados ["usuario"], $dados ["senha"], array (
				PDO::ATTR_PERSISTENT => true 
		) );
	}
	
	// CADASTRAR AUTOR
	public function cadastrarAutor($autor) {
		$obj = new AutorDAO ();
		$resultado = $obj->localizarAutor ( $autor->getNome () );
		if ($resultado == true)
			return 2;
		else {
			$stmt = $this->bd->prepare ( "INSERT INTO autor VALUES(null, :nome, :data_nasc, :data_morte, :estado, :pseudonimo)" );
			if ($stmt) {
				$nome = $autor->getNome ();
				$data_nasc = $autor->getData_nasc ();
				$data_morte = $autor->getData_morte ();
				$estado = $autor->getEstado ();
				$pseudonimo = $autor->getPseudonimo ();
				$stmt->bindParam ( ":nome", $nome, PDO::PARAM_STR );
				$stmt->bindParam ( ":data_nasc", $data_nasc, PDO::PARAM_STR );
				$stmt->bindParam ( ":data_morte", $data_morte, PDO::PARAM_STR );
				$stmt->bindParam ( ":estado", $estado, PDO::PARAM_STR );
				$stmt->bindParam ( ":pseudonimo", $pseudonimo, PDO::PARAM_STR );
				$stmt->execute ();
				if ($stmt->rowCount () > 0)
					return 1;
				else
					
					return 0;
			} else
				
				return 0;
		}
	}

		//OBTER PAGINAS
	public function getPaginas($inicio, $qnt){
		$stmt = $this->bd->prepare ( "SELECT * FROM autor ORDER BY nome LIMIT $inicio, $qnt" );
		if ($stmt) {
			$stmt->execute ();
			$resultado = $stmt->fetchAll ();
			if (is_array ( $resultado ))
				return $resultado;
			else
				return false;
		} else
			return false;
	}

	//TOTAL DE OBRAS
	public function getTotalAutor(){
		$stmt = $this->bd->prepare ( "SELECT * FROM autor ORDER BY nome" );
		if ($stmt) {
			$stmt->execute ();

			$resultado = $stmt->rowCount();
			if ($resultado)
				return $resultado;
			else
				return false;
		} else
			return false;
	}

		public function PesquisarAutorPorId($id) {
		$stmt = $this->bd->prepare ( "SELECT * FROM autor  WHERE id LIKE $id" );
		if ($stmt) {
			$stmt->execute ();
			$resultado = $stmt->fetchAll ();
			if ($resultado)
				return $resultado;
			else
				return 0;
		} else
			return 1;
	}


	public function getAutores() {
		$stmt = $this->bd->prepare ( "SELECT * FROM autor ORDER BY nome" );
		if ($stmt) {
			$stmt->execute ();
			$resultado = $stmt->fetchAll ();
			if (is_array ( $resultado ))
				return $resultado;
			else
				return false;
		} else
			return false;
	}
	public function localizarAutor($nome) {
		$stmt = $this->bd->prepare ( "SELECT * FROM autor WHERE nome = :nome" );
		if ($stmt) {
			$stmt->bindParam ( ":nome", $nome, PDO::PARAM_STR );
			$stmt->execute ();
			$count = $stmt->rowCount ();
			if ($count == 0)
				return false;
			else
				return true;
		} else
			return false;
	}
	
	// ALTERAR AUTOR
	public function alterarAutor($id, $novoNome, $novoPseudonimo, $novaData_nasc, $novaData_morte, $novoEstado) {
		$stmt = $this->bd->prepare ( "UPDATE autor SET nome = :novoNome, data_nasc = :novaData_nasc, data_morte = :novaData_morte, estado = :novoEstado, pseudonimo = :novoPseudonimo WHERE id = :id" );
		if ($stmt) {
			$stmt->bindParam ( ":novoNome", $novoNome, PDO::PARAM_STR );
			$stmt->bindParam ( ":novaData_nasc", $novaData_nasc, PDO::PARAM_STR );
			$stmt->bindParam ( ":novaData_morte", $novaData_morte, PDO::PARAM_STR );
			$stmt->bindParam ( ":novoEstado", $novoEstado, PDO::PARAM_STR );
			$stmt->bindParam ( ":novoPseudonimo", $novoPseudonimo, PDO::PARAM_STR );
			$stmt->bindParam ( ":id", $id, PDO::PARAM_INT );
			$stmt->execute ();
			if ($stmt->rowCount () > 0)
				return 1;
			else
				return 0;
		} else
			return 0;
	}
	public function PesquisarAutor($nome) {
		$stmt = $this->bd->prepare ( "SELECT * FROM autor WHERE nome LIKE '%" . $nome . "%'" );
		if ($stmt) {
			$stmt->execute ();
			$resultado = $stmt->fetchAll ();
			if ($resultado)
				return $resultado;
			else
				return 0;
		} else
			return 1;
	}
	public function excluirAutor($id) {
		$stmt = $this->bd->prepare ( "SELECT * FROM autor a JOIN obra o ON a.id = o.codAutor WHERE a.id = :id" );
		if ($stmt) {
			$stmt->bindParam ( ":id", $id, PDO::PARAM_INT );
			$stmt->execute ();
			if ($stmt->rowCount () > 0)
				return 2;
			else {
				
				$stmt = $this->bd->prepare ( "DELETE FROM autor WHERE id = :id" );
				if ($stmt) {
					$stmt->bindParam ( ":id", $id, PDO::PARAM_INT );
					$stmt->execute ();
					if ($stmt->rowCount () > 0)
						return 1;
					else
						return 0;
				} else
					return 0;
			}
		} else
			return 0;
	}
	
	// CONSULTA AVAN�ADA
	public function consultaAvancada($op, $tipo, $argumento) {
		foreach ( $op as $value )
			
			if ($value == "nome")
				$selects ["nome"] = "nome";
			elseif ($value == "data_nasc")
				$selects ["data_nasc"] = "data_nasc";
			elseif ($value == "data_morte")
				$selects ["data_morte"] = "data_morte";
			elseif ($value == "estado")
				$selects ["estado"] = "estado";
			elseif ($value == "pseudonimo")
				$selects ["pseudonimo"] = "pseudonimo";
		
		$consulta = "SELECT a.id, ";
		
		switch ($tipo) {
			
			case "cordel" :
				foreach ( $selects as $value ) {
					
					$consulta .= "a." . $value . ", ";
				}
				
				$consultaFinal = substr ( $consulta, 0, - 2 );
				$consultaFinal .= " ";
				
				$stmt = $this->bd->prepare ( $consultaFinal . " FROM autor a JOIN obra o ON a.id = o.codAutor WHERE o.titulo LIKE '%" . $argumento . "%'" );
				if ($stmt) {
					$stmt->execute ();
					$resultado = $stmt->fetchAll ();
					$resultado["total"] = $stmt->rowCount(); 
					if ($resultado)
						return $resultado;
					else
						
						return 0;
				} else
					
					return 1;
				break;
			case "classe-tematica" :
				foreach ( $selects as $value ) {
					
					$consulta .= "a." . $value . ", ";
				}
				
				$consultaFinal = substr ( $consulta, 0, - 2 );
				$consultaFinal .= " ";
				$stmt = $this->bd->prepare ( $consultaFinal . " FROM autor a JOIN obra o ON a.id = o.codAutor JOIN categoria c ON o.codCateg = c.id WHERE c.titulo LIKE '%" . $argumento . "%'" );
				if ($stmt) {
					$stmt->execute ();
					$resultado = $stmt->fetchAll ();
					$resultado["total"] = $stmt->rowCount(); 
					if ($resultado)
						return $resultado;
					else
						
						return 0;
				} else
					
					return 1;
				break;
			case "data_nasc" :
				foreach ( $selects as $value ) {
					
					$consulta .= $value . ", ";
				}
				
				$consultaFinal = substr ( $consulta, 0, - 2 );
				$consultaFinal .= " ";
				$stmt = $this->bd->prepare ( $consultaFinal . " FROM autor WHERE data_nasc LIKE '%" . $argumento . "%'" );
				if ($stmt) {
					$stmt->execute ();
					$resultado = $stmt->fetchAll ();
					$resultado["total"] = $stmt->rowCount(); 
					if ($resultado)
						return $resultado;
					else
						
						return 0;
				} else
					
					return 1;
				break;
			case "data_morte" :
				foreach ( $selects as $value ) {
					
					$consulta .= $value . ", ";
				}
				
				$consultaFinal = substr ( $consulta, 0, - 2 );
				$consultaFinal .= " ";
				$stmt = $this->bd->prepare ( $consultaFinal . " FROM autor WHERE data_morte LIKE '%" . $argumento . "%'" );
				if ($stmt) {
					$stmt->execute ();
					$resultado = $stmt->fetchAll ();
					$resultado["total"] = $stmt->rowCount(); 
					if ($resultado)
						return $resultado;
					else
						
						return 0;
				} else
					
					return 1;
				break;
			case "estado" :
				foreach ( $selects as $value ) {
					
					$consulta .= $value . ", ";
				}
				
				$consultaFinal = substr ( $consulta, 0, - 2 );
				$consultaFinal .= " ";
				$stmt = $this->bd->prepare ( $consultaFinal . " FROM autor a WHERE a.estado LIKE '%" . $argumento . "%'" );
				if ($stmt) {
					$stmt->execute ();
					$resultado = $stmt->fetchAll ();
					$resultado["total"] = $stmt->rowCount(); 
					if ($resultado)
						return $resultado;
					else
						
						return 0;
				} else
					
					return 1;
				break;
		}
	}

	


}
class CategoriaDAO {
	private $bd;
	function __construct() {
		$dados = dados ();
		$this->bd = new PDO ( "mysql:host=" . $dados ["host"] . ";dbname=" . $dados ["banco"], $dados ["usuario"], $dados ["senha"], array (
				PDO::ATTR_PERSISTENT => true 
		) );
	}
	public function cadastrarCategoria($categoria) {
		$obj = new CategoriaDAO ();
		$resultado = $obj->localizarCategoria ( $categoria->getTitulo () );
		if ($resultado == true)
			return 2;
		else {
			$stmt = $this->bd->prepare ( "INSERT INTO categoria VALUES(null, :titulo)" );
			if ($stmt) {
				$titulo = $categoria->getTitulo ();
				$stmt->bindParam ( ":titulo", $titulo, PDO::PARAM_STR );
				$stmt->execute ();
				if ($stmt->rowCount () > 0)
					return 1;
				else
					return 0;
			} else
				return 0;
		}
	}
	public function alterarCategoria($id, $novoTitulo) {
		$stmt = $this->bd->prepare ( "UPDATE categoria SET titulo = :novoTitulo WHERE id = :id" );
		if ($stmt) {
			$stmt->bindParam ( ":novoTitulo", $novoTitulo, PDO::PARAM_STR );
			$stmt->bindParam ( ":id", $id, PDO::PARAM_INT );
			$stmt->execute ();
			if ($stmt->rowCount () > 0)
				return 1;
			else
				return 0;
		} else
			return 0;
	}


			//OBTER PAGINAS
	public function getPaginas($inicio, $qnt){
		$stmt = $this->bd->prepare ( "SELECT * FROM categoria ORDER BY titulo LIMIT $inicio, $qnt" );
		if ($stmt) {
			$stmt->execute ();
			$resultado = $stmt->fetchAll ();
			if (is_array ( $resultado ))
				return $resultado;
			else
				return false;
		} else
			return false;
	}

	//TOTAL DE OBRAS
	public function getTotalCategorias(){
		$stmt = $this->bd->prepare ( "SELECT * FROM categoria ORDER BY titulo" );
		if ($stmt) {
			$stmt->execute ();

			$resultado = $stmt->rowCount();
			if ($resultado)
				return $resultado;
			else
				return false;
		} else
			return false;
	}

	public function getCategorias() {
		$stmt = $this->bd->prepare ( "SELECT * FROM categoria ORDER BY titulo" );
		if ($stmt) {
			$stmt->execute ();
			$resultado = $stmt->fetchAll ();
			if (is_array ( $resultado ))
				return $resultado;
			else
				return false;
		} else
			return false;
	}
	public function localizarCategoria($titulo) {
		$stmt = $this->bd->prepare ( "SELECT * FROM categoria WHERE titulo = :titulo" );
		if ($stmt) {
			$stmt->bindParam ( ":titulo", $titulo, PDO::PARAM_STR );
			$stmt->execute ();
			$count = $stmt->rowCount ();
			if ($count == 0)
				return false;
			else
				return true;
		} else
			return false;
	}
	public function PesquisarCategoria($titulo) {
		$stmt = $this->bd->prepare ( "SELECT * FROM categoria WHERE titulo LIKE '%" . $titulo . "%'" );
		if ($stmt) {
			$stmt->execute ();
			$resultado = $stmt->fetchAll ();
			if ($resultado)
				return $resultado;
			else
				return 0;
		} else
			return 1;
	}
	public function excluirCategoria($id) {
		$stmt = $this->bd->prepare ( "SELECT * FROM categoria c JOIN obra o ON c.id = o.codCateg WHERE c.id = :id" );
		if ($stmt) {
			$stmt->bindParam ( ":id", $id, PDO::PARAM_INT );
			$stmt->execute ();
			if ($stmt->rowCount () > 0)
				return 2;
			else {
				$stmt = $this->bd->prepare ( "DELETE FROM categoria WHERE id = :id" );
				if ($stmt) {
					$stmt->bindParam ( ":id", $id, PDO::PARAM_INT );
					$stmt->execute ();
					if ($stmt->rowCount () > 0)
						return 1;
					else
						return 0;
				} else
					return 0;
			}
		} else
			return 0;
	}
	public function consultaAvancada($tipo, $argumento) {
		switch ($tipo) {
			case "cordeis" :
				
				$stmt = $this->bd->prepare ( "SELECT c.titulo FROM obra o JOIN categoria c ON c.id = o.codCateg WHERE o.titulo LIKE '%" . $argumento . "%'" );
				if ($stmt) {
					$stmt->execute ();
					$resultado = $stmt->fetchAll ();
					if ($resultado)
						return $resultado;
					else
						
						return 0;
				} else
					
					return 1;
				break;
			case "autores" :
				
				$stmt = $this->bd->prepare ( "SELECT c.titulo FROM autor a JOIN obra o ON a.id = o.codAutor JOIN categoria c ON o.codCateg = c.id WHERE a.nome LIKE '%" . $argumento . "%'" );
				if ($stmt) {
					$stmt->execute ();
					$resultado = $stmt->fetchAll ();
					if ($resultado)
						return $resultado;
					else
						
						return 0;
				} else
					
					return 1;
				break;
		}
	}
}
class ObraDAO {
	private $bd;
	function __construct() {
		$dados = dados ();
		$this->bd = new PDO ( "mysql:host=" . $dados ["host"] . ";dbname=" . $dados ["banco"], $dados ["usuario"], $dados ["senha"], array (
				PDO::ATTR_PERSISTENT => true 
		) );
	}
	
	// CADASTRAR OBRA
	public function cadastrarObra($obra) {
		$obj = new ObraDAO ();

			$stmt = $this->bd->prepare ( "INSERT INTO obra VALUES(null, :titulo, :autor, :categoria, :conteudo, :figura, :tema, :referencia)" );
			if ($stmt) {
				$titulo = $obra->getTitulo ();
				$autor = $obra->getAutor ();
				$categoria = $obra->getCategoria ();
				$conteudo = $obra->getConteudo ();
				$figura = $obra->getFigura ();
				$tema = $obra->getTema ();
				$referencia = $obra->getReferencia ();
				$stmt->bindParam ( ":titulo", $titulo, PDO::PARAM_STR );
				$stmt->bindParam ( ":autor", $autor, PDO::PARAM_INT );
				$stmt->bindParam ( ":categoria", $categoria, PDO::PARAM_INT );
				$stmt->bindParam ( ":conteudo", $conteudo, PDO::PARAM_INT );
				$stmt->bindParam ( ":figura", $figura, PDO::PARAM_STR );
				$stmt->bindParam ( ":tema", $tema, PDO::PARAM_STR );
				$stmt->bindParam ( ":referencia", $referencia, PDO::PARAM_STR );
				$stmt->execute ();
				if ($stmt->rowCount () > 0)
					return 1;
				else
					return 0;
			} else
				return 0;
		
	}


	//OBTER PAGINAS
	public function getPaginas($inicio, $qnt){
		$stmt = $this->bd->prepare ( "SELECT o.id, o.titulo, a.nome, c.titulo as 'categoria', o.contexto, o.figura, o.tema, o.referencia FROM obra o JOIN autor a JOIN categoria c ON o.codAutor = a.id AND o.codCateg = c.id UNION SELECT o.id, o.titulo, a.nome, o.codCateg as 'categoria', o.contexto, o.figura, o.tema, o.referencia FROM obra o JOIN autor a ON o.codAutor = a.id AND o.codCateg = 0  ORDER BY titulo LIMIT $inicio, $qnt" );
		if ($stmt) {
			$stmt->execute ();
			$resultado = $stmt->fetchAll ();
			if (is_array ( $resultado ))
				return $resultado;
			else
				return false;
		} else
			return false;
	}

	public function getPaginasTemas($inicio, $qnt){
		$stmt = $this->bd->prepare ( "SELECT DISTINCT o.tema FROM obra o JOIN autor a JOIN categoria c ON o.codAutor = a.id AND o.codCateg = c.id ORDER BY tema LIMIT $inicio, $qnt" );
		if ($stmt) {
			$stmt->execute ();
			$resultado = $stmt->fetchAll ();
			if (is_array ( $resultado ))
				return $resultado;
			else
				return false;
		} else
			return false;
	}


	//TOTAL DE OBRAS
	public function getTotalObras(){
		$stmt = $this->bd->prepare ( "SELECT * FROM obra o JOIN autor a ON o.codAutor = a.id" );
		if ($stmt) {
			$stmt->execute ();

			$resultado = $stmt->rowCount();
			if ($resultado)
				return $resultado;
			else
				return false;
		} else
			return false;
	}
	
	// OBTER TODAS AS OBRAS
	public function getObras() {
		$stmt = $this->bd->prepare ( "SELECT o.id, o.titulo, a.nome, c.titulo as 'categoria', o.contexto, o.figura, o.tema, o.referencia FROM obra o JOIN autor a JOIN categoria c ON o.codAutor = a.id AND o.codCateg = c.id UNION SELECT o.id, o.titulo, a.nome, o.codCateg as 'categoria', o.contexto, o.figura, o.tema, o.referencia FROM obra o JOIN autor a ON o.codAutor = a.id AND o.codCateg = 0  ORDER BY o.titulo" );
		if ($stmt) {
			$stmt->execute ();
			$resultado = $stmt->fetchAll ();
			if (is_array($resultado)){
			return $resultado;

		}
			else
				return false;
		} else
			return false;
	}
	
	// ALTERAR OBRA
	public function alterarObra($id, $novoTitulo, $novoAutor, $novaCategoria, $novoConteudo, $novaFigura, $novoTema, $novaReferencia) {
		$stmt = $this->bd->prepare ( "UPDATE obra SET titulo = :novoTitulo, codAutor = :codAutor, codCateg = :codCateg, contexto = :novoConteudo, figura = :novaFigura, tema = :novoTema, referencia = :novaReferencia WHERE id = :id" );
		if ($stmt) {
			$stmt->bindParam ( ":novoTitulo", $novoTitulo, PDO::PARAM_STR );
			$stmt->bindParam ( ":codAutor", $novoAutor, PDO::PARAM_INT );
			$stmt->bindParam ( ":codCateg", $novaCategoria, PDO::PARAM_INT );
			$stmt->bindParam ( ":novoConteudo", $novoConteudo, PDO::PARAM_STR );
			$stmt->bindParam ( ":id", $id, PDO::PARAM_INT );
			$stmt->bindParam ( ":novaFigura", $novaFigura, PDO::PARAM_STR );
			$stmt->bindParam ( ":novoTema", $novoTema, PDO::PARAM_STR );
			$stmt->bindParam ( ":novaReferencia", $novaReferencia, PDO::PARAM_STR );
			$stmt->execute ();
			if ($stmt->rowCount () > 0)
				return 1;
			else
				return 0;
		} else
			return 0;
	}
	// EXCLUIR OBRA
	public function excluirObra($id) {
		$stmt = $this->bd->prepare ( "DELETE FROM obra WHERE id = :id" );
		if ($stmt) {
			$stmt->bindParam ( ":id", $id, PDO::PARAM_INT );
			$stmt->execute ();
			if ($stmt->rowCount () > 0)
				return 1;
			else
				return 0;
		} else
			return 0;
	}
	public function localizarObra($titulo) {
		$stmt = $this->bd->prepare ( "SELECT * FROM obra WHERE titulo = :titulo" );
		if ($stmt) {
			$stmt->bindParam ( ":titulo", $titulo, PDO::PARAM_STR );
			$stmt->execute ();
			$count = $stmt->rowCount ();
			if ($count == 0)
				return false;
			else
				return true;
		} else
			return false;
	}
	public function PesquisarObra($titulo) {
		$stmt = $this->bd->prepare ( "SELECT o.id, o.titulo, a.nome, c.titulo as 'categoria', o.contexto FROM obra o JOIN autor a JOIN categoria c ON o.codAutor = a.id AND o.codCateg = c.id WHERE o.titulo LIKE '%".$titulo."%' UNION SELECT o2.id, o2.titulo, a2.nome, o2.codCateg as 'categoria', o2.contexto FROM obra o2 JOIN autor a2 ON o2.codAutor = a2.id AND o2.codCateg = 0 WHERE o2.titulo LIKE '%" . $titulo . "%'" );
		if ($stmt) {
			$stmt->execute ();
			$resultado = $stmt->fetchAll ();
			if ($resultado){
				return $resultado;
			
			}
			
			else
				return 0;
		} else
			return 1;
	}


	public function PesquisarObraPorId($id) {
		$stmt = $this->bd->prepare ( "SELECT o.id, o.titulo, a.nome, c.titulo as 'categoria', o.contexto, o.figura, o.tema, o.referencia FROM obra o JOIN autor a JOIN categoria c ON o.codAutor = a.id AND o.codCateg = c.id WHERE o.id LIKE $id UNION SELECT o2.id, o2.titulo, a2.nome, o2.codCateg as 'categoria', o2.contexto, o2.figura, o2.tema, o2.referencia FROM obra o2 JOIN autor a2 ON o2.codAutor = a2.id AND o2.codCateg = 0  WHERE o2.id LIKE $id" );
		if ($stmt) {
			$stmt->execute ();
			$resultado = $stmt->fetchAll ();
			if ($resultado)
				return $resultado;
			else
				return 0;
		} else
			return 1;
	}



	public function consultaAvancada($op, $tipo, $argumento) {
		foreach ( $op as $value ) {
			
			if ($value == "poeta")
				$selects ["nome-poeta"] = "a.nome";
			elseif ($value == "titulo")
				$selects ["titulo"] = "o.titulo";
			elseif ($value == "contexto")
				$selects ["contexto"] = "o.contexto";
			elseif ($value == "figura")
				$selects ["figura"] = "o.figura";
			elseif ($value == "tema")
				$selects ["tema"] = "o.tema";
			elseif ($value == "referencia")
				$selects ["referencia"] = "o.referencia";
			elseif ($value == "classe")
				$selects ["classe"] = "c.titulo as 'classe'";
			$consulta = "SELECT o.id, ";
			$consulta2 = "SELECT o.id, ";
		}
		
		switch ($tipo) {
			
			case "poeta" :
				foreach ( $selects as $value ) {
					if($value == "c.titulo as 'classe'"){
					
					$consulta2 .= "o.codCateg as 'classe'  ";
					$consulta .= $value . ", ";
				}else{
						$consulta2 .= $value . ", ";
						$consulta .= $value . ", ";

				}

				}
				
				$consultaFinal = substr ( $consulta, 0, - 2 );
				$consultaFinal .= " ";
				$consultaFinal2 = substr ( $consulta2, 0, - 2 );
				$consultaFinal2 .= " ";
			
				$stmt = $this->bd->prepare ( $consultaFinal ." FROM obra o JOIN autor a ON o.codAutor = a.id JOIN categoria c ON c.id = o.codCateg WHERE a.nome LIKE '%" . $argumento . "%' UNION ".$consultaFinal2." FROM obra o JOIN autor a ON o.codAutor = a.id AND o.codCateg = 0 WHERE a.nome LIKE '%" . $argumento . "%'" );
				if ($stmt) {
					$stmt->execute ();
					$resultado = $stmt->fetchAll ();
					$resultado["total"] = $stmt->rowCount();
					if ($resultado)
						return $resultado;
					else
						
						return 0;
				} else
					
					return 1;
				break;

			case "classe-tematica" :
				foreach ( $selects as $value ) {
					if($value == "c.titulo as 'classe'"){
					
					$consulta2 .= "o.codCateg as 'classe'  ";
					$consulta .= $value . ", ";
				}else{
						$consulta2 .= $value . ", ";
						$consulta .= $value . ", ";

				}

				}
				
				$consultaFinal = substr ( $consulta, 0, - 2 );
				$consultaFinal .= " ";
				$consultaFinal2 = substr ( $consulta2, 0, - 2 );
				$consultaFinal2 .= " ";
				
				$stmt = $this->bd->prepare ( $consultaFinal . " FROM obra o JOIN autor a ON o.codAutor = a.id JOIN categoria c ON c.id = o.codCateg WHERE c.titulo LIKE '%" . $argumento . "%'" );
				if ($stmt) {
					$stmt->execute ();
					$resultado = $stmt->fetchAll ();
					$resultado["total"] = $stmt->rowCount();
					if ($resultado)
						return $resultado;
					else
						
						return 0;
				} else
					
					return 1;
				break;


			case "contexto" :
				foreach ( $selects as $value ) {
					if($value == "c.titulo as 'classe'"){
					
					$consulta2 .= "o.codCateg as 'classe'  ";
					$consulta .= $value . ", ";
				}else{
						$consulta2 .= $value . ", ";
						$consulta .= $value . ", ";

				}

				}
				
				$consultaFinal = substr ( $consulta, 0, - 2 );
				$consultaFinal .= " ";
				$consultaFinal2 = substr ( $consulta2, 0, - 2 );
				$consultaFinal2 .= " ";
				
				$stmt = $this->bd->prepare ( $consultaFinal . " FROM obra o JOIN autor a ON o.codAutor = a.id JOIN categoria c ON c.id = o.codCateg WHERE o.contexto LIKE '%" . $argumento . "%'" );
				if ($stmt) {
					$stmt->execute ();
					$resultado = $stmt->fetchAll ();
					$resultado["total"] = $stmt->rowCount();
					if ($resultado)
						return $resultado;
					else
						
						return 0;
				} else
					
					return 1;
				break;
			case "figura" :
				foreach ( $selects as $value ) {
					if($value == "c.titulo as 'classe'"){
					
					$consulta2 .= "o.codCateg as 'classe'  ";
					$consulta .= $value . ", ";
				}else{
						$consulta2 .= $value . ", ";
						$consulta .= $value . ", ";

				}

				}
				$consultaFinal = substr ( $consulta, 0, - 2 );
				$consultaFinal .= " ";
				$consultaFinal2 = substr ( $consulta2, 0, - 2 );
				$consultaFinal2 .= " ";
				
				$stmt = $this->bd->prepare ( $consultaFinal . " FROM  obra o JOIN autor a ON o.codAutor = a.id JOIN categoria c ON c.id = o.codCateg WHERE o.figura LIKE '%" . $argumento . "%'" );
				if ($stmt) {
					$stmt->execute ();
					$resultado = $stmt->fetchAll ();
					$resultado["total"] = $stmt->rowCount();
					if ($resultado)
						return $resultado;
					else
						
						return 0;
				} else
					
					return 1;
				break;
			case "tema" :
				foreach ( $selects as $value ) {
					if($value == "c.titulo as 'classe'"){
					
					$consulta2 .= "o.codCateg as 'classe'  ";
					$consulta .= $value . ", ";
				}else{
						$consulta2 .= $value . ", ";
						$consulta .= $value . ", ";

				}

				}
				$consultaFinal = substr ( $consulta, 0, - 2 );
				$consultaFinal .= " ";
				$consultaFinal2 = substr ( $consulta2, 0, - 2 );
				$consultaFinal2 .= " ";
				
				$stmt = $this->bd->prepare ( $consultaFinal . " FROM  obra o JOIN autor a ON o.codAutor = a.id JOIN categoria c ON c.id = o.codCateg WHERE o.tema LIKE '%" . $argumento . "%'" );
				if ($stmt) {
					$stmt->execute ();
					$resultado = $stmt->fetchAll ();
					$resultado["total"] = $stmt->rowCount();
					if ($resultado)
						return $resultado;
					else
						
						return 0;
				} else
					
					return 1;
				break;


			case "referencia" :
				foreach ( $selects as $value ) {
					if($value == "c.titulo as 'classe'"){
					
					$consulta2 .= "o.codCateg as 'classe'  ";
					$consulta .= $value . ", ";
				}else{
						$consulta2 .= $value . ", ";
						$consulta .= $value . ", ";

				}

				}
				
				$consultaFinal = substr ( $consulta, 0, - 2 );
				$consultaFinal .= " ";
				$consultaFinal2 = substr ( $consulta2, 0, - 2 );
				$consultaFinal2 .= " ";
				
				$stmt = $this->bd->prepare ( $consultaFinal . " FROM  obra o JOIN autor a ON o.codAutor = a.id JOIN categoria c ON c.id = o.codCateg WHERE o.referencia LIKE '%" . $argumento . "%'" );
				if ($stmt) {
					$stmt->execute ();
					$resultado = $stmt->fetchAll ();
					$resultado["total"] = $stmt->rowCount();
					if ($resultado)
						return $resultado;
					else
						
						return 0;
				} else
					
					return 1;
				break;

				case "estado" :

				foreach ( $selects as $value ) {
				
						$consulta .= $value . "   , ";

				}

				
				$consultaFinal = substr ( $consulta, 0, - 2 );
				$consultaFinal .= " ";
				
				$stmt = $this->bd->prepare ( $consultaFinal . " FROM  obra o JOIN autor a ON o.codAutor = a.id JOIN categoria c ON c.id = o.codCateg WHERE a.estado LIKE '%" . $argumento . "%'  " );
				if ($stmt) {
					$stmt->execute ();
					$resultado = $stmt->fetchAll ();
					$resultado[1]["total"] = $stmt->rowCount();
					if ($resultado){
			
						return $resultado;
					}
					else
						return 0;
				}
				 else
					return 1;
				
				break;
			}
		}
	
		public function getFiguras() {
		$stmt = $this->bd->prepare ( "SELECT DISTINCT figura FROM obra ORDER BY figura" );
		if ($stmt) {
			$stmt->execute ();
			$resultado = $stmt->fetchAll ();
			$resultado["total"] = $stmt->rowCount();
			if (is_array ( $resultado ))
				return $resultado;
			else
				return false;
		} else
			return false;
	}

	public function getTemas() {
		$stmt = $this->bd->prepare ( "SELECT DISTINCT tema FROM obra ORDER BY tema" );
		if ($stmt) {
			$stmt->execute ();
			$resultado = $stmt->fetchAll ();
			$resultado["total"] = $stmt->rowCount();
			if (is_array ( $resultado ))
				return $resultado;
			else
				return false;
		} else
			return false;
	}


	public function consultaAvancadaDiversa($op, $tipo, $argumento) {
		foreach ( $op as $value ) {
			
			if ($value == "nome-poeta-diversos")
				$selects ["nome-poeta"] = "a.nome";
			elseif ($value == "estado-diversos")
				$selects ["estado"] = "a.estado, count(a.estado)";
			elseif ($value == "tema-diversos")
				$selects ["tema"] = "o.tema";
			$consulta = "SELECT ";
			$consulta2 = "SELECT ";
		}
		
		switch ($tipo) {
			
			case "classe-tematica" :
				foreach ( $selects as $value ) {
					
					$consulta .= $value . ", ";
				}
				
				$consultaFinal = substr ( $consulta, 0, - 2 );
				$consultaFinal .= " ";
				$stmt = $this->bd->prepare ( $consultaFinal . " FROM obra o JOIN autor a ON o.codAutor = a.id JOIN categoria c ON c.id = o.codCateg WHERE c.titulo LIKE '%" . $argumento . "%'" );
				if ($stmt) {
					$stmt->execute ();
					$resultado = $stmt->fetchAll ();
					$resultado[5]["total"] = $stmt->rowCount();
					if ($resultado)
						return $resultado;
					else
						
						return 0;
				} else
					
					return 1;
				break;
			
			case "contexto" :
				foreach ( $selects as $value ) {
					
					$consulta .= $value . ", ";
				}
				
				$consultaFinal = substr ( $consulta, 0, - 2 );
				$consultaFinal .= " ";
				
				$stmt = $this->bd->prepare ( $consultaFinal . " FROM obra o JOIN autor a ON o.codAutor = a.id JOIN categoria c ON c.id = o.codCateg WHERE o.contexto LIKE '%" . $argumento . "%'" );
				if ($stmt) {
					$stmt->execute ();
					$resultado = $stmt->fetchAll ();
					$resultado[5]["total"] = $stmt->rowCount();
					if ($resultado)
						return $resultado;
					else
						
						return 0;
				} else
					
					return 1;
				break;
			case "figura" :
				foreach ( $selects as $value ) {
					
					$consulta .= $value . ", ";
				}
				
				$consultaFinal = substr ( $consulta, 0, - 2 );
				$consultaFinal .= " ";
				
				$stmt = $this->bd->prepare ( $consultaFinal . " FROM  obra o JOIN autor a ON o.codAutor = a.id JOIN categoria c ON c.id = o.codCateg WHERE o.figura LIKE '%" . $argumento . "%'" );
				if ($stmt) {
					$stmt->execute ();
					$resultado = $stmt->fetchAll ();
					$resultado[5]["total"] = $stmt->rowCount();
					if ($resultado)
						return $resultado;
					else
						
						return 0;
				} else
					
					return 1;
				break;
			case "tema" :
				foreach ( $selects as $value ) {
					if($value == "a.estado, count(a.estado)" ){
					$consulta .= $value . ", ";
					$consulta2 .= "a.estado " . ", ";
				}else{
						$consulta .= $value . ", ";
						$consulta2 .= $value . ", ";

				}
				}
				
				$consultaFinal = substr ( $consulta, 0, - 2 );
				$consultaFinal .= " ";
				$consultaFinal2 = substr ( $consulta2, 0, - 2 );
				$consultaFinal2 .= " ";
				
				$stmt = $this->bd->prepare ( $consultaFinal . " FROM  obra o JOIN autor a ON o.codAutor = a.id JOIN categoria c ON c.id = o.codCateg WHERE o.tema LIKE '%" . $argumento . "%' group by estado  having count(estado)" );
				if ($stmt) {
					$stmt->execute ();
					$resultado = $stmt->fetchAll ();
					if ($resultado){
					$stmt2 = $this->bd->prepare ( $consultaFinal2 . " FROM  obra o JOIN autor a ON o.codAutor = a.id JOIN categoria c ON c.id = o.codCateg WHERE o.tema LIKE '%" . $argumento . "%'" );
				if ($stmt2) {
					$stmt2->execute ();
					$resultado[5]["total"] = $stmt2->rowCount();
					return $resultado;

				}



					}
					else
						
						return 0;
				} else
					
					return 1;
				break;

			case "tema" :
				foreach ( $selects as $value ) {
					if($value == "a.estado, count(a.estado)" ){
					$consulta .= $value . ", ";
					$consulta2 .= "a.estado " . ", ";
				}else{
						$consulta .= $value . ", ";
						$consulta2 .= $value . ", ";

				}
				}
				
				$consultaFinal = substr ( $consulta, 0, - 2 );
				$consultaFinal .= " ";
				$consultaFinal2 = substr ( $consulta2, 0, - 2 );
				$consultaFinal2 .= " ";
				
				$stmt = $this->bd->prepare ( $consultaFinal . " FROM  obra o JOIN autor a ON o.codAutor = a.id JOIN categoria c ON c.id = o.codCateg WHERE o.tema LIKE '%" . $argumento . "%' group by estado  having count(estado)" );
				if ($stmt) {
					$stmt->execute ();
					$resultado = $stmt->fetchAll ();
					if ($resultado){
					$stmt2 = $this->bd->prepare ( $consultaFinal2 . " FROM  obra o JOIN autor a ON o.codAutor = a.id JOIN categoria c ON c.id = o.codCateg WHERE o.tema LIKE '%" . $argumento . "%'" );
				if ($stmt2) {
					$stmt2->execute ();
					$resultado[5]["total"] = $stmt2->rowCount();
					return $resultado;

				}



					}
					else
						
						return 0;
				} else
					
					return 1;
				break;
			case "referencia" :
				foreach ( $selects as $value ) {
					
					$consulta .= $value . ", ";
				}
				
				$consultaFinal = substr ( $consulta, 0, - 2 );
				$consultaFinal .= " ";
				
				$stmt = $this->bd->prepare ( $consultaFinal . " FROM  obra o JOIN autor a ON o.codAutor = a.id JOIN categoria c ON c.id = o.codCateg WHERE o.referencia LIKE '%" . $argumento . "%'" );
				if ($stmt) {
					$stmt->execute ();
					$resultado = $stmt->fetchAll ();
					$resultado[5]["total"] = $stmt->rowCount();

					if ($resultado)
						return $resultado;
					else
						
						return 0;
				} else
					
					return 1;
				break;
		}
	}
	public function consultaEstatistica($tipo, $argumento, $pesquisa) {
		if ($tipo == "poetas") {
			switch ($argumento) {
				
				case "estado" :
					$stmt = $this->bd->prepare ( "SELECT count(nome) as 'Numero de Poetas No Estado Selecionado' FROM  autor WHERE estado LIKE '%" . $pesquisa . "%'" );
					if ($stmt) {
						$stmt->execute ();
						$resultado = $stmt->fetchAll ();
						if ($resultado)
							return $resultado;
						else
							
							return 0;
					} else
						
						return 1;
					break;
				case "tema" :
					$stmt = $this->bd->prepare ( "SELECT count(o.tema) as 'Numero de Poetas que usam o Tema Selecionado' FROM  obra o JOIN autor a ON o.codAutor = a.id JOIN categoria c ON c.id = o.codCateg WHERE o.tema LIKE '%" . $pesquisa . "%'" );
					if ($stmt) {
						$stmt->execute ();
						$resultado = $stmt->fetchAll ();
						if ($resultado)
							return $resultado;
						else
							
							return 0;
					} else
						
						return 1;
					break;
			}
		} elseif ($tipo = "cordeis") {
			
			switch ($argumento) {
				
				case "estado" :
					$stmt = $this->bd->prepare ( "SELECT count(o.titulo) as 'Numero de Cordeis No Estado Selecionado' FROM  obra o JOIN autor a ON o.codAutor = a.id JOIN categoria c ON c.id = o.codCateg WHERE a.estado LIKE '%" . $pesquisa . "%'" );
					if ($stmt) {
						$stmt->execute ();
						$resultado = $stmt->fetchAll ();
						if ($resultado)
							return $resultado;
						else
							
							return 0;
					} else
						
						return 1;
					break;
				case "tema" :
					$stmt = $this->bd->prepare ( "SELECT count(o.tema) as 'Numero de Cordeis com o Tema Selecionado' FROM  obra o JOIN autor a ON o.codAutor = a.id JOIN categoria c ON c.id = o.codCateg WHERE o.tema LIKE '%" . $pesquisa . "%'" );
					if ($stmt) {
						$stmt->execute ();
						$resultado = $stmt->fetchAll ();
						if ($resultado)
							return $resultado;
						else
							
							return 0;
					} else
						
						return 1;
					break;
			}
		} else
			return 2;
	}
}
class login {
	private $bd;
	function __construct() {
		$dados = dados ();
		$this->bd = new PDO ( "mysql:host=" . $dados ["host"] . ";dbname=" . $dados ["banco"], $dados ["usuario"], $dados ["senha"], array (
				PDO::ATTR_PERSISTENT => true 
		) );
	}
	public function logar($email, $senha) {
		$stmt = $this->bd->prepare ( "SELECT * FROM usuario WHERE email = :email AND senha = :senha" );
		if ($stmt) {
			$stmt->bindParam ( ":email", $email, PDO::PARAM_STR );
			$stmt->bindParam ( ":senha", $senha, PDO::PARAM_STR );
			$stmt->execute ();
			$dados = $stmt->fetchAll ();
			
			if ($stmt->rowCount () > 0) {
				
				session_start ();
				$_SESSION ["logado"] = true;
				$_SESSION ["nome"] = $dados [0] ["nome"];
				$_SESSION ["email"] = $email;
				return true;
			} else {
				header ( "Location:index.php?error=Login+Incorreto!" );
				return false;
			}
		} 

		else {
			header ( "Location:index.php?error=Login+Incorreto!" );
			return false;
		}
	}
	public function logout() {
		session_start ();
		session_unset ();
	}
}

?>