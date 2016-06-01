<?php
error_reporting(0);
session_start();
$dttim = date("Y-m-d h:i:s");
?>

<script language="javascript">
function validate1()
{
	if(document.form1.regno.value=="")
	{
		alert("Please enter Register Numbe");
		document.form1.regno.focus();
		return false;
	}
	else if(document.form1.password.value=="")
	{
		alert("Please enter password ");
		document.form1.password.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>

<script language="javascript">
function validate2()
{
	if(document.form2.loginid.value=="")
	{
		alert("Please enter Login ID");
		document.form2.loginid.focus();
		return false;
	}
	else if(document.form2.password.value=="")
	{
		alert("Please enter password");
		document.form2.password.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>

<script language="javascript">
function validate3()
{

		if(document.form3.fname.value=="")
	{
		alert("Please enter First Name");
		document.form3.fname.focus();
		return false;
	}
	else if(document.form3.regno.value =="")
	{
		alert("Please enter Register Number");
		document.form3.regno.focus();
		return false;
	}
	else if(isNaN(document.form3.regno.value) ==true)
	{
		alert("Please enter numerical value in Registration Number");
		document.form3.regno.focus();
		return false;
	}
	else if(document.form3.newpassword.value =="")
	{
		alert("Password Should not be empty..");
		document.form3.newpassword.focus();
		return false;
	}
	else if(document.form3.newpassword.value.length < 6)
	{
		alert("Password must contain atleast 6 charecters");
		document.form3.newpassword.focus();
		return false;
	}
	else if(document.form3.newpassword.value!= document.form3.confirmpassword.value)
	{
		alert("Password and confirm password not matching");
		document.form3.newpassword.focus();
		return false;
	}
	else if(document.form3.course.value=="Select")
	{
		alert("Please enter course");
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
if(isset($_SESSION[empid]))
{
	header("Location: dashboard.php");
}
if(isset($_SESSION[regno]))
{
	header("Location: studentpanel.php");
}
if(isset($_POST["submit2"]))
{ //exit( "SELECT * FROM students WHERE RegNo='$_POST[regno]' AND password='$_POST[password]' AND Status='Enabled'");
	$sql = "SELECT * FROM students WHERE RegNo='$_POST[regno]' AND password='$_POST[password]' AND Status='Enabled'";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) == 1)
	{
		$rs = mysql_fetch_array($result);
		$msg = "<br><strong><h3><font color='green'>Student logged in successfully..</font></h3></strong>";
		$_SESSION[regno]=$rs[RegNo];
		header("Location: studentpanel.php");
	}
	else
	{
		$msg = "<br><strong><h3><font color='red'>Failed to login</font></h3></strong>";
	}
}
if(isset($_POST["submit1"]))
{

$sql = "SELECT * FROM employees WHERE loginid='$_POST[loginid]' AND password='$_POST[password]' AND Status='Enabled'";
	$result = mysql_query("$sql");
	if(mysql_num_rows($result) == 1)
	{
		$rs = mysql_fetch_array($result);
		$msg1 = "<br><strong><font color='green'><h3>Employee logged in successfully..</h3></font></strong>";
		echo $_SESSION[empid]=$rs[empid];
		$_SESSION[logintype]=$rs[logintype];
		$_SESSION[lastlogin] = $rs[lastlogin];

		mysql_query("UPDATE employees SET lastlogin='$dttim' where loginid='$_POST[loginid]'");

		header("Location: dashboard.php");
	}
	else
	{
		$msg1 = "<br><strong><font color='red'><h3>Failed to login</h3></font></strong>";
	}

}

if($_POST[setid]==$_SESSION[setid])
{
if(isset($_POST[submit]))
{

$sqlins="INSERT into students(FirstName,LastName,RegNo,Password,CourseId,Status)VALUES('$_POST[fname]','$_POST[lname]','$_POST[regno]','$_POST[newpassword]','$_POST[course]','Enabled')";
$sqlresult=mysql_query($sqlins);
if(!$sqlresult)
{
	$regresi=1;
	$regres = "<font color='red'><strong><h3>Failed to insert records</h3></strong></font>". mysqli_error($con);
}
else
{
	$regresi=1;
	$regres =  "<font color='green'><strong><h3>Registered successfully</h3></strong></font>";
}
}
}
$_SESSION[setid]=rand();

include("header.php");

?>
      	<div class="row space30"> <!-- row 1 begins -->

      		<div class="col-sm-6 col-lg-4">

                <img src="images/login.jpg" alt="Image 3" class="img-responsive img-rounded img_right" />
           	  <h2>Student Login Panel</h2>
              <p><font color='blue'>Please enter registration Number and password to  login....</font><?php echo $msg; ?></p>

              <form role="form" name="form1" method="post" action="" onsubmit="return validate1()">
                  <div class="form-group">
                    <label for="name">Registration No.:</label>
                    <input name="regno" type="text" class="form-control" id="regno" placeholder="Enter your Registration number">
                  </div>
                <div class="form-group">
                    <label for="email">Password:</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Enter password">
                </div>
                <input name="submit2" type="submit" class="btn btn-default" id="submit2" value="Sign In">
                </form>

                <a href="forgotpassword.php"> <strong>Forgot Password</strong> </a>
                  <hr />
                  <h2>Admin Login Panel</h2>
              	<p><font color='blue'>Please enter Login ID and password....</font><?php echo $msg1; ?>.</p>

                <form name="form2" role="form" method="post" action="" onsubmit="return validate2()">
                  <div class="form-group">
                    <label for="name">Login ID:</label>
                    <input name="loginid" type="text" class="form-control" id="loginid" placeholder="Enter your Login ID">
                  </div>
                   <div class="form-group">
                    <label for="email">Password:</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Enter password">
                  </div>
                   <input type="submit" name="submit1" value="Sign In" class="btn btn-default">
                </form>

            </div>

          <div class="col-xs-12 col-sm-6 col-lg-8">
              	<h2>Welcome To Student Placement Portal</h2>
            <p>“Student Placement Portal” is the system to manage the student placement database.The main point of developing this system is to help placement officer to manage the student record and company detail and help the user for storing and searching the record.</p>

 <h2>Sign Up</h2>

        <?php
        $Reg=$_POST["regno"];
        if(!preg_match("/^12003010+[0-9]/",$Reg));
		{
                    $reg1="reg not valid";
                }
        if($regresi == 1)
				{
              	echo "<p><font color='green'><h2>Registered succesfully....</h2></font></p>";
				}
				else
				{
                echo "<p><font color='blue'><h2>Please enter following details.....</h2></font></p>";
				}
        ?>
                <form name="form3" role="form" method="post" action="" onsubmit="return validate3()">
                  <div class="form-group">
                  <input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>" />

                    <label for="fname">First Name.:</label>
                    <input name="fname" type="text" class="form-control" id="fname" placeholder="Enter First name">
                  </div>
                  <div class="form-group">
                    <label for="fname">Last name.:</label>
                    <input name="lname" type="text" class="form-control" id="lname" placeholder="Enter Last name">
                  </div>
                  <div class="form-group">
                    <label for="fname">Registration No.:</label>
                    <input name="regno" type="text" class="form-control" id="regno" placeholder="Enter your Registration Number">
                  </div>
                  <div class="form-group">
                    <label for="email">Password:</label>
                    <input name="newpassword" type="password" class="form-control" id="newpassword" placeholder="New password">
                  </div>
                  <div class="form-group">
                    <label for="subject">Confirm Password:</label>
                    <input name="confirmpassword" type="password" class="form-control" id="confirmpassword" placeholder="Confirm password">
                  </div>

                  <div class="form-group">
                    <label for="subject">Course:</label>
                    <select name="course"  class="form-control">
                    <option value="Select">Select course</option>
                    <?php
					$sql=mysql_query("SELECT * FROM course WHERE status='Enabled'");
					//$resultquery = mysqli_query($sql);
					while($rsrec = mysql_fetch_array($sql))
					{ ?>
						<option value="<?php echo $rsrec['CourseId']; ?>"><?php echo $rsrec['CourseName']; ?> | Course code:<?php echo $rsrec['coursecode']; ?></option>";
					<?php }
					?>
                    </select>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input name="newuser" type="checkbox" id="newuser" value="new"> I am new user.
                    </label>
                  </div>
                  <input name="submit" type="submit" class="btn btn-default" id="submit" value="Register here"  onclick="if(!this.form.newuser.checked){alert('You must Select New user option.');return false}" >
                </form>


 </div>

     	</div> <!-- /row 1 -->

        <div class="row space30"> <!-- row 2 begins -->


        </div> <!-- /row 2 -->
<?php

?>