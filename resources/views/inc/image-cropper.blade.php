<!-- uelmar's -->

<!-- semantic modal -->
<div class="ui modal" id="crop-modal">
  <div class="header">Crop Image</div>
  <div class="content">
    <div style="position: relative;" class="ccc">
        <div class="cropper-container"></div>
  	</div>
  </div>
  <div class="actions">
    <button type="button" class="btn btn-primary save">Save changes</button>
    <button type="button" class="btn deny btn-secondary" data-dismiss="modal">Close</button>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){

	// locally accessable variables	
	var basic;
	var result_image;
	var current_elm;

	$('.crop-control').each(function(){
		var $this = $(this);

		var input_name = $this.find('input').prop('name');
		// create new hidden input with the name of the file input
		$this.append('<input type="hidden" name="'+input_name+'"/>');
		// rename original file so that the new file input will be passed to server with intended name
		$this.find('input[type=file]').prop('name','old_'+input_name);

		// set event for file input change detection and processing
		setInputEvent($this);

		
	});

	function setInputEvent(elm){
		elm.find('[type=file]').change(function(evt){
			current_elm = elm;
			var tgt = evt.target || window.event.srcElement,
			    files = tgt.files;

			// FileReader support
			if (FileReader && files && files.length) {

				$('#crop-modal').modal('show');

				// refresh cropper container
				$('#crop-modal .ccc').html('<div class="cropper-container"></div>');

				// initialize new cropie
				basic = $('#crop-modal .cropper-container').croppie({
				  viewport: {
				      width: 200,
				      height: 200,
				      type: 'square'
				  },
				  boundary: { width: 300, height: 300 },
				});

				current_elm = elm;
			    var fr = new FileReader();
			    fr.onload = function () {
			    	result_image = fr.result;
			    }
			    fr.readAsDataURL(files[0]);
			}
		});
	}

	// crop modal show hide events
	$('#crop-modal.ui.modal').modal({
	    onVisible: function () {
	      basic.croppie('bind', {
	          url: result_image,
	          // points: [77,469,280,739]
	      });

			var input_container = current_elm.find('.input-container').html();

			current_elm.find('[type=file]').remove();
			current_elm.find('.input-container').html(input_container);

			setInputEvent(current_elm);
	    },
	    onApprove: function () {
	      console.log('approved');
	    }
	  });

	$('#crop-modal .save').click(function(){
		$('#crop-modal').modal('hide');
		basic.croppie('result', {
				type : 'rawcanvas',
				format : 'jpeg',
				quality: '1'
			}).then(function(canvas){
				current_elm.find('img').prop('src',canvas.toDataURL());
				current_elm.find('[type=hidden]').val(canvas.toDataURL());
			});
	});
});
</script>