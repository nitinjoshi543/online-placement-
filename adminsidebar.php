<?php
session_start();

?>     
<?php
if($_SESSION[logintype] == "Administrator" )
{
?>
    		<div class="col-leftsidebar">
           	  <h2>Admin Menu</h2>
              <p><a href="dashboard.php">Home</a></p>  
              <p><a href="Employees.php?editid=<?php echo $_SESSION[empid]; ?>">Profile</a></p> 
                          
              <p><a href="course.php">Add course</a></p>
              <p><a href="viewcourse.php">View course</a></p>  
              <p><a href="companies.php">Add Companies</a></p>
              <p><a href="viewcompanies.php">View Companies</a></p>                                     
              <p><a href="trainingprogram.php">Add training program</a></p>
              <p><a href="viewtrainingprogram.php">View training program</a></p>
              <p><a href="students.php">Add student</a></p>
              <p> <a href="viewstudents.php">View Students</a></p>
              <p><a href="jobs.php">Add Jobs</a></p>
              <p><a href="viewjobs.php">View Jobs</a></p>
           <!--   <p><a href="viewapplication.php">Job applicants</a></p>
              <p><a href="viewtrainingformapplication.php">Training program applicants</a></p>       -->
              <p><a href="selectedcandidate.php">Selected candidates</a></p>
              <p><a href="viewselectedcandidate.php">View Selected candidates</a></p>              
 			  <p><a href="logout.php">Log out</a></p>
            </div>
<?php
}
else
{
?>
<div class="col-leftsidebar">
           	  <h2>Employee Menu</h2>
              <p><a href="dashboard.php">Home</a></p>  
              <p><a href="Employees.php?editid=<?php echo $_SESSION[empid]; ?>">Profile</a></p>                                 
              <p><a href="trainingprogram.php">Add training program</a></p>
              <p><a href="viewtrainingprogram.php">View training program</a></p>
              <p><a href="students.php">Add student</a></p>
              <p> <a href="viewstudents.php">View Students</a></p>
              <p><a href="jobs.php">Add Jobs</a></p>
              <p><a href="viewjobs.php">View Jobs</a></p>
              <p><a href="viewapplication.php">View applicants</a></p>
              <p><a href="selectedcandidate.php">Selected candidates</a></p>
              <p><a href="viewselectedcandidate.php">View Selected candidates</a></p>              
 			  <p><a href="logout.php">Log out</a></p>
            </div>
<?php
}
?>