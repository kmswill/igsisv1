<?php
//geram o insert pro framework da igsis
$pasta = "?perfil=juridico&p=";
 ?>
  <!-- Menu -->
	<div class="menu-area">
			<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li><a href="<?php echo $pasta ?>frm_lista_juridico_pf">Pessoa Física</a>
								<!--
								<ul class="dl-submenu">
                                <li>
									<a href="#">Cadastrar</a>
									<ul class="dl-submenu">
										<li><a href="<?php echo $pasta ?>frm_lista_cadastrajuridicogeral_pf">Geral</a></li>
                                        <li><a href="<?php echo $pasta ?>frm_lista_cadastrajuridicovocacional_pf">Vocacional</a></li>
									</ul>
								</li>
								<li><a href="<?php echo $pasta ?>frm_lista_juridicopf">Listar</a></li> 
                                </ul>-->
                            </li>
							<li><a href="<?php echo $pasta ?>frm_lista_juridico_pj">Pessoa Jurídica</a>
                            	<!--
								<ul class="dl-submenu">
                                <li>
									<a href="#">Cadastrar</a>
									<ul class="dl-submenu">
										<li><a href="<?php echo $pasta ?>frm_lista_cadastrajuridicogeral_pj">Geral</a></li>
                                        <li><a href="<?php echo $pasta ?>frm_lista_cadastrajuridicovocacional_pj">Vocacional</a></li>
									</ul>
								</li>
								
								<li><a href="<?php echo $pasta ?>frm_lista_juridicopj">Listar</a></li> 
                                </ul> -->
                            </li>
							<li>------------------------------</li>
							<li><a href="index.php?secao=perfil">Carregar módulos</a></li>
							<li><a href="#">Ajuda</a></li>
							<li><a href="../index.php">Sair</a></li>
						</ul>
			</div>
	</div>	
<!-- Menu -->
