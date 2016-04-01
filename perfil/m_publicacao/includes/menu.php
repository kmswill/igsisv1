<?php
//geram o insert pro framework da igsis
$pasta = "?perfil=publicacao&p=";
 ?>


<div class="menu-area">
  <div id="dl-menu" class="dl-menuwrapper">
	<button class="dl-trigger">Open Menu</button>
	<ul class="dl-menu">
		<li><a href="#">Pessoa Fisica</a>
			<ul class="dl-submenu">
                <li><a href="<?php echo $pasta ?>frm_lista_publicacaopf">Cadastrar</a></li>
				<li><a href="<?php echo $pasta ?>frm_lista_publicacao_vocacional_pf">Formação</a></li>
				<li><a href="<?php echo $pasta ?>frm_listaedita_publicacaopf">Listar Gerados</a></li> 
            </ul>
		</li>
		<li><a href="#">Pessoa Juridica</a>
			<ul class="dl-submenu">
                <li><a href="<?php echo $pasta ?>frm_lista_publicacaopj">Cadastrar</a></li>
				<li><a href="<?php echo $pasta ?>frm_listaedita_publicacaopj">Listar Gerados</a></li> 
            </ul>
		</li>
		<li style="color:white;">-------------------------</li>		
		<li><a href="index.php?secao=perfil">Carregar módulos</a></li>
		<li><a href="#">Ajuda</a></li>
		<li><a href="../index.php">Sair</a></li>
			</ul>
  </div>
</div>	
