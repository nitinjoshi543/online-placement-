<?php
session_start();
include("dbconnection.php");
?>
<script language="javascript">
function validate()
{

	   
	if(document.stdform.Course.value=="Select")
	{
		alert("Please enter Course");
		return false;
	}
	else if(document.stdform.RegistrationNo.value=="")
	{
		alert("Please enter RegistrationNo");
		document.stdform.RegistrationNo.focus();
		return false;
	}
	else if(document.stdform.Password.value=="")
	{
		alert("Please enter Password");
		document.stdform.Password.focus();
		return false;
	}
	else if(document.stdform.Password.value != document.stdform.ConfirmPassword.value)
	{
		alert("Password and confirm password not matching");
		document.stdform.Password.value ="";
		document.stdform.ConfirmPassword.value ="";
		document.stdform.Password.focus();
		return false;
	}
	else if(document.stdform.FirstName.value=="")
	{
		alert("Please enter FirstName");
		document.stdform.FirstName.focus();
		return false;
	}
	else if(document.stdform.LastName.value=="")
	{
		alert("Please enter LastName");
		document.stdform.LastName.focus();
		return false;
	}
	else if(document.stdform.DOB.value=="")
	{
		alert("Please enter DOB");
		document.stdform.DOB.focus();
		return false;
	}
	else if(document.stdform.DOB.value=="")
	{
		alert("Please enter DOB");
		document.stdform.DOB.focus();
		return false;
	}
	else if(document.stdform.Address.value=="")
	{
		alert("Please enter Address");
		document.stdform.Address.focus();
		return false;
	}
	else if(document.stdform.City.value=="")
	{
		alert("Please enter City");
		document.stdform.City.focus();
		return false;
	}
	else if(document.stdform.State.value=="Select")
	{
		alert("Please select State");
		return false;
	
	}
	else if(document.stdform.EmailID.value=="")
	{
		alert("Please enter EmailID");
		document.stdform.EmailID.focus();
		return false;
	}
	else if(document.stdform.ContactNo.value=="")
	{
		alert("Please enter ContactNo");
		document.stdform.ContactNo.focus();
		return false;
	}
	else if((document.stdform.ContactNo.value.length < 8) || (document.stdform.ContactNo.value.length > 15))
	{
	alert(" Your Mobile Number must be 8 to 10 Integers");
	document.stdform.ContactNo.focus();
	return false;
	}
	else if(document.stdform.MobileNo.value=="")
	{
		alert("Please enter MobileNo");
		document.stdform.MobileNo.focus();
		return false;
	}
	else if(isNaN(document.stdform.MobileNo.value))
	{
	alert("Enter the valid Mobile Number(Like : 9566137117)");
	document.stdform.MobileNo.focus();
	return false;
	}
	else if((document.stdform.MobileNo.value.length < 9) || (document.stdform.MobileNo.value.length > 10))
	{
	alert(" Please enter 10 digit Mobile Number...");
	document.stdform.MobileNo.focus();
	return false;
	}
	else if(document.stdform.YearofPassing.value=="Select")
	{
		alert("Please enter YearofPassing");
		return false;
	}
	else if(document.stdform.Status.value=="Select")
	{
		alert("Please enter Status");
		return false;
	}
	else
	{
		return true;
	}
	
}
	</script>
 <?php

if($_POST[setid]==$_SESSION[setid])
{
	if($_FILES[profileimage][name] == "")
	{
		$filename = $_POST[oldprofileimage];
	}
	else
	{
		$filename = rand(). $_FILES[profileimage][name];
		move_uploaded_file($_FILES[profileimage][tmp_name], "uploadedfiles/".$filename);
	}

	if(isset($_POST[Submit]))
	{
		
		if(isset($_GET[editid]))
		{
		
		$sqlupd = "UPDATE students SET Password='$_POST[Password]',CourseId='$_POST[Course]',FirstName='$_POST[FirstName]',LastName='$_POST[LastName]',stimg='$filename',DOB='$_POST[DOB]',Address='$_POST[Address]',City='$_POST[City]',State='$_POST[State]',Country='$_POST[Country]',EmailId='$_POST[EmailID]',ContactNo='$_POST[ContactNo]',MobileNo='$_POST[MobileNo]',YOP='$_POST[YearofPassing]',Status='$_POST[Status]' WHERE RegNo='$_GET[editid]'";
		$qresult = mysql_query($sqlupd);
				if(mysql_affected_rows($con) == 1)
				{
					$qresulti =  1;
					$qresult =  "<font color='green'>Record updated successfully..</font>";
				}
				else
				{
					$qresulti =  1;
					$qresult =  "<font color='red'>No records found to update</font>";	
				}
		}
		else
		{
		$sqlins="INSERT into students(RegNo,Password,CourseId,FirstName,LastName,stimg,DOB,Address,City,State,Country,EmailId,ContactNo,MobileNo,YOJ,YOP,Status)VALUES('$_POST[RegistrationNo]','$_POST[Password]','$_POST[Course]','$_POST[FirstName]','$_POST[LastName]','$filename','$_POST[DOB]','$_POST[Address]','$_POST[City]','$_POST[State]','$_POST[Country]','$_POST[EmailID]','$_POST[ContactNo]','$_POST[MobileNo]','','$_POST[YearofPassing]','$_POST[Status]')";
		$queryresult  = mysql_query($sqlins);
		
			if(!$queryresult)
			{
				$qresult = "<font color='red'>Failed to insert record in database...</font>".mysqli_error($con);
			}
			else
			{
				$qresult = "<font color='green'>Student record inserted successfully..</font>";
			}
		}
	}
}
$sqlst = "SELECT * FROM students WHERE RegNo='$_GET[editid]'";
$sqquery = mysql_query($sqlst);
$sqrec = mysql_fetch_array($sqquery);

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
              	<h2>
               <?php
			   if(isset($_SESSION[empid]))
			   {
			   echo "Add/Edit Students";
			   }
			   else
			   {
			   echo "Edit student profile";
			   }
			   ?>
                </h2>
                <p><strong><?php echo $qresult; ?></strong></p>
            <p>
