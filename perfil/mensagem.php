
    
    <link rel="stylesheet" href="css/style_chat.css" type="text/css" />
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
 
    <script type="text/javascript">
    
        // ask user for name with popup prompt    
        var name = "<?php echo $_SESSION['nomeCompleto']; ?>";
        
        // default name is 'Guest'
    	if (!name || name === ' ') {
    	   name = "Guest";	
    	}
    	
    	// strip tags
    	name = name.replace(/(<([^>]+)>)/ig,"");
    	
    	// display name on page
    	$("#name-area").html("Você é: <span>" + name + "</span>");
    	
    	// kick off chat
        var chat =  new Chat();
    	$(function() {
    	
    		 chat.getState(); 
    		 
    		 // watch textarea for key presses
             $("#sendie").keydown(function(event) {  
             
                 var key = event.which;  
           
                 //all keys including return.  
                 if (key >= 33) {
                   
                     var maxLength = $(this).attr("maxlength");  
                     var length = this.value.length;  
                     
                     // don't allow new content if length is maxed out
                     if (length >= maxLength) {  
                         event.preventDefault();  
                     }  
                  }  
    		 																																																});
    		 // watch textarea for release of key press
    		 $('#sendie').keyup(function(e) {	
    		 					 
    			  if (e.keyCode == 13) { 
    			  
                    var text = $(this).val();
    				var maxLength = $(this).attr("maxlength");  
                    var length = text.length; 
                     
                    // send 
                    if (length <= maxLength + 1) { 
                     
    			        chat.send(text, name);	
    			        $(this).val("");
    			        
                    } else {
                    
    					$(this).val(text.substring(0, maxLength));
    					
    				}	
    				
    				
    			  }
             });
            
    	});
    </script>



<body onLoad="setInterval('chat.update()', 1000)">

	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h3>Ajuda</h3>
	
    <div id="page-wrap">
    
        
        <p id="name-area"></p>
        
        <div class='left' id="chat-wrap"><div class="form-control" id="chat-area"></div></div>
        
        <form id="send-message-area">
            <label>Sua mensagem: </label>
            <textarea class="form-control" id="sendie" maxlength = '100' ></textarea>
        </form>
    
    </div>


					</div>
				  </div>
			  </div>
			  
		</div>
	</section>




