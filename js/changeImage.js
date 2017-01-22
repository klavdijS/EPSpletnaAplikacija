$(document).ready(function() {	
	$('#uploadImage0').click(function() { 
		$(this).parent().closest('div').hide();
		$('#upload0').show();

		return false;
	});

	$('#uploadImage1').click(function() { 
		$(this).parent().closest('div').hide();
		$('#upload1').show();

		return false;
	});

	$('#uploadImage2').click(function() { 
		$(this).parent().closest('div').hide();
		$('#upload2').show();

		return false;
	});
});