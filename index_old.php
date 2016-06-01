<?php
include("dbconnection.php");

					$sql="SELECT * FROM course WHERE status='Enabled'";
					$resultquery = mysql_query($sql);

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
                   <?
					while($rsrec = mysql_fetch_array($resultquery))
					{ ?>
                        <option><?php echo $rsrec['CourseName']; ?>

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
include("footer.php");
?>