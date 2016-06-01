<?php
session_start();
include("dbconnection.php");
include("header.php");
?>


      	<div class='row space30'> <!-- row 1 begins -->
      
<?php
			$sql = "SELECT * FROM companies";
			$rescompany = mysql_query("SELECT * FROM companies");

			while($rs = mysql_fetch_array($rescompany))
			{
            echo "<div class='col-xs-6 col-sm-3'><h3>";
			echo ucfirst($rs[CompanyName]);
			echo "</h3>";
					if($rs[CompanyLogo] == "")
					{
					echo "<a href='companymoredetails.php?companyid=$rs[CompanyId]'><img src='images/noimage.jpg'  class='img-responsive img-rounded img_bottom' height='175' width='220' ></a>";		
					}
					else
					{
					echo "<a href='companymoredetails.php?companyid=$rs[CompanyId]'><img src='uploadedfiles/$rs[CompanyLogo]'  class='img-responsive img-rounded img_bottom'  height='175' width='250' ></a>";
					}
              echo "<p><a class='btn-sm btn-primary' href='companymoredetails.php?companyid=$rs[CompanyId]'>More details &raquo;</a> &nbsp; <a class='btn-sm btn-success' href='job.php?companyid=$rs[CompanyId]'>View Jobs &raquo;</a></p>
            </div>
			";
			}
			?>
            
     	</div> <!-- /row 1 -->
        
    <?php
	
	?>