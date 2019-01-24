<?php

class Categoria{

    private $titulo;

    
    function __construct($titulo){
        $this->titulo = $titulo;
        }
    
    function getTitulo(){
        return $this->titulo;
    }
    
    function setTitulo($titulo){
    	
    	$this->titulo = $titulo;
    }
}
?>