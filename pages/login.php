<!DOCTYPE html>
<html lang="en">
<head>
  <title>Attendance</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
	$( document ).ready(function() {	
		$('.loginButton').click(function(e){
			$pillID = $(e.target).parent('li').attr('id');
			if ($pillID == 'testPill'){
				$secondary = '#livePill';
				$primary = '#testPill';
				$inputValue = 'valueTest';
			} else {
				$secondary = '#testPill';
				$primary = '#livePill';
				$inputValue = 'valueLive';
			}
			$($secondary).removeClass('active');
			$($primary).addClass('active');
			
			$("td").each(function() {
				if ($(this).children('input').length){
					if ($(this).children('input').attr('type') != 'submit'){
						$(this).children('input').attr('value', $(this).children('input').attr($inputValue));
					}
				}
			});
			//alert($variable);
		});
	});
  </script>
</head>
<body style="background-color:lightgrey;">
	<div class="container"><br>
		<ul class="nav nav-pills">
		  <li class="active loginButton" id="testPill"><a href="#">Test</a></li>
		  <li class="loginButton" id="livePill"><a href="#">Live</a></li>
		</ul><br>
		</div><div>
			<form action="../includes/validateLogin.php">
				<table>
					<tr><td>Source Name:</td>	<td><input style="width:250px;" type="text" 	name="sourcename"	value="FairwoodMartialArtsLLC" 			valueTest="FairwoodMartialArtsLLC" 			valueLive="FairwoodMartialArtsLLC"></td></tr>
					<tr><td>Source Key:</td>	<td><input style="width:250px;" type="password" name="password" 	value="beOaPXwRtzsdhi9eqXy3BTC7f9M=" 	valueTest="beOaPXwRtzsdhi9eqXy3BTC7f9M=" 	valueLive="beOaPXwRtzsdhi9eqXy3BTC7f9M="></td></tr>
					<tr><td>Source ID:</td>		<td><input style="width:250px;" type="text" 	name="siteID"	 	value="-99" 							valueTest="-99" 							valueLive="281250"></td></tr>
					<tr><td>User Name:</td>		<td><input style="width:250px;" type="text" 	name="username" 	value="Demoowner13" 					valueTest="Demoowner13" 					valueLive="christopher@zarlengo.net"></td></tr>
					<tr><td>User Password:</td>	<td><input style="width:250px;" type="password" name="userpass" 	value="apitest1234" 					valueTest="apitest1234" 					valueLive="FMArts2015"></td></tr>
					<tr><td>User ID:</td>		<td><input style="width:250px;" type="text" 	name="userid" 		value="-99" 							valueTest="-99" 							valueLive="281250"></td></tr>
					<tr><td></td>				<td><input type="submit" value="Submit"></td></tr>
				</table>
			</form>
	</div>
</body>
</html>