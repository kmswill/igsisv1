<?php 
$_SESSION['idPedido'] = $_GET['id_ped'];
$id_ped = $_GET['id_ped'];
$pedido = recuperaDados("igsis_pedido_contratacao",$_GET['id_ped'],"idPedidoContratacao");
$linha_tabelas = siscontrat($id_ped);
$fisico = siscontratDocs($linha_tabelas['IdProponente'],2);	

$ano=date('Y');


$amparo="I – À vista dos elementos constantes do presente, em especial o parecer da comissão à fl. , diante da competência a mim delegada pela Portaria nº 19/2006-SMC/G, AUTORIZO, com fundamento no artigo 25, inciso III, da Lei Federal nº 8.666/93, a contratação nas condições abaixo estipuladas, observada a legislação vigente e demais cautelas legais:";

$final="II - Nos termos do art. 6º do Decreto nº 54.873/2014, designo o(a) servidor(a)  como fiscal do contrato e o(a)   como seu substituto.
III -  Autorizo a emissão da competente nota de empenho de acordo com o Decreto Municipal nº 55.839/2015 e demais normas de execução orçamentárias vigentes.
IV - Publique-se e encaminhe-se ao setor competente para as providências cabíveis." ; 
				

?>


<!-- MENU -->	
<?php include 'includes/menu.php';?>
	<html>	
	 <!-- Contact -->
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
				<h3><div class="sub-title">DESPACHO DE PESSOA JURÍDICA</div></h3>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

                    <form class="form-horizontal" role="form" action="?perfil=juridico&p=update_cadastra_juridicogeral_pj&id_ped=<?php echo $_GET['id_ped']; ?>" method="post">				  
					
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Código do Pedido de Contratação:</strong><br/><?php echo "$id_ped";?>					  
					</div>                                        
					<div class="col-md-6"><strong>Número do Processo:</strong><br/><?php echo $pedido['NumeroProcesso']; ?>
					</div>
                  </div> 
				  <div class="form-group"> 
					<div class="col-md-offset-2 col-md-8"><strong>Contratado:</strong><br/><?php echo $fisico['Nome'];?>
                    </div>
                  </div>
                  <div class="form-group"> 
					<div class="col-md-offset-2 col-md-8"><strong>Amparo:</strong><br/>
	                <textarea name="AmparoLegal" cols="40" rows="5"> <?php echo $amparo ?></textarea>
                    </div>
                  </div>  
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Complemento da Dotação Orçamentária</strong><br />
					  <input type="text" name="ComplementoDotacao" class="form-control" id="ComplementoDotacao">
					</div>
				  </div>	
                  <div class="form-group"> 
					<div class="col-md-offset-2 col-md-8"><strong>Finalização:</strong><br/>
	                <textarea name="Finalizacao" cols="40" rows="5"> <?php echo $final ?></textarea>
                    </div>
                  </div> 
                                    
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                   <input type="submit" name="enviar" value="GRAVAR" class="btn btn-theme btn-lg btn-block">					
				   </div>
                    
				  </div>
				</form>
	
	  			</div>
			
				
	  		</div>
			

	  	</div>
		</div>
	  </section>  


<!--footer -->
<?php include 'includes/footer.html';?>
