jQuery.fn.extend({
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