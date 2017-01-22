$(document).ready(function() {	
	$('.glyphicon-thumbs-up').mouseover(function() { 
		$(this).css('color', 'blue');
	});

	$('.glyphicon-thumbs-up').mouseout(function() { 
		$(this).css('color', 'black');
	});

	$('.glyphicon-thumbs-up').click(function() { 
		var id = $(this).attr('id');
		console.log(id);
		$.post ("vote", {vote: 1, id: id}, function(data) { $("votes").html(data); });
		return false;
	});

	$('.glyphicon-thumbs-down').mouseover(function() { 
		$(this).css('color', 'red');
	});

	$('.glyphicon-thumbs-down').mouseout(function() { 
		$(this).css('color', 'black');
	});

	$('.glyphicon-thumbs-down').click(function() { 
		var id = $(this).attr('id');
		console.log(id);
		$.post ("vote", {vote: -1, id: id}, function(data) { $("votes").html(data); });
		return false;
	});
});