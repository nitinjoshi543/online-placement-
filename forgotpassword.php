<?php
include("dbconnection.php");
?>
<?php
 if(isset($_POST[Changepassword]))
 {
 	$sql = "SELECT * FROM  `students` where RegNo='$_POST[regno]' AND EmailId='$_POST[emailid]'";
	$sqlq = mysql_query($con,$sql);
 	if(mysql_num_rows($sqlq) == 1)
	{	
	$rs = mysqli_fetch_array($sqlq);
	 $toaddress = $_POST[emailid];
	 $subject = "Recover password";
	 $message = " Hello ". $rs[FirstName] . " ". $rs[LastName]. "\n";
	 $message = $message. "Your Registration No. is : ". $rs[RegNo]. "\n";
	 $message = $message. "Your password is : ". $rs[password];
	 mail($toaddress,$subject,$message,"From: $aravinda@technopulse.in");
 	$msg = "<font color='green'><h3>Password sent successfully.. Kindly check your Email ID</h3></font>";
	}
	else
	{
	$msg = "<font color='red'><h3>Failed to retrieve password...</h3></font>";	
		}
 }
include("header.php");
?>             
      	<div class="row space30"> <!-- row 1 begins -->
      
  <div class="col-xs-12 col-sm-6 col-lg-8">
              	<h2>Forgot password</h2>
                   <p><strong><?php echo $msg; ?></strong></p>
      <form method="post" action="">
<table  class="tftable" width="424" height="142" border="2">
<tr>
<th>Registration No</th>
<td>&nbsp;&nbsp;<input type="text" name="regno" size="30" placeholder="Enter register number"></td>
</tr>
<tr>
<th>Email ID</th>
<td>&nbsp;&nbsp;<input type="text" name="emailid" size="30" placeholder="Enter Email ID"></td>
</tr>
<tr>
<td colspan="2" align="center"><input name="Changepassword" type="submit" value="Change Password" ></td>
</tr></table></form>
</p>
          </div>
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 
include("footer.php");
?>
