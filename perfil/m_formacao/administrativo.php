<?php

$con = bancoMysqli();
if(isset($_GET['pag'])){
	$p = $_GET['pag'];
}else{
	$p = 'inicial';	
}
//$nomeEvento = recuperaEvento($_SESSION['idEvento']);

?>
<?php include "includes/menu_administrativo.php"; ?>


<?php switch($p){

/* =========== INICIAL ===========*/
case 'inicial':
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h3> Acesso Administrativo</h3>
<p>  </p>
<p>Aqui você acessa a parte administrativa do módulo Formação.</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php /* =========== INICIAL ===========*/ break; ?>



<?php
/* =========== INÍCIO CADASTRA CARGO ===========*/
case 'add_cargo':
?>    
<section id="contact" class="home-section bg-white">
	<div class="container">
		<div class="form-group">
			<div class="sub-title">
            	<h2>CADASTRO DE CARGO</h2>
                <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
			</div>
		</div>
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<form class="form-horizontal" role="form" action="#" method="post">
				<div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Cargo: *</strong>
						<input type="text" class="form-control" id="Cargo" name="Cargo" placeholder="Cargo"> 
					</div>
				</div>
					
				<div class="form-group">
					<div class="col-md-offset-2 col-md-8">
						<input type="submit" class="btn btn-theme btn-lg btn-block" value="Gravar">
					</div>
				</div>
			</form>
		</div>		
	</div>
</div>
</section> 

<?php 
break;
case 'list_cargo':

   if(isset($_POST['atualizar'])){
		$idCargo = $_POST['Id_Cargo'];		   
		$cargo = $_POST['Cargo'];		   
		$sql_atualiza_cargoo = "UPDATE sis_cargo SET
		Cargo = '$cargo'
		WHERE Id_Cargo = '$idCargo'";
		$con = bancoMysqli();
		$query_atualiza_cargo = mysqli_query($con,$sql_atualiza_cargo);
		if($query_atualiza_cargo){
			$mensagem = "Atualizado com sucesso!";
		}else{
			$mensagem = "Erro ao atualizar.";	
		}		   
   }
?> 

	<section id="list_items">
		<div class="container">
             <div class="col-md-offset-2 col-md-8">
                <br />
                <h2>CARGO</h2>
                    <p><?php if(isset($mensagem)){ echo $mensagem; } ?></p>
    				<br/>
                </div>
			<div class="table-responsive list_info">
				<table class="table table-condensed">
					<thead>
						<tr class="list_menu">
							<td>Id</td>
							<td>Cargo</td>
  							<td></td>
						</tr>
					</thead>
					<tbody>
<?php
$sql = "SELECT * FROM sis_formacao_cargo" ;
$query = mysqli_query($con,$sql);
while($cargo = mysqli_fetch_array($query)){
?>

<tr>
<form action="?perfil=formacao&p=administrativo&pag=list_cargo" method="post">
<td><?php echo $cargo['Id_Cargo']; ?></td>
<td><input type="text" name="cargo" class="form-control" value="<?php echo $cargo['Cargo']; ?>"/></td>
<td>
<input type="hidden" name="atualizar" value="<?php echo $cargo['Id_Cargo']; ?>" />
<input type ='submit' class='btn btn-theme  btn-block' value='atualizar'></td>
</form>

</tr>
	
    <?php } ?>
					
					</tbody>
				</table>

			</div>

            </div>            
		</div>
	</section>
<?php /* =========== FIM CARGO ===========*/ break; ?>




<?php 
/* =========== INÍCIO COORDENADORIA ===========*/
case 'add_coordenadoria': 
?>
<section id="contact" class="home-section bg-white">
	<div class="container">
		<div class="form-group">
			<div class="sub-title">
            	<h2>CADASTRO DE COORDENADORIA</h2>
                <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
			</div>
		</div>
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<form class="form-horizontal" role="form" action="#" method="post">
				<div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Coordenadoria: *</strong>
						<input type="text" class="form-control" id="Coordenadoria" name="Coordenadoria" placeholder="Coordenadoria"> 
					</div>
				</div>
					
				<div class="form-group">
					<div class="col-md-offset-2 col-md-8">
						<input type="submit" class="btn btn-theme btn-lg btn-block" value="Gravar">
					</div>
				</div>
			</form>
		</div>		
	</div>
</div>
</section> 

<?php 
break;
case 'list_coordenadoria':
/*
   if(isset($_POST['atualizar'])){
		$idCargo = $_POST['Id_Cargo'];		   
		$cargo = $_POST['Cargo'];		   
		$sql_atualiza_cargoo = "UPDATE sis_cargo SET
		Cargo = '$cargo'
		WHERE Id_Cargo = '$idCargo'";
		$con = bancoMysqli();
		$query_atualiza_cargo = mysqli_query($con,$sql_atualiza_cargo);
		if($query_atualiza_cargo){
			$mensagem = "Atualizado com sucesso!";
		}else{
			$mensagem = "Erro ao atualizar.";	
		}		   
   }*/
?> 
	<section id="list_items">
		<div class="container">
             <div class="col-md-offset-2 col-md-8">
                <br />
                <h2>COORDENADORIA</h2>
                    <p><?php if(isset($mensagem)){ echo $mensagem; } ?></p>
    				<br/>
                </div>
			<div class="table-responsive list_info">
				<table class="table table-condensed">
					<thead>
						<tr class="list_menu">
							<td>Id</td>
							<td colspan="2">Coordenadoria</td>
  							<td></td>
						</tr>
					</thead>
					<tbody>
<?php
$sql = "SELECT * FROM sis_formacao_coordenadoria" ;
$query = mysqli_query($con,$sql);
while($projeto = mysqli_fetch_array($query)){
?>

<tr>
<form action="" method="post">
<td><?php echo $coordenadoria['Id_Coordenadoria']; ?></td>
<td colspan="2"><input type="text" name="projeto" class="form-control" value="<?php echo $coordenadoria['Coordenadoria']; ?>"/></td>
<td>
<input type="hidden" name="idCoordenadoria" value="<?php echo $coordenadoria['Id_Coordenadoria']; ?>" />
<input type="hidden" name="atualizar" value="<?php echo $coordenadoria['Id_Coordenadoria']; ?>" />
<input type ='submit' class='btn btn-theme  btn-block' value='atualizar'></td>
</form>

</tr>
	
    <?php } ?>
					
					</tbody>
				</table>

			</div>

            </div>            
		</div>
	</section>
<?php /* =========== FIM COORDENADORIA ===========*/ break; ?>




<?php 
/* =========== INÍCIO EQUIPAMENTO ===========*/
case 'add_equipamento':
?>
<section id="contact" class="home-section bg-white">
	<div class="container">
		<div class="form-group">
			<div class="sub-title">
            	<h2>CADASTRO DE DETALHES DO EQUIPAMENTO</h2>
                <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
			</div>
		</div>
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<form class="form-horizontal" role="form" action="#" method="post">
				<div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Equipamento: *</strong>
                        <select class="form-control" id="IdEquipamento" name="IdEquipamento">  
					    </select>
					</div>
				</div>
                
                <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Região:</strong>
                    	<select class="form-control" id="IdRegiao" name="IdRegiao">  
					 	</select>
					</div>
					<div class="col-md-6"><strong>Subprefeitura:</strong>
                    	<select class="form-control" id="IdSubprefeitura" name="IdSubprefeitura">  
					 	</select>
					</div>
				</div>
                
                <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Telefone #1 do Equipamento: *</strong>
                    	<input type="text" class="form-control" id="Tel1Responsavel" name="Tel1Responsavel" />
					</div>
                    <div class="col-md-6"><strong>Telefone #2 do Equipamento:</strong>
                    	<input type="text" class="form-control" id="Tel2Responsavel" name="Tel2Responsavel" />
					</div>
				</div>
                
                <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>E-mail do equipamento:</strong><br/>
					  <input type="text" class="form-control" id="EmailEquipamento" name="EmailEquipamento">
					</div>
                    <div class="col-md-6"><strong>CEP: *</strong>
                    	<input type="text" class="form-control" id="CEP" name="CEP" />
					</div>
				</div>
                
                <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Endereço *:</strong><br/>
					  <input type="text" class="form-control" id="Endereco" name="Endereco" placeholder="Endereço">
					</div>
				</div>
                
                <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Número *:</strong><br/>
					  <input type="text" class="form-control" id="Numero" name="Numero" placeholder="Numero">
					</div>				  
					<div class=" col-md-6"><strong>Complemento:</strong><br/>
					  <input type="text" class="form-control" id="Complemento" name="Complemento" placeholder="Complemento">
					</div>
				</div>
                
                <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Bairro: *</strong><br/>
						<input type="text" class="form-control" id="Bairro" name="Bairro" placeholder="Bairro">  
					</div>
                </div>
                
                <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Cidade: *</strong><br/>
						<input type="text" class="form-control" id="Cidade" name="Cidade" placeholder="Cidade">
					</div>
                    <div class="col-md-6"><strong>Estado: *</strong><br/>
					  <input type="text" class="form-control" id="Estado" name="Estado" placeholder="Estado">
					</div>
                </div>
                                                
                <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Nome do Responsável: *</strong>
                    	<input type="text" class="form-control" id="NomeResponsavel" name="NomeResponsavel" />
					</div>
				</div>
                
                <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Telefone #1 do Responsável: *</strong>
                    	<input type="text" class="form-control" id="Tel1Responsavel" name="Tel1Responsavel" />
					</div>
                    <div class="col-md-6"><strong>Telefone #2 do Responsável:</strong>
                    	<input type="text" class="form-control" id="Tel2Responsavel" name="Tel2Responsavel" />
					</div>
				</div>
                
                <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Email do Responsável:</strong>
                    	<input type="text" class="form-control" id="EmailResponsavel" name="EmailResponsavel" />
					</div>
                </div>
                <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Observação:</strong><br/>
					 <textarea name="Observacao" class="form-control" rows="5"></textarea>
					</div>
				</div>
					
				<div class="form-group">
					<div class="col-md-offset-2 col-md-8">
						<input type="submit" class="btn btn-theme btn-lg btn-block" value="Gravar">
					</div>
				</div>
			</form>
		</div>		
	</div>
</div>
</section>

<?php 
break;
case 'list_equipamento':
?> 

	<section id="list_items">
		<div class="container">
			 <div class="sub-title">EQUIPAMENTO</div>
			<div class="table-responsive list_info">
				<table class="table table-condensed">
					<thead>
						<tr class="list_menu">
							<td>Id</td>
							<td>Equipamento</td>
                            <td>Região</td>
                            <td>Telefone Equipamento</td>
						</tr>
					</thead>
					<tbody>
                    </tbody>
				</table>
			</div>
		</div>
	</section>    

<?php /* =========== FIM EQUIPAMENTO ===========*/ break; ?>




<?php 
/* =========== INÍCIO LINGUAGEM ===========*/
case 'add_linguagem':
?>
<section id="contact" class="home-section bg-white">
	<div class="container">
		<div class="form-group">
			<div class="sub-title">
            	<h2>CADASTRO DE LINGUAGEM</h2>
                <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
			</div>
		</div>
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<form class="form-horizontal" role="form" action="#" method="post">
				<div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Linguagem: *</strong>
						<input type="text" class="form-control" id="Linguagem" name="Linguagem" placeholder="Linguagem"> 
					</div>
				</div>
					
				<div class="form-group">
					<div class="col-md-offset-2 col-md-8">
						<input type="submit" class="btn btn-theme btn-lg btn-block" value="Gravar">
					</div>
				</div>
			</form>
		</div>		
	</div>
</div>
</section> 

<?php 
break;
case 'list_linguagem':
/*
   if(isset($_POST['atualizar'])){
		$idCargo = $_POST['Id_Cargo'];		   
		$cargo = $_POST['Cargo'];		   
		$sql_atualiza_cargoo = "UPDATE sis_cargo SET
		Cargo = '$cargo'
		WHERE Id_Cargo = '$idCargo'";
		$con = bancoMysqli();
		$query_atualiza_cargo = mysqli_query($con,$sql_atualiza_cargo);
		if($query_atualiza_cargo){
			$mensagem = "Atualizado com sucesso!";
		}else{
			$mensagem = "Erro ao atualizar.";	
		}		   
   }*/
?> 

	<section id="list_items">
		<div class="container">
             <div class="col-md-offset-2 col-md-8">
                <br />
                <h2>LINGUAGEM</h2>
                    <p><?php if(isset($mensagem)){ echo $mensagem; } ?></p>
    				<br/>
                </div>
			<div class="table-responsive list_info">
				<table class="table table-condensed">
					<thead>
						<tr class="list_menu">
							<td>Id</td>
							<td colspan="2">Linguagem</td>
  							<td></td>
						</tr>
					</thead>
					<tbody>
<?php
$sql = "SELECT * FROM sis_formacao_linguagem" ;
$query = mysqli_query($con,$sql);
while($linguagem = mysqli_fetch_array($query)){
?>

<tr>
<form action="" method="post">
<td><?php echo $linguagem['Id_Linguagem']; ?></td>
<td colspan="2"><input type="text" name="projeto" class="form-control" value="<?php echo $linguagem['Linguagem']; ?>"/></td>
<td>
<input type="hidden" name="idLinguagem" value="<?php echo $linguagem['Id_Linguagem']; ?>" />
<input type="hidden" name="atualizar" value="<?php echo $linguagem['Id_Linguagem']; ?>" />
<input type ='submit' class='btn btn-theme  btn-block' value='atualizar'></td>
</form>

</tr>
	
    <?php } ?>
					
					</tbody>
				</table>

			</div>

            </div>            
		</div>
	</section>
<?php /* =========== FIM LINGUAGEM ===========*/ break; ?> 




<?php 
/* =========== INÍCIO PROJETO ===========*/
case 'add_projeto':
?>

<section id="contact" class="home-section bg-white">
	<div class="container">
		<div class="form-group">
			<div class="sub-title">
            	<h2>CADASTRO DE PROJETO</h2>
                <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
			</div>
		</div>
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<form class="form-horizontal" role="form" action="#" method="post">
				<div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Projeto: *</strong>
						<input type="text" class="form-control" id="Projeto" name="Projeto" placeholder="Projeto"> 
					</div>
				</div>
					
				<div class="form-group">
					<div class="col-md-offset-2 col-md-8">
						<input type="submit" class="btn btn-theme btn-lg btn-block" value="Gravar">
					</div>
				</div>
			</form>
		</div>		
	</div>
</div>
</section> 

<?php 
break;
case 'list_projeto':

   if(isset($_POST['atualizar'])){
		$idProjeto = $_POST['Id_Projeto'];		   
		$projeto = $_POST['Projeto'];		   
		$sql_atualiza_projeto = "UPDATE sis_projeto SET
		Projeto = '$projeto'
		WHERE Id_Projeto = '$idProjeto'";
		$con = bancoMysqli();
		$query_atualiza_projeto = mysqli_query($con,$sql_atualiza_projeto);
		if($query_atualiza_projeto){
			$mensagem = "Atualizado com sucesso!";
		}else{
			$mensagem = "Erro ao atualizar.";	
		}		   
   }
?> 

	<section id="list_items">
		<div class="container">
             <div class="col-md-offset-2 col-md-8">
                <br />
                <h2>PROJETO</h2>
                    <p><?php if(isset($mensagem)){ echo $mensagem; } ?></p>
    				<br/>
                </div>
			<div class="table-responsive list_info">
				<table class="table table-condensed">
					<thead>
						<tr class="list_menu">
							<td>Id</td>
							<td>Projeto</td>
  							<td></td>
						</tr>
					</thead>
					<tbody>
<?php
$sql = "SELECT * FROM sis_formacao_projeto" ;
$query = mysqli_query($con,$sql);
while($projeto = mysqli_fetch_array($query)){
?>

<tr>
<form action="?perfil=formacao&p=administrativo&pag=list_projeto" method="post">
<td><?php echo $projeto['Id_Projeto']; ?></td>
<td><input type="text" name="projeto" class="form-control" value="<?php echo $projeto['Projeto']; ?>"/></td>
<td>
<input type="hidden" name="atualizar" value="<?php echo $projeto['Id_Projeto']; ?>" />
<input type ='submit' class='btn btn-theme  btn-block' value='atualizar'></td>
</form>

</tr>
	
    <?php } ?>
					
					</tbody>
				</table>

			</div>

            </div>            
		</div>
	</section>
<?php /* =========== FIM PROJETO ===========*/ break; ?> 




<?php 
/* =========== INÍCIO SUBPREFEITURA ===========*/
case 'add_subprefeitura':
?>
<section id="contact" class="home-section bg-white">
	<div class="container">
		<div class="form-group">
			<div class="sub-title">
            	<h2>CADASTRO DE SUBPREFEITURA</h2>
                <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
			</div>
		</div>
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<form class="form-horizontal" role="form" action="#" method="post">
				<div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Subprefeitura: *</strong>
						<input type="text" class="form-control" id="Subprefeitura" name="Subprefeitura" placeholder="Subprefeitura"> 
					</div>
				</div>
					
				<div class="form-group">
					<div class="col-md-offset-2 col-md-8">
						<input type="submit" class="btn btn-theme btn-lg btn-block" value="Gravar">
					</div>
				</div>
			</form>
		</div>		
	</div>
</div>
</section> 

<?php 
break;
case 'list_subprefeitura':
/*
   if(isset($_POST['atualizar'])){
		$idCargo = $_POST['Id_Cargo'];		   
		$cargo = $_POST['Cargo'];		   
		$sql_atualiza_cargoo = "UPDATE sis_cargo SET
		Cargo = '$cargo'
		WHERE Id_Cargo = '$idCargo'";
		$con = bancoMysqli();
		$query_atualiza_cargo = mysqli_query($con,$sql_atualiza_cargo);
		if($query_atualiza_cargo){
			$mensagem = "Atualizado com sucesso!";
		}else{
			$mensagem = "Erro ao atualizar.";	
		}		   
   }*/
?> 

	<section id="list_items">
		<div class="container">
             <div class="col-md-offset-2 col-md-8">
                <br />
                <h2>SUBPREFEITURA</h2>
                    <p><?php if(isset($mensagem)){ echo $mensagem; } ?></p>
    				<br/>
                </div>
			<div class="table-responsive list_info">
				<table class="table table-condensed">
					<thead>
						<tr class="list_menu">
							<td>Id</td>
							<td>Subprefeitura</td>
  							<td></td>
						</tr>
					</thead>
					<tbody>
<?php
$sql = "SELECT * FROM sis_subprefeitura" ;
$query = mysqli_query($con,$sql);
while($subprefeitura = mysqli_fetch_array($query)){
?>

<tr>
<form action="?perfil=formacao&p=administrativo&pag=list_subprefeitura" method="post">
<td><?php echo $subprefeitura['Id_Subprefeitura']; ?></td>
<td><input type="text" name="Subprefeitura" class="form-control" value="<?php echo $subprefeitura['Subprefeitura']; ?>"/></td>
<td>
<input type="hidden" name="atualizar" value="<?php echo $subprefeitura['Id_Subprefeitura']; ?>" />
<input type ='submit' class='btn btn-theme  btn-block' value='atualizar'></td>
</form>

</tr>
	
    <?php } ?>
					
					</tbody>
				</table>

			</div>

            </div>            
		</div>
	</section>
<?php /* =========== FIM SUBPREFEITURA ===========*/ break; ?> 
 

<?php } //fim da switch ?>