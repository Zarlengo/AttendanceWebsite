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
					</ol>
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