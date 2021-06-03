<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Booking Form HTML Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <link rel="stylesheet" href="./css/main.css">
		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:400" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="./css/booking/bootstrap.min.css" />

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="./css/booking/style.css" />
		<style>
			table{
				  border: 1px solid black;
				  text-align:center;
			     }
			th {
				border: 10px solid black;
				background-color: #D8105F;
				font-size:15px;
				padding:20px;
				}
			td {
				font-size:15px;	
				padding:20px;
				}
			.center{
				margin-left: auto;
				margin-right: auto;
				}
			.availability{
				text-align:center;
				}
	  </style>
     <script>
	function openForm() {
	document.getElementById("myForm").style.display = "block";
	}

	function closeForm() {
	document.getElementById("myForm").style.display = "none";
	}
	</script>
	</head>
<body>

<div class="nav">
	   <ul id="menu">
        <li><a href="index.html">Home</a></li>
		<li><a href="services.html">Services</a></li>
		<li><a href="Accommodation.html">Accommodation</a></li>
		<li><a href="booking.html">Bookings</a></li>
		<li><a href="register.html">Special Offer</a><li/>
		<li><a href="contactus.html">Contact Us</a></li>
   </ul>
		<div class="navright">
		    
			
			<div class="logindrop">
				<button class="open-button" onclick="openForm()">Login</button>

				<div class="form-popup" id="myForm">
					<form action="/action_page.php" class="form-container">
		
						<label for="email"><b>Email</b></label>
						<input type="text" placeholder="Enter Email" name="email" required>

						<label for="psw"><b>Password</b></label>
						<input type="password" placeholder="Enter Password" name="psw" required>

						<button type="submit" class="btn">Login</button>
						<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
					</form>
				</div>
			</div>
		</div>
	</div>


<div class="content">
<div class="slideshow">
  <img class="slide" src="./images/slider/image1.png" style="display: block;">
    <img class="slide" src="./images/slider/image2.png" style="display: none;">
    <img class="slide" src="./images/slider/image3.png" style="display: block;">
    <script src="./js/slides.js"></script>
</div>
<br>
    <div class="availability">	
    <h2>Room Availabilities</h2>
    	
    <?php
	//open the server connection
		require 'dbConnectHotel.php'; 
		if (empty($_POST['roomtype']) || empty($_POST['checkin']) || empty($_POST['checkout']))
			die("Check In, Check Out and Room Type have not been supplied");
		else
			{
			//update the record
			$sql = "SELECT * FROM room WHERE RoomType='$_POST[roomtype]' AND RoomID NOT IN (SELECT RoomID FROM reservation WHERE (CheckIn <= '$_POST[checkin]' AND CheckOut >= '$_POST[checkout]') OR (CheckIn <= '$_POST[checkin]' AND CheckOut >= '$_POST[checkout]') OR (CheckIn >= '$_POST[checkin]' AND CheckOut <= '$_POST[checkout]'))";
			$result = mysqli_query($conn, $sql);
			
			if (mysqli_affected_rows($conn)>0){

			echo "<table class='center'>
				<tr>
					<th>Room Image</th><th>RoomID</th> <th>Room Type</th> <th>Rate</th><th>Action</th> 
				</tr>";
				
				 $i=1;
				while($row = mysqli_fetch_array($result))
					{
						 if($i%2==0)
							{
							echo '<tr bgcolor="#F4F6F6">';
							}
						else
							{
						echo '<tr bgcolor="#AED6F1">';
						}
					$i++;
					
					//echo "<td>" . "<img src='".$row['Image']. "</td>"; 
					//echo "<td>" . $row['Image'] . "</td>";
					
					echo "<td><img src='./images/roomtype/$_POST[roomtype].jpg' width=211 height=128></td>";
					echo "<td>" . $row['RoomID'] . "</td>";   
					echo "<td>" . $row['RoomType'] . "</td>"; 
					echo "<td>" . $row['Rate'] . "</td>";
					echo "<td ><a href=confbooking.php?id=$row[RoomID]>Book Now</a>";
                              
					} 
				echo "</table>";
			}
			else 
				echo "No $_POST[roomtype] type room available, try different type of room.";
			}
	?>
	</div>

</div>
<br><br><br><br><br><br><br><br><br><br><br><br>
<div style="text-align:center; font-size:12px; background:#abb886; height:50px;">
<footer>
    <p class="titles">Copyright &copy; 2021 Sazia Tanzin<br>
</footer>
</div>

</body></html>