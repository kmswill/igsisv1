<?php

// Funções específicas do módulo Formação

function retornaPrograma($id){
	$programa = recuperaDados("sis_formacao_programa",$id,"Id_Programa");
	return $programa['Programa'];	
}

function retornaCargo($id){
	$programa = recuperaDados("sis_formacao_cargo",$id,"Id_Cargo");
	return $programa['Cargo'];	
}

function retornaStatus($id){
	if($id != 0){
		return "Ativo";
	}else{
		return "Inativo";	
	}	
}

?>
