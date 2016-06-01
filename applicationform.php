<?php
session_start();
include("dbconnection.php");
 
$filename = rand(). $_FILES["UploadResume"]["name"];
move_uploaded_file($_FILES[UploadResume][tmp_name],"uploadedfiles/".$filename);

if($_POST[setid]==$_SESSION[setid])
{
if(isset($_POST[Submit]))
{
$dt = date("Y-m-d");
$sqlins="INSERT into applicationform(RegNo,JobId,AppliedDate,Resume,Status)VALUES('$_POST[RegistrationNo]','$_POST[JobID]','$dt','$filename','$_POST[Status]')";
$queryresult=mysql_query($sqlins);
if(!$queryresult)
{
	echo "Failed to insert record in database...";
}
else
{
	echo "Records insert successfully...";
}
}
}
$_SESSION[setid]=rand();


?>
<?php
include("header.php");
?>             
      	<div class="row space30"> <!-- row 1 begins -->
      
  <?php
  include("adminsidebar.php");
  ?>
            
          <div class="col-xs-12 col-sm-6 col-lg-8">
              	<h2>Appllication form</h2>
<form action="Applicationform.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>" />
<table  class="tftable" border="1">
<tr><th>Registration No.</th>
<td><input type="text" name="RegistrationNo" size="35" />
</td></tr>
<tr>
<th>Candidate Name</th>
<td><input type="text" name="CandidateName" size="35" />
</td></tr>
<tr>
<th>Job ID</th>
<td><input type="text" name="JobID" size="35" />
</td></tr>
<tr>
<th>Job Title</th>
<td><input type="text" name="JobTitle" size="35" />
</td></tr>
<tr>
<th>Upload Resume</th>
<td><input name="UploadResume" type="file" id="UploadResume" size="35" />

</td></tr>
<tr>
<th>Status</th>
<td><select name="Status">
<option>Enabled</option>
<option>Disabled</option>
</select></td></tr>
<tr >
<td colspan="2" align="center"><input type="submit" name="Submit" value="Submit"/>
</td></tr>
</table>
</form>
</p>
          </div>
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 
?>