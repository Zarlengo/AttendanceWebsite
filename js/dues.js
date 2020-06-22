$url = window.location.href;
$dateSuffix = $url.split('?');
$.post('pages/getDues.php?' + $dateSuffix[1], function(data, success, dataType){
	$('#classMenuList').append(data);
});
$( document ).ready(function() {

	$('#TotalCnt').show();
	$('button#attCheck').text('Unpaid').prop("disabled",true);
	
	$('li.duesList').click(function(e){
		waitingDialog.show();
		$('#WhiteCnt').text(0).hide();
		$('#YellowCnt').text(0).hide();
		$('#PurpleCnt').text(0).hide();
		$('#BlueCnt').text(0).hide();
		$('#GreenCnt').text(0).hide();
		$('#BrownCnt').text(0).hide();
		$('#BlackCnt').text(0).hide();
		$('#TotalCnt').text(0);
		$('#copyAtten').hide();
		$('button#attCheck').removeClass('btn-primary').addClass('btn-secondary').text('Absent').prop("disabled",true);
		$('li.duesList').children('a').css("background","");
		$("tr.clientList").hide();
		$('tr.clientList').css("background","");
		
		$(e.target).css("background","yellow");
		$classID = $(e.target).parent().attr('id');
		$("#classMenuTxt").text($(e.target).text());
		$('body').attr('id', $classID);
		$('body').attr('classid', $(e.target).parent().attr('classid'));
				
		$array_string = $('#Rank_ID' + $classID).attr('value');
		if($array_string  != null){
			$class_Session = $.parseJSON($array_string);
			$.each($class_Session, function(index, item) {
				var $trString = "tr.clientList[rank1='" + item + "']";
				$($trString).show();
				$($trString).find('button#attCheck').prop("disabled",false);
			});
		}else{alert('Class info not found!');};
		$().checkAttendance();
		alert('Click!');
	});

	$('button#attCheck').click(function(e){
		$clientID = $(e.target).parents('.clientList').attr('id');
		if ($(e.target).is('.btn-secondary')) {
			$(e.target).removeClass('btn-secondary').addClass('btn-primary').text('Paid');
			$varscript = 'pages/add2Class.php?clientID=' + $clientID + "&classID=" + $classID + "&classChange=add";
			$().addCount($rankID);
		} else {
			$(e.target).removeClass('btn-primary').addClass('btn-secondary').text('Paid');
			$varscript = 'pages/add2Class.php?clientID=' + $clientID + "&classID=" + $classID + "&classChange=remove";
			$().removeCount($rankID);
		};
		$.ajax({
			type: 'POST',
			url: $varscript,
			error: function(data) {
				alert('FAILED');
				$('#demo').text('Failure');
			},
			success: function(data) {}
		});
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
						// do something with `item` (or `this` is also `item` if you like)
						var item2 = item['ClientID'];
						var item3 = $('#'+item2+'.clientList').find('#attCheck').removeClass('btn-secondary').addClass('btn-primary');
						if (item['Unpaid']===true){
							var item4 = $('tr#'+item2+'.clientList').find('#attCheck').text('Paid');
						}
						var item5 = $('#'+item2+'.clientList').attr('rank1');
						$TotalValue = parseInt($('#TotalCnt').text()) + 1;
						$('#TotalCnt').text($TotalValue);
						$().rankCounter(item5, 1);
					});
				}
			});
		waitingDialog.hide();
		},
		
		addCount: function ($rankID) {
			$TotalValue = parseInt($('#TotalCnt').text()) + 1;
			$('#TotalCnt').text($TotalValue);
			$().rankCounter($rankID, 1);
		},
		
		removeCount: function ($rankID) {
			$TotalValue = parseInt($('#TotalCnt').text()) - 1;
			$('#TotalCnt').text($TotalValue);
			$().rankCounter($rankID, -1);
		},
		rankCounter: function ($rankID, $changeDir) {
			$cellColor = '#WhiteCnt';
			
			if (($rankID == '1.03')||($rankID == '1.04')||($rankID == '1.05')){
				$cellColor = '#YellowCnt';
			}
			if (($rankID == '1.06')||($rankID == '1.07')||($rankID == '1.08')){
				$cellColor = '#PurpleCnt';
			}
			if (($rankID == '1.09')||($rankID == '1.10')||($rankID == '1.11')){
				$cellColor = '#BlueCnt';
			}
			if (($rankID == '1.12')||($rankID == '1.13')||($rankID == '1.14')||($rankID == '1.15')||($rankID == '1.16')||($rankID == '2.03')||($rankID == '2.04')||($rankID == '2.05')){
				$cellColor = '#GreenCnt';
			}
			if (($rankID == '1.17')||($rankID == '1.18')||($rankID == '1.19')||($rankID == '1.20')||($rankID == '1.21')||($rankID == '2.06')||($rankID == '2.07')||($rankID == '2.08')){
				$cellColor = '#BrownCnt';
			}
			if (($rankID == '1.22')||($rankID == '1.23')||($rankID == '2.09')||($rankID == '2.10')||($rankID == '2.11')||($rankID == '2.12')||($rankID == '2.13')||($rankID == '2.14')||($rankID == '2.15')||($rankID == '2.16')||($rankID == '2.17')||($rankID == '2.18')){
				$cellColor = '#BlackCnt';
			}
			$cntValue = parseInt($($cellColor).text()) + $changeDir;
			$($cellColor).text($cntValue).show();
		}
	});

