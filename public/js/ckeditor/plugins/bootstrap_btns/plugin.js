CKEDITOR.plugins.add( 'bootstrap_btns', {
	// This plugin requires the Widgets System defined in the 'widget' plugin.
	requires: 'widget',

	icons: 'simplebox',

	init: function( editor ) {

		editor.widgets.add( 'simplebox', {
      allowedContent:
  'div(!col-md-10 col-sm-12 mx-auto sizing);' +
'h1(!text-center); h2(!text-center)',

			editables: {
				title: {
					selector: '.text-center',
				},
				content: {
					selector: 'p',
				}
			},

			// Define the template of a new Simple Box widget.
			// The template will be used when creating new instances of the Simple Box widget.
			template:
				'<div class="col-md-10 col-sm-12 mx-auto sizing">' +
					'<h1 class="text-center">Text</h1>' +
					'<p>Text here</p>' +
				'</div>',

			button: 'Create a simple box',
		} );
	}
} );
