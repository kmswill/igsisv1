<?php
//geram o insert pro framework da igsis
$pasta = "?perfil=formacao&p=";
 ?>
  <!-- Menu -->
<div class="menu-area">
	<div id="dl-menu" class="dl-menuwrapper">
		<button class="dl-trigger">Open Menu</button>
			<ul class="dl-menu">
				<li><a href="<?php echo $pasta ?>administrativo">Acesso Administrativo</a></li>
                <li><a href="#">Pessoa Física</a>
                	<ul class="dl-submenu">
                    	<li><a href="<?php echo $pasta ?>frm_cadastra_pf">Cadastrar</a></li>
						<li><a href="<?php echo $pasta ?>frm_lista_pf">Listar</a></li>
                    </ul>
                </li>
				<li><a href="#">Dados para Contratação</a>
                	<ul class="dl-submenu">
                    	<li><a href="<?php echo $pasta ?>frm_cadastra_proponente">Cadastrar</a></li>
						<li><a href="<?php echo $pasta ?>frm_lista_dadoscontratacao">Listar</a></li>
                    </ul>
                </li>
                <li><a href="#">Pedido de Contratação</a>
                	<ul class="dl-submenu">
                    	<li><a href="<?php echo $pasta ?>frm_listadadoscontratacao_cadastrapedido">Cadastrar</a></li>
						<li><a href="<?php echo $pasta ?>frm_lista_pedidocontratacao_pf">Enviados</a></li>
                    </ul>
                </li>
            	<li><a href="index.php?secao=perfil">Carregar módulos</a></li>
				<li><a href="<?php echo $pasta ?>ajuda">Ajuda</a></li>
				<li><a href="../index.php">Sair</a></li>
			</ul>
	</div>
</div>	
<!-- Menu -->
