<?php
session_start();
include("header.php");
include("dbconnection.php");
?>
      <div class="row space30"> <!-- row 1 begins -->

<?php
$sql = "SELECT * FROM  selectedcandidate INNER JOIN students INNER JOIN course INNER JOIN jobs INNER JOIN companies ON selectedcandidate.RegNo = students.RegNo AND course.CourseId=students.CourseId AND jobs.JobId=selectedcandidate.JobId AND companies.CompanyId=jobs.CompanyId";
$sqlquery = mysql_query("SELECT * FROM  selectedcandidate INNER JOIN students INNER JOIN course INNER JOIN jobs INNER JOIN companies ON selectedcandidate.RegNo = students.RegNo AND course.CourseId=students.CourseId AND jobs.JobId=selectedcandidate.JobId AND companies.CompanyId=jobs.CompanyId");
while($rsfetch = mysql_fetch_array($sqlquery))
{
?>      
            <div class="col-xs-6 col-sm-3">
              	<h2><?php echo ucfirst($rsfetch[FirstName]). " " . ucfirst($rsfetch[LastName]); ?></h2>
                <?php
				if($rsfetch[stimg] == "")
				{
				?>
              	<img src="images/defaultimg.jpg" alt="Image 1" class="img-responsive img-rounded img_left" border="5"  height="300" width="260" />
                <?php
				}
				else
				{
				?>
                <img src="uploadedfiles/<?php echo $rsfetch[stimg]; ?>" alt="Image 1" class="img-responsive img-rounded img_left" border="5"  height="300" width="260" />
                <?php
				}
				?>
              	<h4>Qualification: <?php echo $rsfetch[CourseName]; ?> </h4>
                 <h4>Company Name: <?php echo ucfirst($rsfetch[CompanyName]); ?> </h4>
                <h4>Job Title: <?php echo $rsfetch[JobTitle]; ?> </h4>
            </div>
        
 <?php
 }
 ?>         
      </div> <!-- /row 1 -->
      
       <!-- /row 2 -->
    <?php
	
	?>