<form name="stdform" action="" method="post"  onsubmit="return validate()" enctype="multipart/form-data">
<input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>" />
<table  class="tftable" width="534" height="650" border="1">
<tr><th width="179">Course</th>
<td width="339">
<select name="Course">
<option value="Select">Select</option>

    
<?php
$sqlselcourse = "select * from course";
$sqlquerycourse = mysql_query($sqlselcourse);
while($recs = mysql_fetch_array($sqlquerycourse))
{
	if($recs[CourseId] == $sqrec[CourseId])
	{
	echo "<option value='$recs[CourseId]' selected>$recs[CourseName]</option>";
	}
	else
	{		
	echo "<option value='$recs[CourseId]'>$recs[CourseName]</option>";
	}
}
?>
</select></td></tr>
<tr><th>Registration No.</th>
<td><input type="text" name="RegistrationNo" size="30" value="<?php echo $sqrec[RegNo]; ?>"
<?php
if(isset($_GET[editid]))     
{
	echo "readonly disabled";
}
?>
>
</td></tr>
<tr><th>Password</th>
<td><input type="password" name="Password" size="30" value="<?php echo $sqrec[password]; ?>">
</td></tr>
<tr><th>Confirm Password</th>
<td><input type="password" name="ConfirmPassword" size="30" value="<?php echo $sqrec[password]; ?>">
</td></tr>
<tr><th>First Name</th>
<td><input type="text" name="FirstName" size="30" value="<?php echo $sqrec[FirstName]; ?>">
</td></tr>
<tr><th>Last Name</th>
<td><input type="text" name="LastName" size="30" value="<?php echo $sqrec[LastName]; ?>">
</td></tr>
<tr>
  <th>Image</th>
  <td><input type="file" name="profileimage" >
          <input type="hidden" name="oldprofileimage" value="<?php echo $sqrec[stimg]; ?>" />
<?php   
if(isset($_GET[editid]))     
{
	if($sqrec[stimg] == "")
	{
	echo "<img src='images/noimage.jpg' width='125' height='100'>";		
	}
	else
	{
	echo "<img src='uploadedfiles/$sqrec[stimg]' width='125' height='100'>";
	}
}
?>
  </td>
</tr>
<tr><th>DOB</th>
<td><input type="date" name="DOB" size="30" value="<?php echo $sqrec[DOB]; ?>">
</td></tr>
<tr><th>Address</th>
<td><textarea  name="Address" rows="3" cols="35"/><?php echo $sqrec[Address]; ?></textarea></td></tr>
<tr><th>City</th>
<td><input type="text" name="City" size="30" value="<?php echo $sqrec[City]; ?>">
</td></tr>
<tr><th>State</th>
<td><select name="State">
<?php
$arr = array("Select","uttarakhand","delhi");
foreach($arr as $val)
{
	if($val == $sqrec[State])
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
<tr><th>Country</th>
<td><input type="text" name="Country" size="30" value="India">
</td></tr>
<tr>
  <th>E Mail ID</th>
<td><input type="text" name="EmailID" size="30" value="<?php echo $sqrec[EmailId]; ?>">
</td></tr>
<tr><th>Contact No.</th>
<td><input type="text" name="ContactNo" size="30" value="<?php echo $sqrec[ContactNo]; ?>">
</td></tr>
<tr><th>Mobile No.</th>
<td><input type="text" name="MobileNo" size="30" value="<?php echo $sqrec[MobileNo]; ?>">
</td></tr>
<tr><th>Year of Passing</th>
<td>
<select name="YearofPassing">
<option>Select</option>
<?php
for($i=2000; $i<=2018; $i++)
{
	if($i == $sqrec[YOP])
	{
	echo "<option value='$i' selected>$i</option>";
	}
	else
	{
	echo "<option value='$i'>$i</option>";
	}
}
?>
</select>

</td></tr>
<tr><th>Status</th>
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
</select></td></tr>
<tr>
  <td colspan="2" align="center"><input type="submit" name="Submit" value="Submit">
</td></tr></table></form>
</p>
          </div>
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 

?>