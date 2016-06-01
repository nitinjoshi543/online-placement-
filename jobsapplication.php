<?php
session_start();
include("dbconnection.php");
?>
<script language="javascript">
function validate1()
{
	if(document.stdform.regno.value=="")
	{
		alert("Please enter Register Number");
		document.stdform.regno.focus();
		return false;
	}
	else if(document.stdform.password.value=="")
	{
		alert("Please enter password ");
		document.stdform.password.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>
<?php


if(isset($_POST[submit2]))
{
	$sql = "SELECT * FROM students WHERE RegNo='$_POST[regno]' AND password='$_POST[password]' AND Status='Enabled'";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) == 1)
	{
		$rs = mysql_fetch_array($result);
		$msg = "<br><strong><font color='green'>Student logged in successfully..</font></strong>";
		$_SESSION[regno]=$rs[RegNo];
		//header("Location: jobsapplication.php?jobid=$_GET[jobid]");
	}
	else
	{
		$msg = "<br><strong><font color='red'>Failed to login</font></strong>";
	}
}
include("header.php");
if($_POST[setid]==$_SESSION[setid])
{
	if(isset($_POST[Submit]))
	{	
			$filename = rand(). $_FILES[file][name];
			move_uploaded_file($_FILES[file][tmp_name], "resume/".$filename);
			
			$dt = date("Y-m-d");
			
				$sqlins="INSERT into applicationform(RegNo,JobId,AppliedDate,Resume,message,Status,apptype) VALUES 
	('$_SESSION[regno]','$_GET[jobid]','$dt','$filename','$_POST[message]','Enabled','Job application')";
				$queryresult  = mysql_query($sqlins);
				if(!$queryresult)
				{
					$qresulti = 1;
					$qresult = "<font color='red'><strong>Failed to insert record in database...</strong></font>". mysqli_query($con);
				}
				else
				{
					$qresulti = 1;
					$qresult = "<font color='green'><strong>Application submitted successfully...</strong></font>";
					$qresult = $qresult . "<br> Your Application Reference Number is: ". mysqli_insert_id($con);
					$qresult = $qresult . "<br> <a href='studentpanel.php'>Click here </a>";
				}
	}
}

$sql = "SELECT * FROM students where RegNo='$_SESSION[regno]'";
$stquery = mysql_query($sql);
$rsst = mysql_fetch_array($stquery);

$sql = "SELECT jobs.*,companies.* FROM jobs INNER JOIN companies ON jobs.CompanyId=companies.CompanyId where jobs.JobId='$_GET[jobid]'";
$rescompany = mysql_query($sql);
$rs = mysql_fetch_array($rescompany);

$_SESSION[setid]=rand();
?>
      	<div class="row space30"> <!-- row 1 begins -->
      
            <div class="col-md-6">
           	  <h2><?php echo $rs[JobTitle]; ?></h2>
              <h4>Job Code: <?php echo $rs[JobId]; ?></h4>
              	<p>
                <?php
                if($rs[CompanyLogo] == "")
					{
					echo "<a href='companymoredetails.php?companyid=$rs[CompanyId]'><img src='images/sys.jpg' height='200' width='350'  class='img-responsive img-rounded img_bottom' ></a>";		
					}
					else
					{
					echo "<a href='companymoredetails.php?companyid=$rs[CompanyId]'><img src='uploadedfiles/$rs[CompanyLogo]'  height='200' width='350' class='img-responsive img-rounded img_bottom' ></a>";
					}
				?>
				</p>
                <p><strong>Company : <?php echo ucfirst($rs[CompanyName]); ?> </strong> </p>
              	<p><strong>Job Location :</strong> <?php echo ucfirst($rs[JobLocation]); ?></p>
                <p><strong><u>Job Responsibility : </u></strong><br><?php echo ucfirst($rs[JobResponsibility]); ?></p>
                <p><strong><u>Eligibility</u> : </strong> <?php echo  str_replace("Null,","",$rs[Eligibility]); ?></p>                
                
                <p><strong><u>Selection Process</u> : </strong>
                <br><?php echo $rs[SelectionProcess]; ?></p>
                
                <p><strong><u>Compensation</u> : </strong><?php echo $rs[Compensation]; ?></p>
                

            </div>
        
            <div class="col-md-6">
              	<h2>Interview details</h2>
              	<p>
                <strong>Interview Date:</strong> <?php echo $rs[InterviewDate]; ?><br>
                <strong>Last Date for Registration:</strong> <?php echo $rs[RegistrationTime]; ?><br>
                <strong>Documents required :</strong> <?php echo $rs[DocReq]; ?><br>
                <strong>Venue :</strong> <br><?php echo str_replace(",",", <br>",$rs[Venue]); ?><br>
               </p>
                
              
                <?php
				if($qresulti == 1)
				{
					echo "<h1>$qresult</h1>";
				}
				else
				{
				?>
                 <?php
				 if(isset($_SESSION[regno]))
				 {

					$sql="SELECT * from applicationform where RegNo='$_SESSION[regno]' AND JobId='$_GET[jobid]'";					 
					$sqlquery = mysql_query($sql);
					$sqlqueryfetch = mysql_fetch_array($sqlquery);
					if(mysql_num_rows($sqlquery) == 0)
					{
				 ?>             
                 <h2>Apply to this Job: </h2>
                <form role="form" method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="setid" value="<?php echo $_SESSION[setid]; ?>" />
                  <div class="form-group">
                    <label for="name">Name:</label>
                    <input name="name" type="text" class="form-control" id="name"  readonly value="<?php echo $rsst[FirstName]. " " . $rsst[LastName]; ?>">
                  </div>
                  <div class="form-group">
                    <label for="email">Registration No.:</label>
                    <input name="registrationno" type="text" class="form-control" id="registrationno" readonly value="<?php echo $rsst[RegNo]; ?>">
                  </div>
                  <div class="form-group">
                    <label for="subject">Upload Resume:</label>
                    <input name="file" type="file" class="form-control" id="file">
                  </div>
                  <div class="form-group">
                    <label for="message">Message:</label>
                  	<textarea name="message" rows="3" class="form-control" id="message" placeholder="Enter your message"></textarea>
				  </div>
              
                  <input type="submit" name="Submit" class="btn btn-default" value="Apply...">
                </form>
                <?php
					}
					else
					{
						echo "<font color='green'><strong>Your Application Reference Number is:</strong> ". $sqlqueryfetch[AppId]. "</font>";
					}
				 }
				else if(isset($_SESSION[empid]))
				{
						
				}
				 else
				 {
				?>
                <h2>Sign In to apply: </h2>
                <?php echo $msg ; ?>
                  <form role="form" name="stdform" method="post" action="" onsubmit="return validate1()">
                  <div class="form-group">
                    <label for="name">Registration No.:</label>
                    <input name="regno" type="text" class="form-control" id="regno" placeholder="Enter your Registration number">
                  </div>
                  <div class="form-group">
                    <label for="email">Password:</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Enter password">
                  </div>
                  <input type="submit" name="submit2" value="Sign In" class="btn btn-default">
                </form>
                <?php
				 }
				}
				?>
           </div>
            
     	</div> <!-- /row 1 -->
    <?php
	
	?>