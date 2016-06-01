<?php
session_start();
include("dbconnection.php");
include("header.php");
?>             
      	<div class="row space30"> <!-- row 1 begins -->
      
  <?php
  include("adminsidebar.php");
  ?>
            
          <div class="col-xs-12 col-sm-6 col-lg-8">
              	<h2>Dashboard</h2>
                <hr />
          <h3></h3><hr />
            <div class="col-md-4">
           	  
<?php
$sql = "SELECT * FROM employees where status='Enabled'";
$restraining = mysql_query($sql);
echo mysql_num_rows($restraining);
?>
                </h4>
                <hr />
            </div>
            
                        <div class="col-md-4">
           	  <h4>Companies</h4>
              	<img src="images/companies.jpg" alt="Image 1" width="204" height="100" class="img-responsive img-rounded img_left" />             
              	<h4>No. of Companies:-
                <?php
$sql = "SELECT * FROM companies where status='Enabled'";
$restraining = mysql_query($sql);
echo mysql_num_rows($restraining);
?>
              </h4>  <hr />
            </div>
            
                        <div class="col-md-4">
           	  <h4>Course</h4>
              	<img src="images/course.jpg" alt="Image 1" width="204" height="100" class="img-responsive img-rounded img_left" />             
              	<h4>No. of course:-
                  <?php
$sql = "SELECT * FROM course where status='Enabled'";
$restraining = mysql_query($sql);
echo mysql_num_rows($restraining);
?></h4>
                <hr />
            </div>
            
                        <div class="col-md-4">
           	  <h4>Jobs</h4>
           	  <img src="images/jobs-icon.jpg" alt="Image 1 "width="204" height="100" class="img-responsive img-rounded img_left" />
           	  <h4>No. Jobs published:-
                <?php
$sql = "SELECT * FROM jobs where status='Enabled'";
$restraining = mysql_query($sql);
echo mysql_num_rows($restraining);
?></h4>
                <hr />
            </div>
            
                        <div class="col-md-4">
           	  <h4>Students</h4>
           	  <img src="images/clients.png" alt="Image 1" width="204" height="100" class="img-responsive img-rounded img_left" />
           	  <h4>No. of students:-
                <?php
$sql = "SELECT * FROM students where status='Enabled'";
$restraining = mysql_query($sql);
echo mysqli_num_rows($restraining);
?>
        </h4>        <hr />
            </div>
            
                        <div class="col-md-4">
           	  <h4>Training Program</h4>
              	<img src="images/jde_training_services_img.jpg" alt="Image 1" width="204" height="100" class="img-responsive img-rounded img_left" />             
              	<h4>No. of training program:-
                  <?php
$sql = "SELECT * FROM trainingprogram where status='Enabled'";
$restraining = mysql_query($sql);
echo mysql_num_rows($restraining);
?></h4>
                <hr />
            </div>
            
                        <div class="col-md-4">
           	  <h4>Selected candidates</h4>
              	<img src="images/selectedcandidates.jpg" alt="Image 1" width="204" height="100" class="img-responsive img-rounded img_left" />             
              	<h4>No. of selected candidates:-
                  <?php
$sql = "SELECT * FROM selectedcandidate";
$restraining = mysql_query($sql);
echo mysql_num_rows($restraining);
?></h4>
                <hr />
            </div>
            
                        <div class="col-md-4">
           	  <h4>Current Jobs</h4>
              	<img src="images/banner_2.jpg" alt="Image 1" width="204" height="100" class="img-responsive img-rounded img_left" />             
              	<h4>No. Active jobs:- 
                  <?php
				  $dt= date("Y-m-d");
$sql = "SELECT * FROM jobs where status='Enabled' AND InterviewDate >= '$dt'";
$restraining = mysql_query($sql);
echo mysql_num_rows($restraining);
?></h4>
                <hr />
            </div>
            
                        <div class="col-md-4">
           	  <h4>Current training program</h4>
              	<img src="images/currenttrainingprogram.jpg" alt="Image 1" width="204" height="100" class="img-responsive img-rounded img_left" />             
              	<h4>No. of active training programs :- 
                <?php
				  $dt= date("Y-m-d");
$sql = "SELECT * FROM trainingprogram where status='Enabled' AND TPDatetime >= '$dt'";
$restraining = mysql_query($sql);
echo mysql_num_rows($restraining);
?>
                </h4>
                <hr />
            </div>
            
          </div>
          
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 
include("footer.php");
?>