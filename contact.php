<?php
session_start();
include("header.php");
?>
      	<div class="row space30"> <!-- row 1 begins -->
      
            <div class="col-md-6">
			<img src="images/contactt.jpg" height="250" width="500">
           	  <h2>Jai Arihant Institute</h2>
              	<p>
              	<h3>Office Addresss</h3>
                <p><b>Jai Arihant Institute</b><br>
               Bariley road,<br>
               Halduchaur Haldwani 
			   Uttarkhand(263139)
               
               <b>Website:www.jaiarihant.ac.in</b></p>
                
                <h3>Placement Cell</h3>
                <p>top jaiarihant.ac.in<br>
				Contact No:989737844</p>
            </div>
        
            <div class="col-md-6">
              	<h2>Contact Us</h2>
              	<p>You may send us a message below.</p>
                <?php
				if(isset($_POST[submit]))
				{
					echo "<h2>Mail sent successfully...</h2>";
				}
				else
				{
					?>
                <form role="form" name="form1" action="" method="post">
                  <div class="form-group">
                    <label for="name">Name:</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Enter your name">
                  </div>
                  <div class="form-group">
                    <label for="email">Email:</label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input name="subject" type="text" class="form-control" id="subject" placeholder="Enter your subject">
                  </div>
                  <div class="form-group">
                    <label for="message">Message:</label>
                  	<textarea name="message" rows="5" class="form-control" id="message" placeholder="Enter your message"></textarea>
				  </div>
                  <div class="checkbox">
                  
                  </div>
                  <input type="submit" name="submit" class="btn btn-default" value="Submit">
                </form>
				<?php
				}
				?>
           </div>
            
     	</div> <!-- /row 1 -->
    <?php

	?>