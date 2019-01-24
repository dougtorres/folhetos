<?php
class Autor {
	private $nome;
	private $data_nasc;
	private $data_morte;
	private $estado;
	private $pseudonimo;
	function __construct($nome, $pseudonimo, $data_nasc, $data_morte, $estado) {
		$this->nome = $nome;
		$this->data_nasc = $data_nasc;
		$this->data_morte = $data_morte;
		$this->estado = $estado;
		$this->pseudonimo = $pseudonimo;
	}
	function getNome() {
		return $this->nome;
	}
	function setNome($nome) {
		$this->nome = $nome;
	}
	function getData_nasc() {
		return $this->data_nasc;
	}
	function setData_nasc($data) {
		$this->data_nasc = $data;
	}
	function getData_morte() {
		return $this->data_morte;
	}
	function setData_morte($data) {
		$this->data_morte = $data;
	}
	function getEstado() {
		return $this->estado;
	}
	function setEstado($estado) {
		$this->estado = $estado;
	}
	function getPseudonimo() {
		return $this->pseudonimo;
	}
	function setPseudonimo($pseudonimo) {
		$this->pseudonimo = $pseudonimo;
	}
}
?>