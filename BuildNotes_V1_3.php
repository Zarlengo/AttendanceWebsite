<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Build Notes</title>
		<? require_once 'pages/meta.php'; ?>
		<? require_once 'pages/Run_Script.php'; ?>
	</head>
	<body>
		<?php require 'pages/commonPHP.php'; ?>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<ol>Changes:
						<li type="1">Clean up header bar/menu
						<li type="1">Consolidate add & remove to/from class
						<li type="1">Fix Date check to correct day timeframe - TimeZone/Daylight
						<li type="1">Have copy attendance button show for specific classes
						<li type="1">Add unpaid on testing day
						<li type="1">Add teaching summary to test report
						<li type="1">Save client's rank if inactive
					</ol>
					<br>
					<ol>TO DO LIST
						<li type="1">Move button changes to successful .post
						<li type="1">Add error banner to capture code issues for user
						<li type="1">Add console.log output for other error types
						<li type="1">clean up all pages
						<li type="1">check enrollment for testing report
						<li type="1">Log In/Out option - Test Mode option button
						<li type="1">Clean up ready.js - header buttons
						<li type="1">Clean up classVisits.js
						<li type="1">Clean up allClients.js
						<li type="1">Fix auto select current/next class to show on index.php
						<li type="1">Cross Browser/Device cleanup
						<li type="1" style="color:red">!!! Reduce Call's to MB for client rank report
						<li type="1">Add shortcut in the menu for CN page
					</ol><br>
					<ol>V2.0 LIST
						<li type="1">Pull parameters off of code and pull from server?
						<li type="1">Clean up all service items
						<li type="1">Add edit option to server SQL
					</ol><br>Folder Structure:
					<ul>
						<li type="disc">addClient.php
						<li type="disc">index.php
						<li type="disc">ready.php
						<li type="disc">test.php
						<li type="disc">visits.php
						<li type="square">\AddRanks\
						<ul>
							<li type="disc">addRanks.php
							<li type="disc">clientList.php
							<li type="disc">FMAList.php
							<li type="disc">getActivation.php
						</ul>
						<li type="square">\belts\
							<ul>
							</ul>
						<li type="square">\css\
							<ul>
								<li type="disc">custom.css
								<li type="disc">copy_overlay.css
								<li type="disc">overlay.css
								<li type="disc">overlay.js
							</ul>
						<li type="square">\icons\
							<ul>
							</ul>
						<li type="square">\includes\
							<ul>
								<li type="disc">Belt_List.php
								<li type="disc">BeltRanks.php
								<li type="disc">Classes_Variable.php
								<li type="disc">classServices.php
								<li type="disc">clientServices.php
								<li type="disc">Login.php
								<li type="disc">mbApi.php
							</ul>
						<li type="square">\js\
							<ul>
								<li type="disc">changeDate.js
								<li type="disc">copy_overlay.js
								<li type="disc">copyAttendance.js
								<li type="disc">allClients.js
								<li type="disc">classVisits.js
								<li type="disc">enrollments.js
								<li type="disc">includes.js
								<li type="disc">ready.js
							</ul>
						<li type="square">\pages\
							<ul>
								<li type="disc">add2Class.php
								<li type="disc">changeDate.php
								<li type="disc">checkAtten.php
								<li type="disc">checkCN.php
								<li type="disc">copyAttendance.php
								<li type="disc">dateCheck.php
								<li type="disc">footer.php
								<li type="disc">getAllClients.php
								<li type="disc">getClasses.php
								<li type="disc">getClients.php
								<li type="disc">getClientVisits.php
								<li type="disc">getEnrollments.php
								<li type="disc">getReadyClients.php
								<li type="disc">headerLeft.php
								<li type="disc">headerMenu.php
								<li type="disc">headerRight.php
								<li type="disc">hideShow.php
								<li type="disc">Load_Script.php
								<li type="disc">promote.php
								<li type="disc">removeFromClass.php
								<li type="disc">Run_Script.php
							</ul>
					</ul>
				</div>
			</div>
		</div>
		<script>
			$('#checkPaid').hide();
			$('#ClassMenu').hide();
			$('#TotalCnt').hide();
			waitingDialog.hide();
		</script>
	</body>
</html>