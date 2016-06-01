<?php
session_start();
if(!isset($_SESSION[regno]))
{
	header("Location: login.php");
}
?>
    		<div class="col-leftsidebar">
           	  <h2>Menu</h2>
              <p><a href="studentpanel.php">Home</a></p>
              <p><a href="studentprofile.php">Profile</a></p>
              <p><a href="Changepassword.php">Change password</a></p>
              <p><a href="qualification.php">Add Qualification</a></p>
              <p><a href="Viewqualification.php">View Qualification</a></p>
              <p><a href="appliedjobdetails.php">Applied job details</a></p>
              <p><a href="trainingprogramapplication.php">Applied Training programs</a></p>
 			  <p><a href="logout.php">Log out</a></p>
            </div>