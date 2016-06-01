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
$sqldel = "DELETE FROM course where CourseId='$_GET[delid]'";
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

$sql="SELECT * FROM course";
$rescourse=mysql_query($sql);
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
              	<h2>View Course</h2>
            <p>
<table  class="tftable" border="1">
<tr>
<th width="169">Course</th>
<th width="124">Course Code</th>
<th width="229">Comment</th>
<th width="171">Status</th>
<th width="169">Action</th>
</tr>
<?php
while($rs = mysql_fetch_array($rescourse))
{
	echo "<tr>";
	echo "<td>$rs[CourseName]</td>";
	echo "<td>$rs[coursecode]</td>";
	echo "<td>$rs[Comment]</td>";
	echo "<td>$rs[Status]</td>";
	echo "<td><a href='viewcourse.php?delid=$rs[CourseId]' onclick='return ConfirmDelete()'>Delete</a> |
<a href='course.php?editid=$rs[CourseId]'>Edit</a></td>";
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
	
	
