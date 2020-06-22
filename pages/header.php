<nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="http://www.fairwoodmartialarts.com">
				<div>
				<img src="icons/FMA_Logo.jpg" style="width:120px;height:40px;"></div>
			</a>
			<ul class="nav navbar-nav">
				<div class="btn-group button-header">
					<button id="ClassMenu" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" value="Class Menu "><span id="classMenuTxt">Class Menu </span><span class="caret"></span></button>
					<ul class="dropdown-menu scrollable-menu" role="menu" id="classMenuList"></ul>
				</div>
			</ul>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li>
					<li class="active">
						<div class="button-header">
							<button type="button" class="btn btn-info" id = "copyAtten" style="display: none;">Copy Attendance</button>
						</div>
					</li>
				</li>
				<li>
					<li class="active">
						<div class="button-header">
							<button type="button" class="btn btn-warning" id = "checkPaid" style="display: none;">Check Payment</button>
						</div>
					</li>
				</li>
				<li>
					<ul class="nav nav-pills">
						<li class="active"><a id="TotalCnt"  style="background-color:gray;display: none;">0</a></li>
					</ul>
				</li>
				<?php require 'pages/headerMenu.php'; ?>
			</ul>
		</div>
	</div>
</nav>