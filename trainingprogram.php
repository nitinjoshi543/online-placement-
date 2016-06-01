<?php
session_start();
?>
<script language="javascript">
function validate()
{
	if(document.trainingform.CompanyName.value=="Select")
	{
		alert("Please enter company Name");
		return false;
	}
	
	else if(document.trainingform.trainingtype.value=="")
	{
		alert("Please enter training type ");
		document.trainingform.trainingtype.focus();
		return false;
	}
	else if(document.trainingform.Title.value=="")
	{
		alert("Please enter Title ");
		document.trainingform.Title.focus();
		return false;
	}
	else if(document.trainingform.Trainee.value=="")
	{
		alert("Please enter Trainee");
		document.trainingform.Trainee.focus();
		return false;
	}
	else if(document.trainingform.AboutTrainingProgram.value=="")
	{
		alert("Please enter AboutTrainingProgram ");
		document.trainingform.AboutTrainingProgram.focus();
		return false;
	}
	else if(document.trainingform.Date.value=="")
	{
		alert("Please enter Date ");
		document.trainingform.Date.focus();
		return false;
	}
	else if(document.trainingform.Time.value=="")
	{
		alert("Please enter Time ");
		document.trainingform.Time.focus();
		return false;
	}
	else if(document.trainingform.Venue.value=="")
	{
		alert("Please enter Venue ");
		document.trainingform.Venue.focus();
		return false;
	}
	else if(document.trainingform.Status.value=="Select")
	{
		alert("Please select status ");
		document.trainingform.Status.focus();
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
	$chkvalues = "Null";
	$chkval = $_POST[departments];
	for($i=0; $i < count($chkval); $i++)
	{
		$chkvalues = $chkvalues. ",".$chkval[$i];
	}

	
			$dt=$_POST[Date] . " ". $_POST[Time];
			if(isset($_GET[editid]))
			{
$sqlupd = "UPDATE trainingprogram SET CompanyId='$_POST[CompanyName]',TrainingType='$_POST[TrainingType]',Title='$_POST[Title]',TPInfo='$_POST[AboutTrainingProgram]',TPDatetime='$dt',Venue='$_POST[Venue]',TPDepartments='$chkvalues',Trainee='$_POST[Trainee]',Status='$_POST[Status]' WHERE TrainingId='$_GET[editid]'";
			
//	$sqlupd = "UPDATE trainingprogram SET TPDepartments='$chkvalues' WHERE TrainingId='$_GET[editid]";
				$qresult = mysql_query($sqlupd);
				echo mysql_error($con);
				if(!$qresult)
				{
					$qresulti =  1;
					$qresult =  "<font color='red'><h3><strong>No records found to update...</strong></h3></font>". mysqli_error($con);	
				}
				else
				{
					$qresulti =  1;
					$qresult =  "<font color='green'><h3><strong>Records updated successfully...</strong></h3></font>";
				}
			}
			else
			{	
			$sqlins = "INSERT into trainingprogram(CompanyId,TrainingType,Title,TPInfo,TPDatetime,Venue,TPDepartments,Trainee,Status)VALUES('$_POST[CompanyName]','$_POST[TrainingType]','$_POST[Title]','$_POST[AboutTrainingProgram]','$dt','$_POST[Venue]','$chkvalues','$_POST[Trainee]','$_POST[Status]')";
				$queryresult=mysql_query("INSERT into trainingprogram(CompanyId,TrainingType,Title,TPInfo,TPDatetime,Venue,TPDepartments,Trainee,Status)VALUES('$_POST[CompanyName]','$_POST[TrainingType]','$_POST[Title]','$_POST[AboutTrainingProgram]','$dt','$_POST[Venue]','$chkvalues','$_POST[Trainee]','$_POST[Status]')");
					if(!$queryresult)
					{
						$isi = 1;
						$is = "<font color='red'><h3><strong>Failed to insert record in database...</strong></h3></font>";
					}
					else
					{
						$isi = 1;
						$is =  "<font color='green'><h3><strong>Records inserted successfully...</strong></h3></font>";
					}
			}
}
}
$_SESSION[setid]=rand();

include("dbconnection.php");
?>

<script>
    function ConfirmDelete()
	{
		var result = confirm("Are you sure want to delete this record?");
		if (result==true) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}
</script>

<?php


$sql="SELECT * FROM trainingprogram";
$restraining=mysql_query($sql);

$sqlst = "SELECT * FROM trainingprogram WHERE TrainingId='$_GET[editid]'";
$sqquery = mysql_query($sqlst);
$sqrec = mysql_fetch_array($sqquery);
$tpdepartments = explode(",",$sqrec[TPDepartments]);
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
              	<h2>Add new training program</h2>
                <p><?php echo $qresult ; ?></p>
            <p>
<form name="trainingform" action="" method="post"  onsubmit="return validate()">
<input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>" />
<table  class="tftable" width="599" border="1">
<?php
if($isi == 1)
{
echo "<tr><th height='33' colspan='2'>&nbsp;$is</th></tr>"; 
}
?>
<tr><th width="207" height="33">CompanyName</th>
<td width="376">
<select name="CompanyName">
<option value="Select">Select</option>
<?php
$sqlselcourse = "select * from companies";
$sqlquerycourse = mysql_query($sqlselcourse);
while($recs = mysql_fetch_array($sqlquerycourse))
{
	if($sqrec[CompanyId] == $recs[CompanyId] )
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
<tr><th height="39">Training Type</th>
<td><input type="text" name="TrainingType" size="40" value="<?php echo $sqrec[TrainingType];?>" ></td></tr>
<tr><th height="37">Title</th>
<td><input type="text" name="Title" size="40" value="<?php echo $sqrec[Title]; ?>">
</td></tr>
<tr>
  <th height="35">Trainee</th>
  <td><input type="text" name="Trainee" size="40" value="<?php echo $sqrec[Trainee]; ?>"></td>
</tr>
<tr><th height="82">About Training Program</th>
<td><textarea name="AboutTrainingProgram" rows="5" cols="35"><?php echo $sqrec[TPInfo];?></textarea></td></tr>
<tr><th height="34">Date</th>
<?php
$date = date('Y-m-d', strtotime($sqrec[TPDatetime]));
$time = date('H:i:s', strtotime($sqrec[TPDatetime]));
?>
<td><input type="date" name="Date" size="30" value="<?php echo $date; ?>">
</td></tr>
<tr><th height="39">Time</th>
<td><input type="time" name="Time" size="30" value="<?php echo $time; ?>">
</td></tr>
<tr><th height="35">Venue</th>
<td><textarea name="Venue" cols="30"><?php echo $sqrec[Venue]; ?></textarea>
</td></tr>
<tr><th>Departments</th>
  <td>
<input type="checkbox" name="departments[]" value="All" > All Departments <br>
<?php
$sqlselcourse = "select * from course where status='Enabled'";
$sqlquerycourse = mysql_query($sqlselcourse);
while($recs = mysql_fetch_array($sqlquerycourse))
{

			echo "<input type='checkbox' name='departments[]' value='$recs[CourseName]' ";
				for($i=0; $i<count($tpdepartments); $i++)
				{
					
					if($recs[coursename] == "BCA")
					{
					echo " checked ";	
					goto a;
					}	
				}
				a:
			echo "> $recs[CourseName] <br>";
			
}

?>
</td></tr>
<tr><th height="32">Status</th>
  <td>
  <select name="Status">
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
</select></td></tr>
<tr>
<td colspan="2" align="center"><input name="Submit" type="submit" value="Submit">
</td></tr></table>
</form>
</p>
          </div>
		  
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 
include("footer.php");
?>