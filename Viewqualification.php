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
$sqldel = "DELETE FROM qualification where QualId='$_GET[delid]'";
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

<?php
if(isset($_SESSION[regno]))
{
	$sql="SELECT * FROM qualification where RegNo='$_SESSION[regno]'";
}
else
{
	$sql="SELECT * FROM qualification";	
}
$resqualification=mysql_query($sql);
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
              	<h2>View Qualification</h2>
            <p>

<table  class='tftable' border="2">
<tr>
<th>RegNo</th>
<th>Quallification</th>
<th>Year of passing</th>

<th>Average marks</th>
<th>Action</th>
</tr>
<?php
while($rs = mysql_fetch_array($resqualification))
{
	echo "<tr>";
	echo "<td>$rs[RegNo]</td>";
	echo "<td>$rs[BoardOfExamination]</td>";
	echo "<td>$rs[YOP]</td>";
	
	echo "<td>$rs[AvgMarks]</td>";
	echo "<td>
	<a href='viewqualification.php?delid=$rs[QualId]' onclick='return ConfirmDelete()'>Delete</a> |
<a href='qualification.php?editid=$rs[QualId]'>Edit</a></td>";
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

?>


