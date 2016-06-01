<?php
session_start();
?>

<script language="javascript">
function validate()
{
	if(document.cmpform.CompanyName.value=="")
	{
		alert("Please enter Company Name");
		document.cmpform.CompanyName.focus();
		return false;
	}
	else if(document.cmpform.AboutCompany.value=="")
	{
		alert("Please enter About company");
		return false;
	}
	else if(document.cmpform.Address.value=="")
	{
		alert("Please enter address");
		return false;
	}
	
	else if(document.cmpform.E_mailID.value=="")
	{
		alert("Please enter E_mail ID");
		document.cmpform.E_mailID.focus();
		return false;
	}
	else if(document.cmpform.ContactNo.value=="")
	{
		alert("Please enter Contact No");
		document.cmpform.ContactNo.focus();
		return false;
	}
	else if(document.cmpform.Website.value=="")
	{
		alert("Please enter Website");
		document.cmpform.Website.focus();
		return false;
	}
	else if(document.cmpform.Status.value== "Select")
	{
		alert("Please select status");
		return false;
	}
	else
	{
		phonenumber(document.cmpform.ContactNo.value);
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
			if($_FILES[CompanyLogo][name] == "")
			{
				$filename = $_POST[oldimage];
			}
			else
			{
				$filename = rand(). $_FILES[CompanyLogo][name];
				move_uploaded_file($_FILES[CompanyLogo][tmp_name], "uploadedfiles/".$filename);
			}
	
	$companyname = str_replace("'","\'",$_POST[CompanyName]);
	$AboutCompany = str_replace("'","\'",$_POST[AboutCompany]);
	$Address = str_replace("'","\'",$_POST[Address]);
	
	if(isset($_GET[editid]))
	{
	$sqlupd = "UPDATE companies SET CompanyInfo='$AboutCompany',CompanyName='$companyname',Address='$Address',EmailId='$_POST[E_mailID]',ContactNo='$_POST[ContactNo]',CompanyLogo='$filename',Website='$_POST[Website]',Status='$_POST[Status]' WHERE CompanyId='$_GET[editid]'";
	$qresult = mysql_query($sqlupd);
				if(mysql_affected_rows($con) == 1)
				{
					$qresulti =  1;
					$qresult =  "<font color='green'><h3>Record updated successfully...</h3></font>";
				}
				else
				{
					$qresulti =  1;
					$qresult =  "<font color='red'><h3>No records found to update...</h3></font>";	
				}
	}
	else
	{
		$sqlins = "INSERT into companies(CompanyInfo,CompanyName,Address,EmailId,ContactNo,CompanyLogo,Website,Status)VALUES
		('$AboutCompany','$companyname','$Address','$_POST[E_mailID]','$_POST[ContactNo]','$filename','$_POST[Website]','$_POST[Status]')";
		$queryresult  = mysql_query($sqlins);
		
				if(!$queryresult)
			{
				$qresult = "<font color='red'><h3>Failed to insert record in database...</h3></font>";
			}
			else
			{
				$qresult = "<font color='green'><h3>Company record inserted successfully...</h3></font>";
			}
	}
}
}

if(isset($_GET[editid]))
{
//sqlst = "SELECT * FROM companies WHERE CompanyId='$_GET[editid]'";
$sqquery = mysql_query("SELECT * FROM companies WHERE CompanyId='$_GET[editid]'");
$sqrec = mysql_fetch_array($sqquery);
}

$_SESSION[setid]= rand();
 ?>
 
<?php
include("header.php");
?>             
      	<div class="row space30"> <!-- row 1 begins -->
      
  <?php
  include("adminsidebar.php");
  ?>
            
          <div class="col-xs-12 col-sm-6 col-lg-8">
              	<h2>Companies</h2>
                   <p><strong><?php echo $qresult; ?></strong></p>
            <p>

<form name="cmpform" action="" method="post" onsubmit="return validate()" enctype="multipart/form-data">
<input type="hidden" name="setid" value="<?php echo $_SESSION[setid];?>"/>
<table  class="tftable" width="534" border="1">
<tr>
<th height="41">Company Name</th>
<td><input type="text" name="CompanyName"  size="35" value="<?php echo $sqrec[CompanyName]; ?>"></td>
</tr>
<tr>
<th>About Company</th>
<td><textarea name="AboutCompany" rows="5" cols="35"/><?php echo $sqrec[CompanyInfo];?></textarea>
</td>
</tr>
<tr>
<th>Address</th>
<td><textarea name="Address" rows="5" cols="35"/><?php echo $sqrec[Address];?></textarea>
</td>
</tr>
<tr>
<th height="39">Email ID</th>
<td colspan="2"><input type="text" name="E_mailID" size="30" value="<?php echo $sqrec[EmailId]; ?>"></td>
</tr>
<tr>
<th height="41">Contact No</th>
<td><input type="text" name="ContactNo" size="30" value="<?php echo $sqrec[ContactNo]; ?>" ></td>
</tr>
<tr>
<th height="39">Company Logo</th>
<td><input name="CompanyLogo" type="file" size="30" value="<?php echo $sqrec[CompanyLogo]; ?>">
         <input type="hidden" name="oldimage" value="<?php echo $sqrec[CompanyLogo]; ?>" />
<?php   
if(isset($_GET[editid]))     
{
	if($sqrec[CompanyLogo] == "")
	{
	echo "<img src='images/noimage.jpg' width='125' height='100'>";		
	}
	else
	{
	echo "<img src='uploadedfiles/$sqrec[CompanyLogo]' width='125' height='100'>";
	}
}
?>
 </td>
</td>
</tr>
<tr>
<th height="35">Website</th>
<td><input name="Website" type="url" size="30" value="<?php echo $sqrec[Website]; ?>"></td>
</tr>
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
</select></td>
</tr>
<tr><td colspan="2" align="center">
<input type="Submit" name="Submit" value="Submit" />
</td>
</tr>
</table>
</form>
</p>
          </div>
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 

?>