<?php
session_start();
include("dbconnection.php");
include("header.php");
?>             
      	<div class="row space30"> <!-- row 1 begins -->
      
  <?php
  include("studentsidebar.php");
  ?>
            
          <div class="col-xs-12 col-sm-6 col-lg-8">
              	<h2>Home</h2>
            <p>&nbsp;</p>
          </div>
          
           <div class="col-md-4">
       	    <h4>Qualification</h4>
              	<img src="images/qualification.jpg" alt="Image 1" width="204" height="100"  class="img-responsive img-rounded img_left"  />             <br  /><br  /><br  /><br  /><br  /><br  />	
                <h4>No. of Qualification: 
                       <?php
$sql = "SELECT * FROM qualification";
$resqual = mysql_query("SELECT * FROM qualification");
echo mysql_num_rows($resqual);
?>
                </h4>  <hr />
                </div>
          
          <div class="col-md-4">
       	    <h4>Applied job details</h4>
              	<img src="images/appliedjobdetails.gif" alt="Image 1" width="204" height="100"  class="img-responsive img-rounded img_left"  />        <br  /><br  /><br  /><br  /><br  /><br  />      
                 <h4> No. of applied jobs: 
<?php
$dt= date("Y-m-d");
$sql = "SELECT * FROM applicationform where status='Enabled' AND RegNo='$_SESSION[regno]'";
$resqual = mysql_query("SELECT * FROM applicationform where status='Enabled' AND RegNo='$_SESSION[regno]'");
echo mysql_num_rows($resqual);
?>
                </h4>
                <hr />
          </div>
          
            <div class="col-md-4">
           	  <h4>applied Training Program</h4>
              	<img src="images/jde_training_services_img.jpg" alt="Image 1" width="204" height="100" class="img-responsive img-rounded img_left" /> 
                <br/>   <br/> <br/>   <br/>   <br/>   <br/>              
              	<h4>No. of applied training program:-
                  <?php
$sql = "SELECT * FROM trainingprogram where status='Enabled'";
$restraining = mysql_query("SELECT * FROM trainingprogram where status='Enabled'");
echo mysql_num_rows($restraining);
?></h4>
                <hr />
            </div>
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 
include("footer.php");
?>