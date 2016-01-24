<?php
$con = bancoMysqli();


 include 'includes/menu_administrativo.php';?>
		
	  
	 <!-- Contact -->
	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<div class="sub-title">
                    	<h2>CADASTRO DE VIGÊNCIA</h2>
                        <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
                    </div>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" action="#" method="post">
				  
				  <div class="form-group">
					<div class="col-md-offset-5	col-md-2"><strong>Ano: *</strong>
					  <input type="text" class="form-control" id="Ano" name="Ano" value="2016">
					</div>
				  </div>
				 
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Descrição da Vigência: *</strong>
					  <input type="text" class="form-control" id="DescricaoVigencia" name="DescricaoVigencia" placeholder="Descrição da Vigência"> 
					</div>
				  </div>

				<?php 
				for($i = 1; $i <= 12; $i++){
				?>
                  <div class="form-group">
					<div class="col-md-15 col-sm-1"><strong>Parcela</strong><br/>
					  <input type='text' disabled name="Valor" id='valor<?php echo $i ?>' class='form-control' value="<?php echo $i ?>" >
					</div>					
                    <div class=" col-sm-2"><strong>Valor</strong><br/>
					  <input type='text'  name="parcela<?php echo $i ?>" id='valor' class='form-control valor'>
					</div>
                    
                    <div class="col-sm-2"><strong>Data inicial:</strong><br/>
					  <input type='text' name="dataInicial<?php echo $i ?>" id='' class='form-control datepicker'>
					</div>
                    <div class="col-sm-2"><strong>Data final:</strong><br/>
					  <input type='text'  name="dataFinal<?php echo $i ?>" id='' class='form-control datepicker' >
					</div>
                    <div class="col-sm-2"><strong>Pagamento:</strong><br/>
					  <input type='text'  name="dataFinal<?php echo $i ?>" id='' class='form-control datepicker' >
					</div>
				  </div>
				<?php } ?>	
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					 <input type="submit" class="btn btn-theme btn-lg btn-block" value="Gravar">
					</div>
				  </div>
                  
				</form>
                                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <form class="form-horizontal" role="form" action="?perfil=formacao&p=frm_parcela" method="post">
                      <input type="hidden" name="idPedido"  />                     
					 <input type="submit" class="btn btn-theme btn-med btn-block" value="Cadastrar Parcelas">
                     </form><br/>
					</div>
				  </div>
	
	  			</div>
			
	  		</div>
			

	  	</div>
	  </section>  
