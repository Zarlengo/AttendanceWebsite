 $(document).ready(function() {
	 
	$("#dropFrom").append($("#ClassMenu").siblings('ul').html());
	$("#dropTo").append($("#ClassMenu").siblings('ul').html());
	$("ul#dropFrom").find('.classList').removeClass('classList');
	$("ul#dropFrom").find('.Assistant').hide();
	$("ul#dropTo").find('.classList').removeClass('classList');
	$("ul#dropTo").find('.Assistant').hide();
	$('ul').parents('#myNav').click(function(e){
		$classID = $(e.target).parent().attr('classID');
		$className = e.target.innerText;
		$buttonID = '#' + $(e.target).parents('ul').attr('ID') + 'ID';
		$($buttonID).html($className+' <span class="caret"></span>');
		$($buttonID).removeClass('btn-primary').addClass('btn-success').attr('classID', $classID);
		if ($('#dropFromID').hasClass( "btn-success" ) && $('#dropToID').hasClass( "btn-success" )) {$('button#CopyDone').removeClass('disabled');}
	})
  
	$('button#CopyDone').click(function(e){
		waitingDialog.show();
		$fromClassID = $('#dropFromID').attr('classID');
		$toClassID = $('#dropToID').attr('classID');
		if (($fromClassID == null) || ($toClassID == null)){
			$('#ErrorBanner').text("Missing a class").show();
		} else if ($fromClassID == $toClassID) {
			$('#ErrorBanner').text("Classes are the same").show();
		} else {
			$().getFrom();
		}
		$().checkAttendance();
	})
	
	
	jQuery.fn.extend({
		getFrom: function () {
			$clientArray = [];
			$existArray = [];
			$.post('pages/checkAtten.php', {ClassID:$fromClassID}, function(data, status){
				var clientList = data.substring(data.indexOf("<body>") + 6, data.indexOf("</body>"));
				$.post('pages/checkAtten.php', {ClassID:$toClassID}, function(data, status){
					var existingList = data.substring(data.indexOf("<body>") + 6, data.indexOf("</body>"));
					if (existingList != '[null]') {
						var myExistObject = $.parseJSON(existingList);
						$.each(myExistObject, function(index, item){
							$existArray.push(item['ClientID']);
						});
					}
					if (clientList != '[null]') {
						var myObject = $.parseJSON(clientList);
						$.each(myObject, function(index, item) {
							if( jQuery.inArray(item['ClientID'], $existArray) == -1 ) { 
								$clientArray.push(item['ClientID']); }
						});
						if ($clientArray != '[null]') {
							$varscript = 'pages/add2Class.php?clientID=' + $clientArray + "&classID=" + $toClassID;
							$.ajax({
								type: 'POST',
								url: $varscript,
								error: function(data) {
									alert('FAILED');
								},
								success: function(data) {
									$().checkAttendance();
									closeNav();
								}
							});
						} else {alert('!');}
					} else {					
						$('#ErrorBanner').text("No Clients Found in the class").show();
					}
				});
			});
		}
	})
 })