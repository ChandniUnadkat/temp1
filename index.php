<?php 
   require('main_db_class.php'); 				//Main file with Twitter Bootstrap, Javascript, CSS, HTML, for front end of the system
   $obj = new main_db_class;
   $res = $obj->displayMembers();
?>
<!DOCTYPE html lang="en">
<html>
	<head>
    <title>First Task</title> 
	<meta charset="utf-8"> 						<!--Bootstrap files-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">	
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<script>
			function validateForm1() 			//Validation for submition of the form
				{
					var a = document.forms["myForm"]["file1"].value;
					
					if (a == null || a == "")
					{
						alert("Warning : Can't upload without file attachment !!");
					}
					else 
					{ 
						alert("CSV File Updated in Database successfully !!");
					}
				}
				
			var _validFileExtensions = [".csv"];    //Validation for .csv files only 
			
			function ValidateSingleInput(oInput) 
				{
				 if (oInput.type == "file") {
					var sFileName = oInput.value;
					 if (sFileName.length > 0)
					  {
						var blnValid = false;
						for (var j = 0; j < _validFileExtensions.length; j++)
						 {
							var sCurExtension = _validFileExtensions[j];
							if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) 
							{
								blnValid = true;
								break;
							}
						}
						 
						if (!blnValid)
						 {
							alert("Sorry, " + sFileName + " is invalid. Allowed extensions are: " + _validFileExtensions.join(", ") + " only !");
							oInput.value = "";
							return false;
						}
					}
				}
			}	
			</script>
 	</head>
    <body>
      <div class="container">
	 	 <div class="jumbotron">
		 	<center>
   			 	<h3>Skills Test</h3>
			</center>
	  			<nav class="navbar navbar-inverse">
 		 			<div class="container-fluid">
						<div class="navbar-header">
     						 <a class="navbar-brand" href="index.php">Upload CSV File</a>
								 <form name="myForm" action="index.php" method="post" enctype="multipart/form-data" onSubmit="return validateForm1()" class="form-inline" role="form">
									<div class="form-group">
										<table>
												<tr >
													<td bgcolor="#FFFFFF"><input type="file" name="file1" onChange="ValidateSingleInput(this)" ></td>
													<td><input type="submit" value="Upload File" name="submit" class="btn btn-info" ></td>
												</tr>
										</table>
									 </div>
								</form>
						</div>
  					</div>
				</nav>
				<br />
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Staff Member Name</th>
							<th>Payroll Reference</th>
							<th>Total Hours Worked</th>
							<th>Total Pay</th>
							<th>Work Date</th>  
						</tr>
					</thead>
				 <tbody>
					<?php
					while($row = $res->fetchArray() )				//fetches data from SQLite3 database for front end of system
					{
					?>
						<tr>
							<td><?php echo $row['First_Name'].' '.$row['Family_Name'].' '.$row['Middle_Name'] ?></td>
							<td><?php echo $row['Payroll_Reference'];?></td>
							<td><?php echo $row['Total_Hours_Worked'];?></td>
							<td><?php echo $row['Total_Pay'];?></td>
							<td><?php echo date('dS F Y',$row['Work_Date']);?><td/>
						</tr>
				   <?php        
					}
				   ?>
				</tbody>
			</table>
		</div>
	</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>				<!--Script files-->
  		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="js/bootstrap.min.js">
		</script>
	 </body>
</html>
