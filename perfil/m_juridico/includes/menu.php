<?php
//geram o insert pro framework da igsis
$pasta = "?perfil=juridico&p=";
 ?>
<!-- Menu -->
	<div class="menu-area">
	<div id="dl-menu" class="dl-menuwrapper">
	<button class="dl-trigger">Open Menu</button>
		<ul class="dl-menu">
			<li><a href="#">Pessoa Física</a>
				<ul class="dl-submenu">
                    <li><a href="<?php echo $pasta ?>frm_lista_juridico_pf">Cadastrar</a></li>
					<li><a href="<?php echo $pasta ?>frm_lista_juridico_vocacional_pf">Formação</a></li>
					<li><a href="<?php echo $pasta ?>frm_listaedita_juridico_pf">Listar Gerados</a></li> 
                </ul>
            </li>
			<li><a href="#">Pessoa Jurídica</a>
				<ul class="dl-submenu">
                    <li><a href="<?php echo $pasta ?>frm_lista_juridico_pj">Cadastrar</a></li>
					<li><a href="<?php echo $pasta ?>frm_listaedita_juridico_pj">Listar Gerados</a></li> 
                </ul>
            </li>
			<li>------------------------------</li>
			<li><a href="index.php?secao=perfil">Carregar módulos</a></li>
			<li><a href="#">Ajuda</a></li>
			<li><a href="../index.php">Sair</a></li>
		</ul>
	</div>
	</div>	
<!-- Menu -->
