<?php

$id_ped = $_GET['id_ped'];
$server = "http://".$_SERVER['SERVER_NAME']."/igsis/";
$http = $server."/pdf/";
$link1=$http."rlt_pagamento_integral_1rep_pj.php";
$link2=$http."rlt_pagamento_integral_2rep_pj.php";
$link3=$http."rlt_pagamento_parcelado_1rep_pj.php";
$link4=$http."rlt_pagamento_parcelado_2rep_pj.php";
$link5=$http."rlt_recibo_pagamento_1rep_pj.php";
$link6=$http."rlt_recibo_pagamento_2rep_pj.php";	

	$con = bancoMysqli();
if(isset($_POST['atualizar'])){ // atualiza o pedido
	$ped = $_GET['id_ped'];

	$sql_atualiza_pedido = "UPDATE igsis_pedido_contratacao SET
		estado = 14
		WHERE idPedidoContratacao = '$id_ped'";
	if(mysqli_query($con,$sql_atualiza_pedido)){
			$mensagem = "
			<div class='form-group'>
    		  <div class='col-md-offset-2 col-md-8'><hr/></div>
			</div><br/>
			<h5>Qual documento deseja gerar?</h5>
			<div class='col-md-offset-1 col-md-10'>
			<div class='form-group'>
    		  <div class='col-md-offset-2 col-md-2'><h6>01<br/>Representante</h6></div>
			  <div class='col-md-2'>
				<a href='$link1?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Integral</a><br/></div>
			  <div class='col-md-2'>
				<a href='$link2?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Parcelado</a><br/></div>
			  <div class='col-md-2'>
				<a href='$link3?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Recibo</a><br/></div>
			</div>
			
			<div class='form-group'>
    		  <div class='col-md-offset-2 col-md-8'><br/></div>
			</div>
			
			<div class='form-group'>
    		  <div class='col-md-offset-2 col-md-2'><h6>02<br/>Representantes</h6></div>
			  <div class='col-md-2'>
				<a href='$link4?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Integral</a><br/></div>
			  <div class='col-md-2'>
				<a href='$link5?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Parcelado</a><br/></div>
			  <div class='col-md-2'>
				<a href='$link6?id=$id_ped' class='btn btn-theme btn-lg btn-block' target='_blank'>Recibo</a><br/></div>
			</div>
			
			
			<div class='form-group'>
    		  <div class='col-md-offset-2 col-md-8'><hr/></div>
			</div>
	
	
	";	
		}else{
			$mensagem = "Erro ao atualizar! Tente novamente.";
		}
		
	}


$ano=date('Y');
$id_ped = $_GET['id_ped'];	
$linha_tabelas = siscontrat($id_ped);
$pj = siscontratDocs($linha_tabelas['IdProponente'],2);


?>


<!-- MENU -->	
<?php include 'includes/menu.php';?>
	
    
  	
	  
	 <!-- Contact -->
<section id="contact" class="home-section bg-white">
	<div class="container">
		<div class="form-group"><h2>CONTRATAÇÃO DE PESSOA JURÍDICA</h2>
        <h4><?php if(isset($mensagem)){ echo $mensagem; } ?></h4></div>
		<div class="row">
	  	<div class="col-md-offset-1 col-md-10">
            <div class="col-md-offset-2 col-md-8">
            <div class="left">
                <p align="justify"><strong>Código do pedido de contratação:</strong> <?php echo $ano."-".$id_ped; ?></p>
				<p align="justify"><strong>Número do Processo:</strong> <?php echo $linha_tabelas['NumeroProcesso'];?></p>
                <p align="justify"><strong>Setor:</strong> <?php echo $linha_tabelas['Setor'];?></p>	
				<p align="justify"><strong>Proponente:</strong> <?php echo $pj['Nome'];?></p>
                <p align="justify"><strong>Objeto:</strong> <?php echo $linha_tabelas['Objeto'];?></p>
                <p align="justify"><strong>Local:</strong> <?php echo $linha_tabelas['Local'];?></p>
                <p align="justify"><strong>Valor:</strong> R$ <?php echo dinheiroParaBr($linha_tabelas["ValorGlobal"]);?></p>
                <p align="justify"><strong>Data/Período:</strong> <?php echo $linha_tabelas['Periodo'];?></p>
                <p align="justify"><strong>Duração:</strong> <?php echo $linha_tabelas['Duracao'];?>utos</p>
                <p align="justify"><strong>Carga Horária:</strong> <?php echo $linha_tabelas['CargaHoraria'];?></p>
                <p align="justify"><strong>Fiscal:</strong> <?php echo $linha_tabelas['Fiscal'];?></p>
                <p align="justify"><strong>Suplente:</strong> <?php echo $linha_tabelas['Suplente'];?></p>
                <p align="justify"><strong>Observação:</strong> <?php echo $linha_tabelas['Observacao'];?></p>
                <p align="justify"><strong>Data do Cadastro:</strong> <?php echo exibirDataBr($linha_tabelas['DataCadastro']);?></p>                
			</div>
            </div>
            <form class="form-horizontal" role="form" action="?perfil=pagamento&p=frm_cadastra_pagamento_pj&id_ped=<?php echo $id_ped; ?>" method="post">
				<div class="col-md-offset-2 col-md-8">
					 <input type="submit" name="atualizar" class="btn btn-theme btn-lg btn-block" value="Confirmar">
				</div>
            </form> 
      </div>
      </div>
      </div>
   </div>
</section>         