<?php
class Obra {
	private $titulo;
	private $codAutor;
	private $codCategoria;
	private $conteudo;
	private $figura;
	private $tema;
	private $referencia;
	function __construct($titulo, $codAutor, $codCategoria, $conteudo, $figura, $tema, $referencia) {
		$this->titulo = $titulo;
		$this->codAutor = $codAutor;
		$this->codCategoria = $codCategoria;
		$this->conteudo = $conteudo;
		$this->figura = $figura;
		$this->tema = $tema;
		$this->referencia = $referencia;
	}
	function getTitulo() {
		return $this->titulo;
	}
	function setTitulo($titulo) {
		$this->titulo = $titulo;
	}
	function getAutor() {
		return $this->codAutor;
	}
	function setAutor($autor) {
		$this->codAutor = $autor;
	}
	function getCategoria() {
		return $this->codCategoria;
	}
	function setCategoria($categoria) {
		$this->codCategoria = $categoria;
	}
	function getConteudo() {
		return $this->conteudo;
	}
	function setConteudo($conteudo) {
		$this->conteudo = $conteudo;
	}
	function getFigura() {
		return $this->figura;
	}
	function setFigura($figura) {
		$this->figura = $figura;
	}
	function getTema() {
		return $this->tema;
	}
	function setTema($tema) {
		$this->tema = $tema;
	}
	function getReferencia() {
		return $this->referencia;
	}
	function setReferencia($referencia) {
		$this->referencia = $referencia;
	}
}
?>