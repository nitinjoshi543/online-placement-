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
$sqldel = "DELETE FROM students where RegNo='$_GET[delid]'";
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

$sql = "SELECT students.*,course.CourseName FROM students INNER JOIN course ON students.CourseId=course.CourseId";
$resstudents=mysql_query($sql);
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
              	<h2>View Students </h2>
            <p>
<table  class='tftable' width="896" border="1">
<tr>
<th width="135">Image</th>
<th width="144">Registration No</th>
<th width="151">Name</th>
<th width="103">Course</th>
<th width="127">DOB</th>
<th width="90">Contact Details</th>
<th width="124">Action</th>
</tr>
<?php
while($rs = mysql_fetch_array($resstudents))
{
	echo "<tr><td>";
	   

	if($rs[stimg] == "")
	{
	echo "<img src='images/noimage.jpg' width='50' height='50'>";		
	}
	else
	{
	echo "<img src='uploadedfiles/$rs[stimg]' width='50' height='50'>";
	}


	echo "</td><td>$rs[RegNo]</td>";
	echo "<td>$rs[FirstName] $rs[LastName]</td>";
	echo "<td>$rs[CourseName]</td>";
	echo "<td>$rs[DOB]</td>";
	echo "<td>
	<strong>Email ID:</strong> <br>$rs[EmailId] <br>
	<strong>Mobile No.</strong> <br>$rs[MobileNo]
	</td>";
	echo "<td>
	<strong>Status:</strong> $rs[Status]<br>
	<a href='viewstudents.php?delid=$rs[RegNo]' onclick='return ConfirmDelete()'>Delete</a> | <a href='students.php?editid=$rs[RegNo]'>Edit</a>
	</td>";;
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
?>S