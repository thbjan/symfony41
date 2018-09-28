
$( ".complete-todo" ).on( "click", function() {
	$id = $(this).parent().index();
	console.log('complete - id: ' + $id);

	fetch('/todo/complete/'+$id, {
		method: 'POST',
		id: $id
	}).then(function(response) {
		if(response.ok) {
			console.log('fetch OK');
			//
			// Alternate between adding and removing strike-tag on the todo-title here...
			//
		} else {
			console.log('fetch ERROR');
		}
	})
});


$( ".delete-todo" ).on( "click", function() {
	$id = $(this).parent().index();
	console.log('delete - id: ' + $id);

	fetch('/todo/delete/'+$id, {
		// method: 'DELETE'  
		method: 'POST'
	}).then(function(response) {
		if(response.ok) {
			// Ændre to-do udseende 
			console.log('fetch OK');
		} else {
			console.log('fetch ERROR');
		}
		res => window.location.reload()
	})
});
