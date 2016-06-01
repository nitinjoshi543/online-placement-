<?php
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
$idd=$_GET['delid'];
if(isset($_GET['delid']))
{
$resdel = mysql_query("DELETE FROM employees where empid=$idd");
	if(!$resdel)
	{
		echo "Failed to delete... Problem in sql query";
	}
	else
	{
		$msg = "Record deleted successfully..";
	}
}

//$sql="SELECT * FROM employees";
$resemployee=mysql_query("SELECT * FROM employees");
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
              	<h2>Admin Home</h2>
            <p>

<table  class="tftable" width="871" border="2">
<tr>
<th width="67">Name</th>
<th width="127">Login Type</th>
<th width="93">Login Id</th>
<th width="137">Designation</th>
<th width="121">Last Login</th>
<th width="74">Status</th>
<th width="96">Action</th>
</tr>
<?php
while($rs = mysql_fetch_array($resemployee))
{ ?>
	<tr>
<th width="67"><?php echo $rs['empname']; ?></th>
<th width="127"><?php echo $rs['logintype']; ?></th>
<th width="93"><?php echo $rs['loginid']; ?></th>
<th width="137"><?php echo $rs['designation']; ?></th>
<th width="121"><?php echo $rs['lastlogin']; ?></th>
<th width="74"><?php echo $rs['status']; ?></th>

<td width="96">
	<a href='viewemployee.php?delid=<?php echo $rs["empid"]; ?>' onclick='return ConfirmDelete()'>Delete</a> |
	<a href='Employees.php?editid=$rs[empid]'>Edit</a>
	</td>
	</tr>
<?php }
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