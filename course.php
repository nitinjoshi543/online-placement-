<?php
session_start();
?>

<script language="javascript">
function validate()
{
	if(document.courseform.CourseName.value=="")
	{
		alert("Please enter Course Name");
		document.courseform.CourseName.focus();
		return false;
	}
	
else if(document.courseform.Coursecode.value=="")
	{
		alert("Please enter Course Code");
		document.courseform.Coursecode.focus();
		return false;
	}
	else if(document.courseform.Description.value=="")
	{
		alert("Please enter Description");
		return false;
	}
	else if(document.courseform.Status.value=="Select")
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
include("dbconnection.php");

if($_POST[setid] == $_SESSION[setid])
{

	if(isset($_POST[submit]))
	{

				if(isset($_GET[editid]))
			{
				
				$sqlupd="UPDATE course SET CourseName='$_POST[CourseName]',coursecode='$_POST[Coursecode]',Comment='$_POST[Description]',Status='$_POST[Status]' WHERE CourseId='$_GET[editid]'";
				$qresult = mysql_query($sqlupd);
				if(!$qresult)
				{
					echo "<font color='red'><h3>Failed to insert record in database...</h3></font>". mysqli_error($con);
				}
				else
				{
					$resmsg = "<font color='green'><h3>Records updated successfully...</h3></font>";
				}
			}
			else
			{
				$sqlins = "INSERT into course(CourseName,coursecode,Comment,Status)VALUES('$_POST[CourseName]','$_POST[Coursecode]','$_POST[Description]','$_POST[Status]')";
				$queryresult=mysql_query($sqlins);
				if(!$queryresult)
				{
					echo "<font color='red'><h3>Failed to insert record in database...</h3></font>";
				}
				else
				{
					$resmsg = "<font color='green'><h3>Records insert successfully...</h3></font>";
				}
			}
	}
}
$sql="SELECT * FROM course";
$resemployee=mysql_query($sql);


$sqlst = "SELECT * FROM course WHERE CourseId='$_GET[editid]'";
$sqquery = mysql_query($sqlst);
$sqrec = mysql_fetch_array($sqquery);
 $_SESSION[setid] = rand();

?>

<?php
include("header.php");
?>             
      	<div class="row space30"> <!-- row 1 begins -->
      
  <?php
  include("adminsidebar.php");
  ?>
            
          <div class="col-xs-12 col-sm-6 col-lg-8">
              	<h2>Add course</h2>
                <p><?php echo $resmsg; ?></p>
            <p>

<form name="courseform" action="" method="post" onsubmit="return validate()" >
<input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>" />
<table  class="tftable" border="1">
<tr>
  <th>Course Name</th>
  <td><input name="CourseName" type="text" size="30" value="<?php echo $sqrec[CourseName] ?>"></td>
</tr>
<tr>
<th>Course code</th>
<td><input name="Coursecode" type="text" size="30"  id="Coursecode" value="<?php echo $sqrec[coursecode] ?>"></td></tr>
<tr>
<th>Description</th>
<td><textarea name="Description" rows="10" cols="35"/><?php echo $sqrec[Comment] ?></textarea></td></tr>
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
</select></td></tr>
<tr>
<td height="39" colspan="2" align="center"><input name="submit" type="submit" value="Submit">
</td></tr></table></form>

</p>
          </div>
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 
include("footer.php");
?>
