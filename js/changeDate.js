$(function() {
	$( "#startDate" ).datepicker({
		altField: "#startDate",
		altFormat: "yy-mm-dd"
	});
	$( "#endDate" ).datepicker({
		altField: "#endDate",
		altFormat: "yy-mm-dd"
	});
});
	/* Open when someone clicks on the span element */
function openDateNav() {
    document.getElementById("myDateNav").style.width = "100%";
}

/* Close when someone clicks on the "x" symbol inside the overlay */
function closeDateNav() {
    document.getElementById("myDateNav").style.width = "0%";
}



 $(document).ready(function() {
	$('button#dateDone').click(function(e){
		$newStart = "?NewStart=".concat($('#startDate').val());			
		$newEnd = $('#endDate').val();
		if (typeof $newEnd !== 'undefined'){
			$newEnd = "&NewEnd=".concat($('#endDate').val());
		} else{
			$newEnd = "&NewEnd=".concat($('#startDate').val());
		}
		$actual_link = window.location.pathname;
		$final_link = $actual_link + $newStart + $newEnd;
		window.location = $final_link;
	})
	
	
	$('input#startDate').change(function(e){
		$newEnd = $('#endDate').val();
		if ($newEnd == ''){
			$newStart = $('#startDate').val();	
			$('#endDate').val($newStart);
		}
	})
})
  