/*	

$( window ).load(function() {
	$classNum = $('#nextClass').attr('next');
	$("tr.clientList").hide();
	$('button#attCheck').removeClass('btn-primary').addClass('btn-secondary').text('Absent').prop("disabled",true);
	if ($classNum.length) {
		$nextClass = "#".concat($classNum);
		$($nextClass).children('a').css("background","yellow");
		$("#classMenuTxt").text($($nextClass).text());
		
		$classTime = $($nextClass).attr('classtime');
		$('li.Assistant').each(function( index ) {
			if ($classTime == $( this ).attr('classtime')){
				$instructID = $( this ).attr('id');
				$('body').attr('instructid', $instructID);
				$('body').attr('instructclassid', $( this ).attr('classid'));
			}
		});
		$('li.Testing').each(function( index ) {
			if ($classTime == $( this ).attr('classtime')){
				$testingID = $( this ).attr('id');
				$('body').attr('testid', $testingID);
				$('body').attr('testclassid', $( this ).attr('classid'));
			}
		});
		if ($('body').attr('instructid') != null){					
			$instruct_string = $('#Rank_ID' + $instructID).attr('value');
			if($instruct_string  != null){
				$instruct_Session = $.parseJSON($instruct_string);
				$.each($instruct_Session, function(index, item) {
					var $trString = "tr.clientList[rank1='" + item + "']";
					$($trString).show();
					$($trString).find('#instructCheck').show();
				});
			}else{alert('Class info not found!');};
		};
		if ($('body').attr('testid') != null){					
			$testing_string = $('#Rank_ID' + $testingID).attr('value');
			if($testing_string  != null){
				$testing_Session = $.parseJSON($testing_string);
				$.each($testing_Session, function(index, item) {
					var $trString = "tr.clientList[rank1='" + item + "']";
					$($trString).show();
				});
			}else{alert('Class info not found!');};
		};
		
		
		
		
		$array_string = $('#Rank_ID' + $classNum).attr('value');
		if($array_string  != null){
			$class_Session = $.parseJSON($array_string);
			$.each($class_Session, function(index, item) {
				var $trString = "tr.clientList[rank1='" + item + "']";
				$($trString).show();
				$($trString).find('button#attCheck').prop("disabled",false);
			});
		}else{alert('Class info not found!');};
		$('body').attr('id', $classNum);
		$('body').attr('classid', $('#nextClass').attr('nextid'));
		$("li.duesList").filter(".Assistant").hide();
		$("li.duesList").filter(".Testing").hide();
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
	} else {
		$("#classMenuTxt").text('No Classes');
		waitingDialog.hide();
	}	
});
	*/	