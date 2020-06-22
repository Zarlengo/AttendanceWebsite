$url = window.location.href;
$dateSuffix = $url.split('?');
$.post('pages/getEnrollments.php?' + $dateSuffix[1], function(data, success, dataType){
	$('#classMenuList').append(data);
});

$( document ).ready(function() {
	$('.nummonths').hide();
	$('.numclasses').hide();
	$('.promotedate').hide();	
		$('#LiDateChange').show();		
				
	$('button#add2Test').click(function(e){
		$clientID = $(e.target).parents('.readyList').attr('id');
		$buttonClass = $(e.target).attr("class");
		$classID = $('body').attr('classid');
		if ($buttonClass.indexOf('btn-primary') > -1){
			$(e.target).removeClass('btn-primary').addClass('btn-danger');
			$(e.target).text('Removed');
			$varscript = 'pages/add2Class.php?clientID=' + $clientID+'&classID='+$classID + "&classChange=remove";
		} else {
			$(e.target).removeClass('btn-secondary btn-success btn-danger').addClass('btn-primary');
			$(e.target).text('Enrolled');
			$varscript = 'pages/add2Class.php?clientID=' + $clientID+'&classID='+$classID + "&classChange=add";
		}
		$.ajax({
			type: 'POST',
			url: $varscript,
			error: function(data) {
				alert('Failed adding/removing student');
			},
			success: function(data){
			}
		});
	});
	
	$('li.enrollList').click(function(e){
		waitingDialog.show();
		$('body').removeAttr('testid');
		$('body').removeAttr('testclassid');
		$('li.enrollList').children('a').css("background","");
		$(e.target).css("background","yellow");
		$("tr.readyList").hide();
		$testID = $(e.target).parent().attr('testid');
		$classID = $(e.target).parent().attr('classid');
		$('body').attr('classid', $classID);
		$('body').attr('testID', $(e.target).parent().attr('testID'));
		$('button#add2Test').removeClass('btn-primary').removeClass('btn-success').addClass('btn-secondary').text('Add to List').prop("disabled",false);
		
		$array_string = $('#Class_Description_ID' + $testID).attr('value');
		
		if($array_string != null){
			$class_Session = $.parseJSON($array_string);
			$.each($class_Session, function(index, item) {
				var $trString = "tr.readyList[rank1='" + item + "']";
				$($trString).show();
			});
			$().checkAttendance();
		} else{
			waitingDialog.hide();
			alert('Class Details not found: Classes_Variable');}
	});

});

jQuery.fn.extend({
	getPromotion: function (clientID) {
		$.post('pages/getClientVisits.php', {ClientID:clientID, TestMode:'True'}, function(data, status){
			var classSummary = data.substring(data.indexOf("<body>") + 6, data.indexOf("</body>"));
			if (classSummary != '[null]') {
				result = classSummary.split('-');
				
				locID = '#'+clientID;
				
				$(locID).find('.promotedate').text(result[0]);
				$(locID).find('.numclasses').prepend(result[1]);
				$(locID).find('.nummonths').prepend(result[2]);

				if (result[2] != '(No Data)') {
					numOfClasses = $(locID).find('.numclasses').text().split('/');
					timeInRank = $(locID).find('.nummonths').text().split('/');
					if (parseInt(timeInRank[0]) > 0 ) {
						$classPerMo = (parseInt(numOfClasses[0])/parseInt(timeInRank[0])).toFixed(1);
						$(locID).find('.numclasses').append(' ('+$classPerMo+')');
					}
					if ((parseInt(timeInRank[0]) >= parseInt(timeInRank[1])) && (parseInt(numOfClasses[0]) >= parseInt(numOfClasses[1]))){
						$(locID).find('#add2Test').removeClass('btn-secondary').addClass('btn-success');
						$(locID).find('#add2Test').text('Ready');
				}}
			}
		});
	},
	checkAttendance: function () {
		$classID = $('body').attr('classid');
		if ($classID != null){
			$.post('pages/checkAtten.php', {ClassID:$classID}, function(data, status){
				var testList = data.substring(data.indexOf("<body>") + 6, data.indexOf("</body>"));
				if (testList != '[null]') {
					var myObject = $.parseJSON(testList);
					$.each(myObject, function(index, item) {
						// do something with `item` (or `this` is also `item` if you like)
						var item2 = item['ClientID'];
						var item4 = item['CheckedIn'];
						if (item4 == true) {
							var item3 = $('#'+item2+'.readyList').find('#add2Test').removeClass('btn-secondary').addClass('btn-success').text('Promoted').prop("disabled",true);
						} else {
							var item3 = $('#'+item2+'.readyList').find('#add2Test').removeClass('btn-secondary').addClass('btn-primary').text('Testing');
						}
						if (item['Unpaid']===true){
							var item3 = $('#'+item2+'.readyList').find('#add2Test').prepend("<span style='color:red'>UNPAID </span>");
						}
					});
				}
			});
		}
	waitingDialog.hide();
	}
});

$(window).on('load', function() {
	$("tr.readyList").hide();
	$("#NoMatches").css("display", $("#NoMatches").css("display") === 'none' ? '' : 'none');
			waitingDialog.hide();	
});