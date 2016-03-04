<?php

function somaVerba($idInstituicao,$pessoa){
	$con = bancoMysqli();
	$sql = "SELECT * FROM sis_verba WHERE idInstituicao = '$idInstituicao' AND pai IS NOT NULL";
	$query = mysqli_query($con,$sql);
	$total = 0;
	while($valor = mysqli_fetch_array($query)){
		$total = $total + $valor[$pessoa];
	}
	return $total;		
	
}

function somaPedido($idInstituicao,$pessoa){
	$con = bancoMysqli();
	$sql = "SELECT * FROM igsis_pedido_contratacao,ig_evento,ig_usuario WHERE igsis_pedido_contratacao.idEvento = ig_evento.idEvento AND ig_evento.idUsuario = ig_usuario.idUsuario AND ig_usuario.idInstituicao = '$idInstituicao' AND igsis_pedido_contratacao.tipoPessoa = '$pessoa' AND igsis_pedido_contratacao.publicado = '1'"; //recupera todos os pedidos pessoa física
	$query = mysqli_query($con,$sql);
	$total = 0;
	while($valor = mysqli_fetch_array($query)){
		$total = $total + $valor['valor'];	
	}	
	return $total;
}

function sunVerba($idVerba,$tipoPessoa){
	$con = bancoMysqli();
	$sql = "SELECT * FROM igsis_pedido_contratacao WHERE idVerba = '$idVerba' AND publicado = '1' AND tipoPessoa = '$tipoPessoa' AND NumeroNotaEmpenho <> '' AND NumeroNotaEmpenho IS NOT NULL";
	$query = mysqli_query($con,$sql);	
	$valor = 0;
	while ($verba = mysqli_fetch_array($query)){
		$idPedido = $verba['idPedidoContratacao'];
		$valor = $valor + $verba['valor'];
		$sql_multipla = "SELECT * FROM sis_verbas_multiplas WHERE idPedidoContratacao = '$idPedido' AND idVerba = '$idVerba'";
		$query_mulitpla = mysqli_query($con,$sql_multipla);
		while($multipla = mysqli_fetch_array($query_mulitpla)){
			$valor = $valor + $multipla['valor'];
		} 
		
	}	
	
	return $valor;
	
	
}

function geraOpcaoVerba($idUsuario,$selected){
	$con = bancoMysqli();
	$sql = "SELECT * FROM igsis_controle_orcamento WHERE idUsuario = '$idUsuario'";
	$query = mysqli_query($con,$sql);
	while($verba = mysqli_fetch_array($query)){
		$ver = recuperaDados("sis_verba",$verba['idVerba'],"Id_Verba");
		if($verba['idVerba'] == $selected){
			echo "<option value='".$verba['idVerba']."' selected >".$ver['Verba']."</option>";	
		}else{
			echo "<option value='".$verba['idVerba']."' >".$ver['Verba']."</option>";				
		}	
	}
	

}

function sqlVerbaIn($idUsuario){
	$con = bancoMysqli();
	$sql = "SELECT * FROM igsis_controle_orcamento WHERE idUsuario = '$idUsuario'";
	$query = mysqli_query($con,$sql);
	$verbaTxt = "";
	while($verba = mysqli_fetch_array($query)){
		$verbaTxt .= $verba['idVerba'].",";
	}
	return substr($verbaTxt,0,-1);
}


?>
