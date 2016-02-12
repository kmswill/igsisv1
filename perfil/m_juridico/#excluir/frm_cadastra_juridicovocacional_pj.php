<?php 
$_SESSION['idPedido'] = $_GET['id_ped'];
$id_ped = $_GET['id_ped'];
$pedido = recuperaDados("igsis_pedido_contratacao",$_GET['id_ped'],"idPedidoContratacao");
$linha_tabelas = siscontrat($id_ped);
$fisico = siscontratDocs($linha_tabelas['IdProponente'],2);	

$ano=date('Y');

/*
$fisico = siscontratDocs($linha_tabelas['IdProponente'],1);	
$pedido = recuperaDados("igsis_pedido_contratacao",$id_ped,"idPedidoContratacao");
*/
//$consulta_tabela_dotacao_orcamentaria = mysqli_query ($conexao,"SELECT * FROM sis_dotacao_orcamentaria");
//$linha_tabela_dotacao_orcamentaria= mysqli_fetch_assoc($consulta_tabela_dotacao_orcamentaria);


$amparo="I – À vista dos elementos constantes do presente, em especial o parecer da comissão à fl. , diante da competência a mim delegada pela Portaria nº 19/2006-SMC/G, AUTORIZO, com fundamento no artigo 25, inciso III, da Lei Federal nº 8.666/93, a contratação nas condições abaixo estipuladas, observada a legislação vigente e demais cautelas legais:";

$final="II - Nos termos do art. 6º do Decreto nº 54.873/2014, designo o(a) servidor(a)  como fiscal do contrato e o(a)   como seu substituto.
III -  Autorizo a emissão da competente nota de empenho de acordo com o Decreto Municipal nº 55.839/2015 e demais normas de execução orçamentárias vigentes.
IV - Publique-se e encaminhe-se ao setor competente para as providências cabíveis." ; 


					

?>

<?php 


//$consulta_tabelas = mysqli_query($conexao,$sql_query_tabelas);


if(isset($_POST['enviar']))
{
	
$Id_PedidoContratacaoPF=$_POST['Id_PedidoContratacaoPJ'];
$NumeroProcesso=$_POST['NumeroProcesso'];
$Nome=$_POST['Nome'];
$AmparoLegal=$_POST['AmparoLegal'];
$ComplementoDotacaoOrcamentaria=$_POST['ComplementoDotacaoOrcamentaria'];
$Finalizacao=$_POST['Finalizacao'];
$DetalhesPagamento=$_POST['DetalhesPagamento'];
}
?>

<!-- MENU -->	
<?php include 'includes/menu.php';?>
	<html>	
	 <!-- Contact -->
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
				<h3><div class="sub-title">VOCACIONAL PESSOA JURÍDICA</div></h3>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

                    <form class="form-horizontal" role="form" action="?perfil=juridico&p=update_cadastra_juridicovocacional_pj&id_ped=<?php echo $_GET['id_ped']; ?>" method="post">				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Código do Pedido de Contratação:</strong><br/>
					  <input  name="Id_PedidoContratacaoPF" type="text" class="form-control" id="Id_PedidoContratacaoPJ" readonly <?php echo "value='$id_ped'";?> >
					</div>                    
                    
					<div class="col-md-6"><strong>Número do Processo:</strong>
					  <input type="text" class="form-control" id="NumeroProcesso" name="NumeroProcesso" placeholder="Número do Processo" readonly value="<?php echo $pedido['NumeroProcesso']; ?>" /> 
					</div>
                  </div> 
				  <div class="form-group"> 
					<div class="col-md-offset-2 col-md-8"><strong>Contratado:</strong><br/>
					  <input type='text' readonly class='form-control' name='nome' id='nome' value='<?php echo $fisico['Nome'];?>'>   
                    </div>
                  </div>
                  <div class="form-group"> 
					<div class="col-md-offset-2 col-md-8"><strong>Amparo:</strong><br/>
	                <textarea name="AmparoLegal" cols="40" rows="5"> <?php echo $amparo ?></textarea>
                    </div>
                  </div>  
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Complemento da Dotação Orçamentária</strong><br />
					  <input type="text" name="ComplementoDotacaoOrcamentaria" class="form-control" id="ComplementoDotacaoOrcamentaria">
					</div>
				  </div>	
                  <div class="form-group"> 
					<div class="col-md-offset-2 col-md-8"><strong>Finalização:</strong><br/>
	                <textarea name="Finalizacao" cols="40" rows="5"> <?php echo $final ?></textarea>
                    </div>
                  </div> 
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Detalhes do Pagamento:</strong><br/>
                    <textarea name="DetalhesPagamento" class="form-control" id="DetalhesPagamento"> </textarea>
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
