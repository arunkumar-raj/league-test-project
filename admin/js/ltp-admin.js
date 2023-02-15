jQuery(document).ready(function ($) {

	// Set all variables to be used in scope
	var frame,
		leageBox = $('#league-container'), 
		addImgLink = leageBox.find('.upload-custom-img'),
		delImgLink = leageBox.find('.delete-custom-img'),
		imgContainer = leageBox.find('.custom-img-container'),
		imgIdInput = leageBox.find('.league-logo-id');

	// ADD IMAGE LINK
	addImgLink.on('click', function (event) {
		event.preventDefault();
		if (frame) {
			frame.open();
			return;
		}
		frame = wp.media({
			title: 'Select or Upload Media',
			button: {
				text: 'Use this media'
			},
			multiple: false 
		});
		frame.on('select', function () {
			var attachment = frame.state().get('selection').first().toJSON();
			imgContainer.append('<img src="' + attachment.url + '" alt="" style="max-height:100px;"/>');
			imgIdInput.val(attachment.id);
			addImgLink.addClass('hidden');
			delImgLink.removeClass('hidden');
		});
		frame.open();
	});

	// DELETE IMAGE LINK
	delImgLink.on('click', function (event) {
		event.preventDefault();
		imgContainer.html('');
		addImgLink.removeClass('hidden');
		delImgLink.addClass('hidden');
		imgIdInput.val('');

	});
	
});