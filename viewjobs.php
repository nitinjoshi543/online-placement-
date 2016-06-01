<?php
include("dbconnection.php");
?>

<script>
    function ConfirmDelete()
	{
		var result = confirm("Are you sure?");
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
$sqldel = "DELETE FROM jobs where JobId='$_GET[delid]'";
$resdel = mysql_query($sqldel);
	if(!$resdel)
	{
		echo "Failed to delete... Problem in sql query";
	}
	else
	{
		$msg = "Record deleted successfully..";
	}
}

$sql="SELECT jobs.*,companies.* FROM jobs INNER JOIN companies ON jobs.CompanyId=companies.CompanyId";
$resemployee=mysql_query($sql);
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
              	<h2>View jobs</h2>
            <p>



<?php
while($rs = mysql_fetch_array($resemployee))
{
	$ldt = date('d-m-Y', strtotime($rs[RegistrationTime]));
	$idt = date('d-m-Y', strtotime($rs[InterviewDate]));
	
	echo "<table  class='tftable' width='964' border='1'>
	<tr>
<th width='65'>Job Details</th>
<th width='108'>Selection process</th>
<th width='49'>Interview details</th>
<th width='112'>Action</th>
</tr>";
	
	echo "<tr>";
	echo "<td><strong>Job Title:</strong> $rs[JobTitle] <br>";
	echo "<strong>Company:</strong> $rs[CompanyName]<br>";
	echo "<strong>Job Location:</strong>  $rs[JobLocation]<br>";
	echo "<strong>Job resposibility:</strong> $rs[JobResponsibility]<br>";
	
	$Eligibility = str_replace('Null,','', $rs[Eligibility]);

	echo "<strong>Eligibility:</strong> $Eligibility <br>";
	echo "<strong>Compensation:</strong> $rs[Compensation]";
	echo "</td>";
	echo "<td>$rs[SelectionProcess]<br> 	
	<br> <strong>Documents required:</strong><br>$rs[DocReq]
	</td>";
	echo "<td>	
	<strong>Interview Date:</strong><br>$rs[InterviewDate]<br>
	<strong>Last date for registration:</strong><br> 		$rs[RegistrationTime]
	<br><strong>Venue:</strong> <br>$rs[Venue]</td>";
	echo "<td>
	$rs[Status] <br>
	<a href='viewjobs.php?delid=$rs[JobId]' onclick='return ConfirmDelete()'>Delete</a> | <a href='jobs.php?editid=$rs[JobId]'>Edit</a></td>";
echo "</table><hr>";
}
?>

</p>
          </div>
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 

?>