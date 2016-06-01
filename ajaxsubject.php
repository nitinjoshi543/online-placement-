<?php
include("dbconnection.php");
echo $_GET[q];
?>

<select size=1 name="subjectid" >
 <option>Select</option>

 <?php
	$sql = "SELECT * FROM subjects where status='Enabled' and courseid='$_GET[q]'";
	$qresult = mysql_query($sql);
	while($rs = mysql_fetch_array($qresult))
		{
			echo "<option value='$rs[subjectcode]'>$rs[subjectname]</option>";
		}
 ?>

 </select>