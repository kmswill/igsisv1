<?php
if(isset($_GET['arquivo'])){
	$arquivo = $_GET['arquivo'];
}

?>

	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h3>Teste Array Siscontrat</h3>
					<?php
					geraPenalidades($arquivo);
					?>



					</div>
				  </div>
			  </div>
			  
		</div>
	</section>