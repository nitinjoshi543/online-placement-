<?php
session_start();
?>
<script language="javascript">
function validate()
{
	if(document.quform.RegNo.value=="")
	{
		alert("Please enter register number");
		document.quform.RegNo.focus();
		return false;
	}
	else if(document.quform.Qualification.value=="")
	{
		alert("Please enter Qualification");
		document.quform.Qualification.focus();
		return false;
	}
	else if(document.quform.YOP.value=="")
	{
		alert("Please enter Year of passing");
		document.quform.YOP.focus();
		return false;
	}
	else if(document.quform.BoardOfExamination.value=="")
	{
		alert("Please enter BoardOfExamination");
		document.quform.BoardOfExamination.focus();
		return false;
	}
	else if(document.quform.AvgMarks.value=="")
	{
		alert("Please enter Average Marks");
		document.quform.AvgMarks.focus();
		return false;
	}
	else if(document.quform.Status.value=="Select")
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
	if(isset($_POST[Submit]))
	{
		if(isset($_GET[editid]))
		{
		$sqlupd = "UPDATE qualification SET RegNo='$_POST[RegNo]',Qualification='$_POST[Qualification]',YOP='$_POST[YOP]',BoardOfExamination='$_POST[BoardOfExamination]',AvgMarks='$_POST[AvgMarks]'  WHERE QualId='$_GET[editid]'";
		if(!mysql_query($sqlupd))
					{
					$qrst="<font color='red'><h3>Failed to update record in database...</h3></font>".mysqli_error($con);
					}
					else
					{
						$qrst="<font color='green'><h3><strong>Qualification record Updated successfully...</strong></h3></font>";
					}
		}
		else		
		{			//exit("INSERT into qualification((QualId,RegNo,YOP,BoardOfExamination,AvgMarks)VALUES('','$_SESSION[regno]','$_POST[YOP]','$_POST[Qualification]','$_POST[AvgMarks]')");
			$sqlins=mysql_query("INSERT into qualification(QualId,RegNo,YOP,BoardOfExamination,AvgMarks)VALUES('','$_SESSION[regno]','$_POST[YOP]','$_POST[Qualification]','$_POST[AvgMarks]')");
					if(!($sqlins))
					{
					$qrst="<font color='red'><h3>Failed to insert record in database...</h3></font>".mysql_error($con);
					}
					else
					{
						$qrst="<font color='#006633'><h3><strong>Qualification record inserted successfully...</strong></h3></font>";
					}
		}
	}
}
$_SESSION[setid]=rand();
$sql="SELECT * FROM qualification";
$resqualification=mysql_query($sql);
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
if(isset($_GET[delid]))
{
$sqldel = "DELETE FROM qualification where QualId='$_GET[delid]'";
$resdel = mysql_query($sqldel);
	if(!$resdel)
	{
		echo "<font color='red'><h3>Failed to delete... Problem in sql query</h3></font>";
	}
	else
	{
		$msg = "<font color='green'><h3>Record deleted successfully...</h3></font>";
	}
}

$sql="SELECT * FROM qualification";
$resqualification=mysql_query($sql);

$sqlst = "SELECT * FROM qualification WHERE QualId='$_GET[editid]'";
$sqquery = mysql_query($sqlst);
$sqrec = mysql_fetch_array($sqquery);
?>

<p><strong><?php echo $msg; ?></strong></p>

<?php
include("header.php");
?>             
      	<div class="row space30"> <!-- row 1 begins -->
      
  <?php
  include("studentsidebar.php");
  ?>
            
          <div class="col-xs-12 col-sm-6 col-lg-8">
              	<h2>Add Qualification</h2>
                <h5><?php echo $qrst; ?></h5>
            <p>

<form name="quform" method="post" action="" onsubmit="return validate()">
<input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>" />
<input type="hidden" name="RegNo"  value="<?php echo $_SESSION[regno]; ?>"><table  class="tftable" width="576" height="234" border="1">
<tr>
  <th width="199" height="38">&nbsp; Qualification</th>
  <td width="361"><input name="Qualification" type="text"  value="<?php echo $sqrec[Qualification]; ?>" size="25">
</td></tr>
<tr>
<th height="33">&nbsp; Year Of Passing</th>
<td><input type="Date" name="YOP" value="<?php echo $sqrec[YOP]; ?>">
</td></tr>

<tr>
<th height="37">&nbsp; AvgMarks</th>
<td><input name="AvgMarks" type="text"  value="<?php echo $sqrec[AvgMarks]; ?>" >
</td></tr>
<tr>
<td height="39" colspan="2" align="center"><input name="Submit" type="submit" value="Submit">
</td></tr></table></form>
</p>
          </div>
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 
include("footer.php");
?>
