$url = window.location.href;
$dateSuffix = $url.split('?');
$.post('pages/getEnrollments.php?' + $dateSuffix[1], function(data, success, dataType){
	$('#classMenuList').append(data);
});

		$( document ).ready(function() {	
		$('#LiDateChange').show();	
		
		$('li.enrollList').click(function(e){
			$('#WhiteCnt').text(0).hide();
			$('#YellowCnt').text(0).hide();
			$('#PurpleCnt').text(0).hide();
			$('#BlueCnt').text(0).hide();
			$('#GreenCnt').text(0).hide();
			$('#BrownCnt').text(0).hide();
			$('#BlackCnt').text(0).hide();
			$('#TotalCnt').text(0).hide();
			
			$('button#attCheck').removeClass('btn-primary').addClass('btn-secondary').text('Absent');
			$('li.enrollList').children('a').css("background","");
			$(e.target).css("background","yellow");
			$classID = $(e.target).parent().attr('id');
			$("tr.clientList").hide();
			$('tr.clientList').css("background","");
			$("#classMenuTxt").text($(e.target).text());
				
			$('body').attr('classid', $(e.target).parent().attr('classid'));
			$().checkAttendance();
		});

		$('button#attCheck').click(function(e){
		
			$clientID = $(e.target).parents('.clientList').attr('id');
			$rankID = $(e.target).parents('.clientList').attr('rank1');
			$classID = $(e.target).parents('body').attr('classid');
			if ($(e.target).is('.btn-secondary')) {
				$(e.target).removeClass('btn-secondary').addClass('btn-primary').text('Promoted');
				$varscript2 = 'pages/promote.php?clientID=' + $clientID + "&rankID=" + $rankID + "&classID=" + $classID + "&rankChange=0.01";
			} else {
				$(e.target).removeClass('btn-primary').addClass('btn-secondary').text('Absent');
				$varscript2 = 'pages/promote.php?clientID=' + $clientID + "&rankID=" + $rankID + "&classID=" + $classID + "&rankChange=-0.01";
			};
			$.ajax({
				type: 'POST',
				url: $varscript2,
				error: function(data) {
					$('#demo').text('Failure');
				}
			});
		});
		
		$('a#ChangeDate').click(function(e){
			var $actual_link = window.location.href;
			$.post('pages/changeDate.php', {Actual_Link:$actual_link}, function(item){
				window.location.href = item;
			})
		});
	});
		jQuery.fn.extend({
			checkAttendance: function () {
				$classID = $('body').attr('classid');
				$.post('pages/checkAtten.php', {ClassID:$classID}, function(data, status){
					var clientList = data.substring(data.indexOf("<body>") + 6, data.indexOf("</body>"));
					if (clientList != '[null]') {
						var myObject = $.parseJSON(clientList);
						$.each(myObject, function(index, item) {
							var $trString = "tr.clientList#" + item['ClientID'];
							$($trString).show();
							item5 = item['CheckedIn'];
							if (item5 === true) {var item3 = $('#'+item['ClientID']).find('#attCheck').removeClass('btn-secondary').addClass('btn-primary').text('Promoted');}
							if (item['Unpaid']===true){
								var item4 = $('tr.clientList#'+item['ClientID']).css('background-color', 'yellow');
							}
						});
					} else {
						var $trString = "tr.clientList#" + "NoMatches";
						$($trString).show();
					}
				});
				waitingDialog.hide();
			}
		});
		
	
	$(window).on('load', function() {
		$classNum = $('#nextClass').attr('next');
		$("tr.clientList").hide();
		if ($classNum.length) {
			$nextSearch = "li[classid=".concat($classNum, "]");
			$($nextSearch).css("background","yellow");
			$("#classMenuTxt").text($($($nextSearch).html()).text());
			$('body').attr('classid', $classNum);
			$("li.enrollList").filter(".Assistant").hide();
			
			$('#attCheck').text('Absent');
			
			$.post('pages/checkCN.php', function(data, status){
				var clientList = data.substring(data.indexOf("<body>") + 6, data.indexOf("</body>"));
				if (clientList != 'null') {
					var myObject = $.parseJSON(clientList);
					$.each(myObject, function(index, item) {
						// do something with `item` (or `this` is also `item` if you like)
						var item3 = $('#'+item['ClientID']).find('.CNStatus').show();
					});
				}
			});
			$().checkAttendance();
		} else {$("#classMenuTxt").text('No Classes');}
	});