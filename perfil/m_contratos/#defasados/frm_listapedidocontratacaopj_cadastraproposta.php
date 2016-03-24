<?php

// não precisa chamar a funcao porque o index contrato já chama.
$linha_tabela_lista = siscontratLista(2,$_SESSION['idInstituicao'],1000,1,"DESC","Análise do Pedido"); //esse gera uma array com os pedidos

$link="index.php?perfil=contratos&p=frm_cadastra_propostapj&id_ped=";

?>
	
<?php include 'includes/menu.php';?>	

	 <!-- inicio_list -->
	<section id="list_items">
		<div class="container">
			 <div class="sub-title">PEDIDO DE CONTRATAÇÃO DE PESSOA FÍSICA</div>
			<div class="table-responsive list_info">
				<table class="table table-condensed">
					<thead>
						<tr class="list_menu">
							<td>Codigo do Pedido</td>
							<td>Proponente</td>
							<td>Objeto</td>
							<td>Local</td>
   							<td>Instituição</td>
							<td> Periodo</td>
							<td>Status</td>
						</tr>
					</thead>
					<tbody>
<?php
$data=date('Y');
for($i = 0; $i < count($linha_tabela_lista); $i++)
 {
	$linha_tabela_pedido_contratacaopf = recuperaDados("sis_pessoa_juridica",$linha_tabela_lista[$i]['IdProponente'],"Id_PessoaJuridica");	 
	echo "<tr><td class='lista'> <a href='".$link.$linha_tabela_lista[$i]['idPedido']."'>".$linha_tabela_lista[$i]['idPedido']."</a></td>";
	echo '<td class="list_description">'.$linha_tabela_pedido_contratacaopf['RazaoSocial'].					'</td> ';
	echo '<td class="list_description">'.$linha_tabela_lista[$i]['Objeto'].						'</td> ';
	echo '<td class="list_description">'.$linha_tabela_lista[$i]['Local'].				'</td> ';
	echo '<td class="list_description">'.$linha_tabela_lista[$i]['Sigla'].				'</td> ';

	echo '<td class="list_description">'.$linha_tabela_lista[$i]['Periodo'].						'</td> ';
	echo '<td class="list_description">'.$linha_tabela_lista[$i]['Status'].						'</td> </tr>';
	}

?>
	
					
					</tbody>
				</table>
			</div>
		</div>
	</section>
<!--fim_list-->


