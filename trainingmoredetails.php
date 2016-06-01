<?php
session_start();
include("dbconnection.php");
include("header.php");
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
if($_POST[setid]==$_SESSION[setid])
{
	if(isset($_POST[Submit]))
	{	
			$filename = rand(). $_FILES[file][name];
			move_uploaded_file($_FILES[file][tmp_name], "resume/".$filename);
			
			$dt = date("Y-m-d");
			
				$sqlins="INSERT into applicationform(RegNo,JobId,AppliedDate,Resume,message,Status,apptype) VALUES 
	('$_SESSION[regno]','$_GET[trainingid]','$dt','$filename','$_POST[message]','Enabled','Training program')";
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

$_SESSION[setid]=rand();

$sql = "SELECT trainingprogram.*,companies.* FROM trainingprogram INNER JOIN companies ON companies.CompanyId=trainingprogram.CompanyId where trainingprogram.TrainingId='$_GET[trainingid]'";
$restraining = mysql_query($sql);
$rs = mysql_fetch_array($restraining);

$sql = "SELECT * FROM students where RegNo='$_SESSION[regno]'";
$stquery = mysql_query($sql);
$rsst = mysql_fetch_array($stquery);

?>

<div class="row space30"> <!-- row 1 begins -->
      
      		<div class="col-sm-6 col-lg-4">
           	  					 <h2>Company Name</h2>
              	<p>
                  <?php
                echo ucfirst($rs[CompanyName]);
			  ?>
              <hr />
                </p>
               <?php
                if($rs[CompanyLogo] == "")
					{
					echo "<a href='trainingmoredetails.php?trainingid=$rs[TrainingId]'><img src='images/noimage.jpg'  height='175' width='350'  class='img-responsive img-rounded img_bottom' ></a>";		
					}
					else
					{
					echo "<a href='trainingmoredetails.php?trainingid=$rs[TrainingId]'><img src='uploadedfiles/$rs[CompanyLogo]'  height='175' width='350'   class='img-responsive img-rounded img_bottom' ></a>";
					}
					?> 
   	           
               <h2>About company</h2>
              	<p>
					<h3><a href="companymoredetails.php?companyid=<?php echo  $rs[CompanyId];?>">Click here</a></h3>
                </p>
    
            </div>
 
             <div class="col-xs-12 col-sm-6 col-lg-8">
              	<h2><?php echo $rs[Title]; ?></h2>
                
            <p><strong>Date & Time :</strong> <?php
            echo $rs[TPDatetime]; 
			?></p>
            <p><?php
            echo $rs[TPInfo]; 
			?></p>
            
            <h2>Training Type</h2>
              	<p>
                  <?php
                echo $rs[TrainingType];
			  ?>
                </p>  
                        
            	<h2>Departments</h2>
                 <p><?php
            echo $rs[TPDepartments]; 
			?></p>
			
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

					$sql="SELECT * from applicationform where RegNo='$_SESSION[regno]' AND JobId='$_GET[trainingid]' AND apptype='Training program'";					 
					$sqlquery = mysql_query($sql);
					$sqlqueryfetch = mysql_fetch_array($sqlquery);
					if(mysql_num_rows($sqlquery) == 0)
					{
				 ?>             
                 <h2>Apply to this training program: </h2>
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
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
      
   <?php
	include("footer.php");
	?>