
<div id="errorBanner" class="alert alert-danger" align="center" style="display: none;">
	<div>ERROR:&nbsp;<span id='errorMessage'>Error message</span></div>
</div>


<div id="myNav" class="overlay">
	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	<div class="overlay-content">
		<div id="ErrorBanner" class="alert alert-danger" align="center" style="display: none;">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<a id="failButton" class="btn btn-danger">Failure</a>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-1"></div>
				<div class="col-sm-5" style="text-align:right;">
					<div style="color: white;">Copy From:</div>
					<div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" id="dropFromID" data-toggle="dropdown">Copy From:
						<span class="caret"></span></button>
						<ul class="dropdown-menu dropdown-menu-right" id="dropFrom"></ul>
					</div>
				</div>
				<div class="col-sm-5" style="text-align:left;">
					<div style="color: white;">Copy To:</div>
					<div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" id="dropToID" data-toggle="dropdown">Copy To:
						<span class="caret"></span></button>
						<ul class="dropdown-menu" id="dropTo"></ul>
					</div>
				</div>
				<div class="col-sm-1"></div>
			</div>
			<br>
			<div class="container-fluid">
				<div class="col-sm-12" style="text-align:center;">
					<button id='CopyDone' class="btn btn-secondary disabled">Copy Attendance</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="myDateNav" class="overlay">
	<a href="javascript:void(0)" class="closebtn" onclick="closeDateNav()">&times;</a>
	<div class="overlay-content">
		<p style="color:white">Start Date: <input type="text" id="startDate" style="color:black"></p>
		<p style="color:white">End Date: <input type="text" id="endDate" style="color:black"></p>
		<button id="dateDone">Done</button>
	</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row">
					<div class="col-sm-9"><h4 class="inline" id="myModalLabel">Client Name</h4></div>
					<div class="col-sm-2"><button class="btn btn-primary" id="classTeach">Classes</button></div>
					<div class="col-sm-1"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
				</div>
			</div>
			<div class="modal-body" id="myModalText">
				TEXT
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>