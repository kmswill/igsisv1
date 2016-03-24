<?php
// não precisa chamar a funcao porque o index contrato já chama.
$linha_tabela_lista = siscontratLista(1,"",2000,1,"DESC",10); //esse gera uma array com os pedidos

$link="index.php?perfil=pagamento&p=frm_cadastra_pagamento_pf&id_ped=";

//$link="frm_edita_pedidocontratacaopj.php";
//$link="frm_cadastra_notaempenhopf.php";

?>
	
<?php include 'includes/menu.php';?>
		
	  	  
	 <!-- inicio_list -->
	<section id="list_items">
		<div class="container">
			 <div class="sub-title">PEDIDO DE CONTRATAÇÃO DE PESSOA FÍSICA</div>
			<div class="table-responsive list_info">
				<table class="table table-condensed"><script type=text/javascript language=JavaScript src=../js/find2.js> </script>
					<thead>
						<tr class="list_menu">
							<td>Processo</td>
							<td>Codigo do Pedido</td>
							<td>Proponente</td>
							<td>Objeto</td>
							<td>Local</td>
							<td>Periodo</td>                            
						</tr>
					</thead>
					<tbody>
<?php
$data=date('Y');
for($i = 0; $i < count($linha_tabela_lista); $i++)
 {
	 
	$linha_tabela_pedido_contratacaopf = recuperaDados("sis_pessoa_fisica",$linha_tabela_lista[$i]['IdProponente'],"Id_PessoaFisica");
	$chamado = recuperaAlteracoesEvento($linha_tabela_lista[$i]['idEvento']);	 
	echo "<tr><td class='lista'> <a href='".$link.$linha_tabela_lista[$i]['idPedido']."'>".$linha_tabela_lista[$i]['NumeroProcesso']."</a></td>";
	echo '<td class="list_description">'.$linha_tabela_lista[$i]['idPedido'].'</td>';
	echo '<td class="list_description">'.$linha_tabela_pedido_contratacaopf['Nome'].'</td> ';
	echo '<td class="list_description">'.$linha_tabela_lista[$i]['Objeto'].' [';
					if($chamado['numero'] == '0'){
						echo "0";
					}else{
						echo "<a href='?perfil=chamado&p=evento&id=".$linha_tabela_lista[$i]['idEvento']."' target='_blank'>".$chamado['numero']."</a>";	
					}
					
	echo '] </td> ';
	echo '<td class="list_description">'.$linha_tabela_lista[$i]['Local'].'</td> ';
	echo '<td class="list_description">'.$linha_tabela_lista[$i]['Periodo'].'</td> </tr>';
	}

?>
	
					
					</tbody>
				</table>
			</div>
		</div>
	</section>

<!--fim_list-->