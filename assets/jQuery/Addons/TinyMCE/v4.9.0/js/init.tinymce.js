// Main Textbox
tinymce.init({
	selector: '.tinymce',
//	height: 500,
	theme: 'modern',
	skin: 'charcoal',
	plugins: [
		'autolink lists link image print preview hr anchor pagebreak',
		'searchreplace wordcount visualblocks visualchars code',
		'insertdatetime media nonbreaking save table contextmenu directionality',
		'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
	],
	toolbar1: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
	toolbar2: 'image link media | forecolor backcolor emoticons | print | preview | codesample',
	image_advtab: true,
	templates: [
		{ title: 'Test template 1', content: 'Test 1' },
		{ title: 'Test template 2', content: 'Test 2' }
	],
	content_css: [
		'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
		'//www.tinymce.com/css/codepen.min.css'
	],
	setup: function(editor){
		editor.on('change',function(){
			editor.save();
		});
	}
});
// Readonly Textbox
tinymce.init({
	selector:'.readonly',
	theme: 'modern',
	skin: 'charcoal', // options: charcoal, modern
	toolbar: false,
	readonly: 1,
	menubar: false,
	statusbar: false
});
// Mail Textbox
tinymce.init({
	selector:'.mail',
	theme: 'modern',
	skin: 'charcoal',
	toolbar: false,
	menubar: false,
	statusbar: false
});

tinymce.init({
	selector:'.mce_standard_textbox', // textarea name || can also use div names in place of selector
	theme:'modern',
	skin:'charcoal', // options: charcoal, modern
	toolbar:false,
	branding:false,
	setup: function(editor){
		editor.on('change',function(){
			editor.save();
		});
	}
});