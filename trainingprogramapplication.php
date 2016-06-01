<?php
session_start();
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
if(isset($_GET[delid]))
{
$sqldel = "DELETE FROM applicationform where AppId='$_GET[delid]'";
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
              	<h2>Training program details</h2>
            <p>

<table  class="tftable" width="849" border="2">
<tr>
<th width="98">Training program details</th>
<th width="179">Company Name</th>
<th width="155">Applied date</th>
<th width="104">Message</th>
<th width="85">Action</th>
</tr>
<?php
$sql="SELECT    companies.*, applicationform.*, trainingprogram.*, applicationform.RegNo AS Expr1, applicationform.apptype AS Expr2
FROM         companies INNER JOIN
                      trainingprogram ON companies.CompanyId = trainingprogram.CompanyId RIGHT OUTER JOIN
                      applicationform ON trainingprogram.TrainingId = applicationform.JobId where applicationform.RegNo ='$_SESSION[regno]' AND applicationform.apptype ='Training program' ";
$resapplicationform=mysql_query($sql);
while($rs = mysql_fetch_array($resapplicationform))
{
					
	echo "<tr>";
	echo "<td>
	<strong>Training type: </strong>$rs[TrainingType] <br>
	<strong>Title: </strong>$rs[Title] <br>
	<strong>Venue </strong>$rs[Venue] <br>
	<a href='trainingmoredetails.php?trainingid=$rs[JobId]'>View More</a>
	
	</td>";
	echo "<td>$rs[CompanyName]</td>";
	echo "<td>$rs[AppliedDate]</td>";
	echo "<td>$rs[message]</td>";
	echo "<td>
	<a href='viewapplication.php?delid=$rs[AppId]' onclick='return ConfirmDelete()'>Delete</a></td>";
	echo "</tr>";
}
?>
</table>
</p>
          </div>
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 
include("footer.php");
?>
	