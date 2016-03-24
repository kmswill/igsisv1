<?php
//geram o insert pro framework da igsis
$pasta = "?perfil=pagamento&p=";
 ?>


<div class="menu-area">
  <div id="dl-menu" class="dl-menuwrapper">
	<button class="dl-trigger">Open Menu</button>
	<ul class="dl-menu">
		<li><a href="#">Pessoa Física</a>
			<ul class="dl-submenu">
				<li><a href="<?php echo $pasta ?>frm_listapedidocontratacaopf_cadastrane">Nota de Empenho</a></li>
				<li><a href="<?php echo $pasta ?>frm_listapedidocontratacaopf_pagamento">Pagamento</a></li>
			</ul>
		</li>
		<li><a href="#">Pessoa Jurídica</a>
			<ul class="dl-submenu">
				<li><a href="<?php echo $pasta ?>frm_listapedidocontratacaopj_cadastrane">Nota de Empenho</a></li>
				<li><a href="<?php echo $pasta ?>frm_listapedidocontratacaopj_pagamento">Pagamento</a></li>
			</ul>
		</li>
		<li><a href="#">Concluir Processos IGSIS</a></li>
		<li style="color:white;">-------------------------</li>		
		<li><a href="index.php?secao=perfil">Carregar módulos</a></li>
		<li><a href="<?php echo $pasta ?>ajuda">Ajuda</a></li>
		<li><a href="../index.php">Sair</a></li>
			</ul>
  </div>
</div>	
