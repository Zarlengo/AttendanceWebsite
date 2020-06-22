$( document ).ready(function() {	
	$('#ClassMenu').hide();

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
	
	$('li').parent('ul#class_type').on('click', function (e) {
		$clientID = $(e.target).parents('.clientList').attr('id');
		$menuTarget = $(e.target).parent('li').attr('id');
		$buttonText = $(e.target).text();
		$beltText = '<img style="vertical-align:middle" src="belts/W.png">';
		$propValue = true;
		$bkColor = '#337ab7';
		$txtColor = '#fff';
		$bkHideColor = '#337ab7';
		$txtHideColor = '#fff';
		if ($menuTarget == 'Children_Menu'){
			$rank = '1.00';
			$propValue = false;
		} else if ($menuTarget == 'Adult_Menu'){
			$rank = '2.00';
			$propValue = false;
		} else {
			$bkColor = 'grey';
			$txtColor = '#000';
			if ($menuTarget == 'Hidden_Menu'){
				$rank = '';
				$beltText = '';
				$bkHideColor = 'grey';
				$txtHideColor = '#000';
			}  else {
				$buttonText = 'Little Ninjas';
				$rank = '0.00';
			}
		}
		$(e.target).parents('.clientList').find("#RankImg").html($beltText);
		$htmlSearch = "div#".concat($menuTarget);
		$htmlText = $($htmlSearch).html();
		$(e.target).parents(".clientList").find("#dLabel").siblings('ul').eq(0).replaceWith($htmlText);
		$(e.target).parents(".clientList").find("#dLabel").prop("disabled",$propValue).css({'background-color': $bkColor, 'color': $txtColor});
		$(e.target).parents('ul#class_type').siblings('#cLabel').html($(e.target).text() + "<span class='caret'></span>").css({'background-color': $bkHideColor, 'color': $txtHideColor});
		
		$varscript = 'pages/hideShow.php?clientID=' + $clientID + "&rank=" + $rank + "&showID=" + 'ignore';
		$.ajax({
			type: 'POST',
			url: $varscript,
			error: function(data) {alert('Failure');}
		});
	})
	$('button.inactiveButton').on('click', function (e) {
		$clientID = $(e.target).parents('.clientList').attr('id');
		if ($(e.target).hasClass('btn-secondary')) {
			$(e.target).removeClass('btn-secondary').addClass('btn-primary').text('Active');
			$(e.target).siblings('#cLabel').removeClass('disabled')
			$(e.target).siblings('#dLabel').removeClass('disabled')
			$showID = 'show';
		} else {
			$(e.target).removeClass('btn-primary').addClass('btn-secondary').text('Inactive');
			$(e.target).siblings('#cLabel').addClass('disabled')
			$(e.target).siblings('#dLabel').addClass('disabled')
			$showID = 'hide';
		}
		$varscript = 'pages/hideShow.php?clientID=' + $clientID + "&showID=" + $showID;
		$.ajax({
			type: 'POST',
			url: $varscript,
			error: function(data) {alert('Failure');}
		});
	})
	$('td').on('click', 'ul#belt_change', function (e) {
		$rankID = $(e.target).parents('li').attr('id');
		$rankHtml = $(e.target).parents('li').children('a').html();
		var $rankTxt = $rankHtml.substring(0, $rankHtml.indexOf(">")+1);
		$(e.target).parents('.clientList').find("#RankImg").html($rankTxt);
		$clientID = $(e.target).parents('.clientList').attr('id');
		
		$varscript = 'pages/hideShow.php?clientID=' + $clientID + "&rank=" + $rankID + "&showID=" + 'ignore';
						
		$.ajax({
			type: 'POST',
			url: $varscript,
			error: function(data) {alert('Failure');}
		});
	})	
	
	/*$('a').parents('ul#belt_change').on('click', function (e) {
		$rankID = $(e.target).parents('li').attr('id');
		$rankHtml = $(e.target).parents('li').children('a').html();
		alert($rankHtml);	
		var $rankTxt = $rankHtml.substring(0, $rankHtml.indexOf(">")+1);
		$(e.target).parents('.clientList').find("#RankImg").html($rankTxt);
		$clientID = $(e.target).parents('.clientList').attr('id');
		
		$varscript = 'pages/hideShow.php?clientID=' + $clientID + "&rank=" + $rankID;
					
		$.ajax({
			type: 'POST',
			url: $varscript,
			error: function(data) {alert('Failure');}
		});
	})	*/
});
$(window).on('load', function() {
	waitingDialog.hide();
});