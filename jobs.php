<?php
session_start();
?>
<script language="javascript">
function validate()
{
		/*
			var dateOne = new Date(document.form1.dtst.value); //Year, Month, Date
       var dateTwo = new Date(document.form1.dob.value); //Year, Month, Date
	   */
	if(document.jobform.CompanyName.value=="Select")
	{
		alert("Please enter CompanyName");
		return false;
	}
	else if(document.jobform.JobTitle.value=="")
	{
		alert("Please enter JobTitle");
		document.jobform.JobTitle.focus();
		return false;
	}
	else if(document.jobform.JobLocation.value=="")
	{
		alert("Please enter JobLocation");
		document.jobform.JobLocation.focus();
		return false;
	}
	else if(document.jobform.JobResponsibility.value=="")
	{
		alert("Please enter JobResponsibility");
		document.jobform.JobResponsibility.focus();
		return false;
	}
	else if(document.jobform.SelectionProcess.value=="")
	{
		alert("Please enter SelectionProcess");
		return false;
	}
	else if(document.jobform.Compensation.value=="")
	{
		alert("Please enter Compensation");
		return false;
	}
	else if(document.jobform.InterviewDate.value=="")
	{
		alert("Please enter InterviewDate");
		document.jobform.InterviewDate.focus();
		return false;
	}
	else if(document.jobform.RegistrationDate.value=="")
	{
		alert("Please enter RegistrationDate");
		document.jobform.RegistrationDate.focus();
		return false;
	}
	else if(document.jobform.Venue.value=="")
	{
		alert("Please enter Venue");
		document.jobform.Venue.focus();
		return false;
	}
	else if(document.jobform.DocumentsRequired.value=="")
	{
		alert("Please enter DocumentsRequired");
		return false;
	}
	else if(document.jobform.Status.value=="Select")
	{
		alert("Please enter Status");
		document.jobform.Status.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>
<?php
include("dbconnection.php");
if($_POST[setid]==$_SESSION[setid])
{
if(isset($_POST[Submit]))
{

$JobTitle = str_replace("'","\'",$_POST[JobTitle]);
$JobResponsibility = str_replace("'","\'",$_POST[JobResponsibility]);
$SelectionProcess = str_replace("'","\'",$_POST[SelectionProcess]);
$Compensation = str_replace("'","\'",$_POST[Compensation]);
$Venue = str_replace("'","\'",$_POST[Venue]);
$DocumentsRequired = str_replace("'","\'",$_POST[DocumentsRequired]);	
		$chkvalues = "Null";
	$chkval = $_POST[Eligibility];
	for($i=0; $i < count($chkval); $i++)
	{
		$chkvalues = $chkvalues. ",".$chkval[$i];
	}
	if(isset($_GET[editid]))
	{
		$sqlupd="UPDATE jobs SET CompanyId='$_POST[CompanyName]',JobTitle='$JobTitle',JobLocation='$_POST[JobLocation]',JobResponsibility='$JobResponsibility',Eligibility='$chkvalues',SelectionProcess='$SelectionProcess',Compensation='$Compensation',InterviewDate='$_POST[InterviewDate]',RegistrationTime='$_POST[RegistrationDate]',Venue='$Venue',DocReq='$DocumentsRequired',Status='$_POST[Status]' WHERE JobId='$_GET[editid]'";
	$qresult = mysql_query($sqlupd);
				if(mysql_affected_rows($con) == 1)
				{
					$qresulti =  1;
					$qresult =  "<font color='green'><h3><strong>Record updated successfully...</strong></h3></font>";
				}
				else
				{
					$qresulti =  1;
					$qresult =  "<font color='red'><strong><h3>No records found to update...</h3></strong></font>";	
				}
	}
	else
	{		
	$sqlins="INSERT into jobs(CompanyId,JobTitle,JobLocation,JobResponsibility,Eligibility,SelectionProcess,Compensation,InterviewDate,RegistrationTime,Venue,DocReq,Status)VALUES('$_POST[CompanyName]','$JobTitle','$_POST[JobLocation]','$JobResponsibility','$chkvalues','$SelectionProcess','$Compensation','$_POST[InterviewDate]','$_POST[RegistrationDate]','$Venue','$DocumentsRequired','$_POST[Status]')";
$queryresult  = mysql_query($sqlins);

			if(!$queryresult)
			{
				$qresult = "<font color='red'><strong><h3>Failed to insert record in database...<h3></strong></font>";
			}
			else
			{
				$qresult = "<font color='green'><strong><h3>Record inserted successfully...</h3></strong></font>";
			}
}
}
}
if(isset($_GET[editid]))
{
	$sqlst = "SELECT * FROM jobs WHERE JobId='$_GET[editid]'";
	$sqquery = mysql_query($sqlst);
	$sqrec = mysql_fetch_array($sqquery);
}
$_SESSION[setid]=rand();

 ?>
<p><strong><?php echo $msg; ?></strong></p>
<?php
include("header.php");
?>             
      	<div class="row space30"> <!-- row 1 begins -->
      
  <?php
  include("adminsidebar.php");
  ?>
            
          <div class="col-xs-12 col-sm-6 col-lg-8">
              	<h2>ADD/EDIT JOBS</h2>
                 <p><strong><?php echo $qresult; ?></strong></p>
            <p>

<form name="jobform" action="" method="post"  onsubmit="return validate()">
<input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>" />
<table  class="tftable" width="775" border="1">
<tr>
<th width="211" height="34">CompanyName</th>
<td width="548">
<select name="CompanyName">
<option value="Select">Select</option>
<?php
$sqlselcourse = "select * from companies";
$sqlquerycourse = mysql_query($sqlselcourse);
while($recs = mysql_fetch_array($sqlquerycourse))
{
	if($recs[CompanyId] == $sqrec[CompanyId])
	{
	echo "<option value='$recs[CompanyId]' selected>$recs[CompanyName]</option>";
	}
	else
	{
	echo "<option value='$recs[CompanyId]'>$recs[CompanyName]</option>";
	}
}
?>
</select>
</td></tr>
<tr> 
<th height="36">JobTitle</th>
<td>
<input type="text" name="JobTitle" size="30" value="<?php echo $sqrec[JobTitle]; ?>">
</td></tr>
<tr>
<th height="39">JobLocation</th>
<td><input type="text" name="JobLocation" size="30" value="<?php echo $sqrec[JobLocation]; ?>"> 
</td></tr>
<tr>
<th height="70" valign="top">JobResponsibility</th>
<td><textarea name="JobResponsibility" rows="3" cols="50"/><?php echo $sqrec[JobResponsibility];?>
</textarea>
</td></tr>
<tr>
<th height="70" valign="top">Eligibility</th>
<td>
<?php
$sqlselcourse = "select * from course";
$sqlquerycourse = mysql_query($sqlselcourse);
?>
<div style="overflow: auto; width: 300px; height: 80px; border: 1px solid #336699; padding-left: 5px">
<input type="checkbox" name="Eligibility[]" value="All"> All  <br>
<?php
while($recs = mysql_fetch_array($sqlquerycourse))
{
echo "<input type='checkbox' name='Eligibility[]' value='$recs[CourseName]'> $recs[CourseName] <br>";
}
?>
</div>
</td></tr>
<tr>
<th height="63" valign="top">SelectionProcess</th>
<td><textarea name="SelectionProcess" rows="3" cols="50"/><?php echo $sqrec[SelectionProcess];?>
</textarea></td></tr>
<tr>
<th height="66" valign="top">Compensation</th>
<td><textarea name="Compensation" rows="3" cols="50"/><?php echo $sqrec[Compensation];?>
</textarea></td></tr>
<tr>
<th height="38">InterviewDate</th>
<td><input type="date" name="InterviewDate" size="30" value="<?php echo $sqrec[InterviewDate]; ?>" min="<?php echo date("Y-m-d"); ?>">
</td></tr>
<tr>
<th height="30">RegistrationDate</th>
<td><input type="date" name="RegistrationDate" size="30" value="<?php echo $sqrec[InterviewDate]; ?>" min="<?php echo date("Y-m-d"); ?>">
</td></tr>
<tr>
<th height="34">Venue</th>
<td><textarea name="Venue"  rows="3" cols="50"><?php echo $sqrec[Venue]; ?></textarea>
</td></tr>
<tr>
<th valign="top">DocumentsRequired</th>
<td><textarea name="DocumentsRequired" rows="3" cols="50"><?php echo $sqrec[DocReq];?>
</textarea></td></tr>
<tr>
<th>Status</th>
<td><select name="Status">
<?php
$arr = array("Select","Enabled","Disabled");
foreach($arr as $val)
{
	if($val == $sqrec[Status])
	{
	echo "<option value='$val' selected>$val</option>";
	}
	else
	{
	echo "<option value='$val'>$val</option>";
	}
}
?>
</select>
</td></tr>
<tr><td colspan="2" align="center"><input type="Submit" name="Submit" value="Submit"/>
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


