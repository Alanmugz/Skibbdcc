<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head><!--  ščřžýŠČŘŽÝ -->
  <meta name="generator" content="PSPad editor, www.pspad.com" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  
  <title>Update Area</title>
  
  <script type='text/javascript' src='jquery/jquery.js'></script>
  <link rel="stylesheet" type="text/css" href="global.css"/>
  <script type="text/javascript" src="global.js"></script>
  <link rel="icon" type="image/png" href="images/favicon.png"/>
  
  
  </head>
  <body onload="checkForMeeting(MyJSStringVar)">
  
  <div id="container">
	<!-- header -->
	<div id="header">
		<?php 
			include ('header.html'); 
		?>
    </div>
	<!-- Menu Bar -->
	<div id="menu">
	 
	<div id='cssmenu'> 
		<?php
			include ('menu.html');
		?>
	</div>
	 
	</div>
	 
    <!-- Main Content -->
	<div class="wrapper">
		<?php
			include 'getMeeting2.php'; 
		?>
		
		<script type='text/javascript'>
			var MyJSStringVar = "<?php Print($meetingDetails); ?>";    
		</script>
		<div id="news">
		<?php
			
				session_start(); 
			
				$username = $_POST['username'];
				$password = $_POST['password'];
				
				if($username && $password)
				{
				$connect = mysql_connect("localhost","skibbdcc_usernam","fastnetrally85") or die ("Couldnt Connect");
				mysql_select_db ("skibbdcc_login") or die ("Couldnt find db");
				
				$query = mysql_query("SELECT * FROM skibbdcclogin WHERE username='$username'"); 
				 
				$numrows = mysql_num_rows($query);
				
				if($numrows != 0)
				{
					while($row = mysql_fetch_assoc($query))
					{
						$dbusername = $row['username'];
						$dbpassword = $row['password']; 
						
						if($username==$dbusername && $password==$dbpassword)
						{
							
							$_SESSION['username']=$username;   
							echo "<div id='pageheader'>
									Welcome ".$_SESSION['username']."<span id='logout'><a href='logout.html'>Logout</a></span> 
								 </div>"; 
		?>
								 		<div style='padding: 15px;'>
		
			<div class='content'>			
				<div class='tabbed_content'>
					<div class='tabs'>
						<div class='moving_bg'>
							&nbsp;
						</div>
						<span class='tab_item'>
							Club Meeting
						</span>
						<span class='tab_item'>
							Set Videos
						</span>
						<span class='tab_item'>
							Upload Images
						</span>
					</div>
					
					<div class='slide_content'>						
						<div class='tabslider'>
							<ul>
								<form action='saved.php' method='POST' id='set_form' style='zheight:300px;width:400px;align:center;margin-left:auto;margin-right:auto;margin-top:-80px;'>
									<select  style='width:30%;padding:10px;' name='set_day'>
									  <option value='Mon'>Monday</option>    
									  <option value='Tue'>Tuesday</option>
									  <option value='Wed'>Wednesday</option>
									  <option value='Thu'>Thursday</option>
									  <option value='Fri'>Friday</option>
									  <option value='Sat'>Saturday</option>
									  <option value='Sun'>Sunday</option> 
									</select>
									<select  style='width:18%;padding:10px;' name='set_date'>
									  <option value='1st'>1</option>    
									  <option value='2nd'>2</option>
									  <option value='3rd'>3</option>
									  <option value='4th'>4</option>
									  <option value='5th'>5</option>
									  <option value='6th'>6</option>
									  <option value='7th'>7</option>
									  <option value='8th'>8</option>
									  <option value='9th'>9</option>
									  <option value='10th'>10</option>
									  <option value='11th'>11</option>    
									  <option value='12th'>12</option>
									  <option value='13th'>13</option>
									  <option value='14th'>14</option>
									  <option value='15th'>15</option>
									  <option value='16th'>16</option>
									  <option value='17th'>17</option>
									  <option value='18th'>18</option>
									  <option value='19th'>19</option>
									  <option value='20th'>20</option>
									  <option value='21st'>21</option>    
									  <option value='22nd'>22</option>
									  <option value='23rd'>23</option>
									  <option value='24th'>24</option>
									  <option value='25th'>25</option>
									  <option value='26th'>26</option>
									  <option value='27th'>27</option>
									  <option value='28th'>28</option>
									  <option value='29th'>29</option>
									  <option value='30th'>30</option>
									  <option value='31st'>31</option>
									</select>
									<select  style='width:30%;padding:10px;' name='set_month'>
									  <option value='January'>January</option>    
									  <option value='Februray'>Februray</option>
									  <option value='March'>March</option>
									  <option value='April'>April</option>
									  <option value='May'>May</option>
									  <option value='June'>June</option>
									  <option value='July'>July</option> 
									  <option value='August'>August</option>
									  <option value='September'>September</option>
									  <option value='October'>October</option>
									  <option value='November'>November</option>
									  <option value='December'>December</option>
									</select>
									<select style='width:19%;padding:10px;' name='set_year'>									     
									  <option value='2015'>2015</option>
									  <option value='2016'>2016</option> 
									</select>
									<br /><br />
									
									<span style='position:relative;top:10px;float:left;color:white;color:white;'>Venue:</span> 
									<input type='text' style='float:left;padding:10px;width:172px;margin-left:10px;margin-right:10px;' name='set_venue'>   
									<span style='float:left;color:white;color:white;position:relative;top:10px;'>Time:</span>  
									<select style='width:26%;padding:10px;margin-left:10px;float:right;position:relative;top:-15px;' name='set_time'>
									  <option value='7pm'>7PM</option>    
									  <option value='7.30pm'>7.30PM</option>
									  <option value='8pm'>8PM</option>
									  <option value='8.30pm'>8.30PM</option>
									  <option value='9pm'>9PM</option>
									  <option value='9.30pm'>9.30PM</option>
									</select>
									
									  
								<input type='submit' name='save_button' value='Save Meeting' style='position:relative;top:50px;left:3px;'/>   
								</form>   
							</ul> 
              
							<ul>
								<form action='savedvideo.html' method='POST' id='set_video' style='width:400px;align:center;margin-left:auto;margin-right:auto;'>
									<span style='float:left;color:white;position:relative;top:9px;'>URL:</span><input type='text' style='float:right;padding:10px;width:335px;margin-left:10px;' name='set_video' id='setvideo'><br /><br /><br />
									<input type='submit' name='save_button' value='Submit Video' style='float:right;'/>
								</form>  
							</ul>
              
              
							<ul>
 							 <form enctype="multipart/form-data" action="" method="GET" style='height:35px;width:400px;align:center;margin-left:auto;margin-right:auto;'> 
								 <span style="color:white;margin-right:10px;">Add New Category: </span><input name="addcategory" type="text" style="padding:10px;width:160px;"/>  
								 <input type="submit" value="Add Cat" />
							 </form>
							 <br />
							 <form enctype="multipart/form-data" action="image_upload.php" method="POST" style='height:300px;width:400px;align:center;margin-left:auto;margin-right:auto;'>
								 <?php
								 $con=mysqli_connect("localhost","skibbdcc_usernam","fastnetrally85","skibbdcc_gallery"); 
								 // Check connection
								 if (mysqli_connect_errno())
								  {
								  echo "Failed to connect to MySQL: " . mysqli_connect_error();
								  }

								  $result = mysqli_query($con,"SELECT DISTINCT category FROM galleryinfo");

								  ?> 
								  <span style="color:white;margin-right:10px;">Choose Category: </span><select name="setcategory" width="200px" style="padding:10px;width:200px;">
								  <?php 
								  while($row = mysqli_fetch_array($result))
								  {
								  ?>
								  <option value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option>
								  <?php 
								  }
								  ?>
								  <option value="<?php echo $_GET['addcategory']; ?>"><?php echo $_GET['addcategory'];?></option>
								  </select>
								  <br /><br />       
									
								 
								 <span style="color:white;margin-right:10px;">Please choose a file: </span><input name="uploaded" type="file" style="color:white;"/><br />
								 <input type="submit" value="Upload" />     
							 </form>    

							 

							<?php
							mysqli_close($con);
							?> 
							</ul>
              
              </div>
						<br style='clear: both' />
					</div>
				</div>
			</div>
			
		</div>    
			<?php					 
						}
						else
							echo "<div id='pageheader'> 
									Incorrect password<span id='logout'>Return to <a href='contributors_login.html'>Contributors Login</a></span>   
								  </div>";
					}
				}
					else
						echo "<div id='pageheader'> 
								Incorrect username<span id='logout'>Return to <a href='contributors_login.html'>Contributors Login</a></span>   
							  </div>"; 
				
				}
				else
					echo "<div id='pageheader'>
							Please enter a username and password  <span id='logout'>Return to <a href='contributors_login.html'>Contributors Login</a></span>   
						  </div>";
			?>
			
		</div> 
	<div id="newsrow">
		<?php 
			include ('sidebar.html'); 
		?>
	</div> 
	   
	<!-- footer -->
		<div id="footer">
			<?php 
				include ('footer.html'); 
			?>	
		</div>	

	
	<!-- Copyright -->
		<div id="copyright">&copy; Skibbereen &amp; District Car Club 2011 - <span id="getYear"></span><br />Designed by Alan Mulligan Web Design</div>
		 
  </div>
         
  </body>
  </html>