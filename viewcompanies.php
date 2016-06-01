<?php
session_start();
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
$sqldel = "DELETE FROM companies where CompanyId='$_GET[delid]'";
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

$sql = "SELECT * FROM companies";
$rescompany = mysql_query($sql);


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
              	<h2>View companies</h2>
            <p>
<table  class="tftable" width="903" border="1">
<tr>
<th width="265">Company Name and Logo</th>
<th width="411">Contact details</th>
<th width="103">Status</th>
<th width="96">Action</th>
</tr>
<?php
while($rs = mysql_fetch_array($rescompany))
{
echo "<tr>";
echo "<td>";
echo "<strong>".$rs[CompanyName]. "</strong><br>";
	if($rs[CompanyLogo] == "")
	{
	echo "<img src='images/noimage.jpg' width='100' height='75'>";		
	}
	else
	{
	echo "<img src='uploadedfiles/$rs[CompanyLogo]' width='100' height='75'>";
	}
echo "</td>";
echo "<td>
<strong>Email ID:</strong> $rs[EmailId]<br>
<strong>Contact No.</strong> $rs[ContactNo]<br>
<strong>Website: </strong> <a href='$rs[Website]'>$rs[Website]</a></td>";
echo "<td>$rs[Status]</td>";
echo "<td><a href='viewcompanies.php?delid=$rs[CompanyId]' onclick='return ConfirmDelete()'>Delete</a> | <a href='companies.php?editid=$rs[CompanyId]'>Edit</a>
	</td>";
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