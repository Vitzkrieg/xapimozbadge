
var myURL = document.URL;

// Get the editor instance that you want to interact with.
var editor = undefined;

$( document ).ready( function() {

	// The instanceReady event is fired, when an instance of CKEditor has finished
	// its initialization.
	CKEDITOR.on( 'instanceReady', function( ev ) {
		// Show the editor name and description in the browser status bar.
		if(ev.editor.name != "comment"){
			editor = ev.editor;

			//listen to click events of ckeditor buttons
			var buttons = jQuery('#cke_' + ev.editor.name + ' .cke_button');
			buttons.on('click', trackButtonClick);
		}

	});

	//create instance of CKEditor
	$( 'textarea.ckeditor' ).ckeditor();
} );


function trackButtonClick(event){
	if (!editor) return;

	var buttonTitle = jQuery(this).attr('title');

	//track editor button clicks
	passStatementArgs({
					name: username,
					email: email,
					verb: ADL.verbs.interacted,
					object: {
								"id": myURL + "#ckeditor.button." + buttonTitle,
								'definition': {
											'name' : buttonTitle,
											'description' : "CKEditor " + buttonTitle + " button",
											'type' : 'http://adlnet.gov/expapi/activities/interaction'
											},
								'objectType' : 'Activity'
							}
					});
}


function validateContents(contents){

	var pattern = /^<([a-z]+)([^<]+)*(?:>(.*)<\/\1>|\s+\/>)$/;

}


function GetContents() {
	if (!editor) return;

	var contents = editor.getData();

	passStatementArgs( {
					name: username,
					email: email,
					verb: ADL.verbs.answered,
					result: {
						response: '"' + contents + '"'
					},
					object: {
								"id": myURL,
								'definition': {
											'name' : "CKEditor Test Page",
											'description' : "CKEditor content",
											'type' : 'http://adlnet.gov/expapi/activities/interaction'
											},
								'objectType' : 'Activity'
							}
					});
}

function passStatementArgs(data){

	jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		data: { data:data }
		}).fail(function( jqXHR, textStatus, errorThrown ){
			alert("fail: " + jqXHR.responseText  + " " + textStatus + " " + errorThrown);
		}).success(function( data, textStatus, jqXHR ){
			var contents = editor.getData();
			contents += "<p>Data: " + data + "</p>";
			$("#displayoutput").contents().find('body').html(contents);
		});
}