	$( document ).ready(function() {		
			
		$('#ClassMenu').hide();
		
		$('button#attCheck').click(function(e){
			waitingDialog.show();
			$('#classTeach').text('Classes').removeClass('btn-secondary').addClass('btn-primary');
			$clientID = $(e.target).parents('.clientList').attr('id');
			$clientFirst = $('#'+$clientID).children('td:nth-child(2)').text();			
			$clientLast = $('#'+$clientID).children('td:nth-child(3)').text();
			
			$.post('pages/getClientVisits.php', {ClientID:$clientID}, function(data, status){
					var classSummary = data.substring(data.indexOf("<body>") + 6, data.indexOf("</body>"));
					if (classSummary != '[null]') {
						//$('#myModal').on('shown.bs.modal', function () {
						   $('#myModal').find('.modal-body').css({
								  width:'auto', //probably not needed
								  height:'auto', //probably not needed 
								  'max-height':'100%',
								  'max-width':'100%'
						   });
						$('#myModalLabel').text($clientFirst+' '+$clientLast);
						$('#myModalText').html(classSummary);
						$('#myModalText').find('td.teaches').hide();
						$('#myModalText').find('th.teaches').hide();
						$('#myModal').modal();
					}
				});
			waitingDialog.hide();
		});
		$('button#classTeach').click(function(e){
			if($(e.target).text() == 'Classes'){
				$('#myModalText').find('td.classes').hide();
				$('#myModalText').find('th.classes').hide();
				$('#myModalText').find('td.teaches').show();
				$('#myModalText').find('th.teaches').show();
				$('#classTeach').text('Teaches').removeClass('btn-primary').addClass('btn-secondary');
			}else{
				$('#myModalText').find('td.teaches').hide();
				$('#myModalText').find('th.teaches').hide();
				$('#myModalText').find('td.classes').show();
				$('#myModalText').find('th.classes').show();
				$('#classTeach').text('Classes').removeClass('btn-secondary').addClass('btn-primary');
			}
			
		});
		
		
		
		
	});
		jQuery.fn.extend({
			
		});


	$( window ).load(function() {
		$("tr#NoMatches").hide();
		$("button#attCheck").text('Check Attendance');
		waitingDialog.hide();


	});