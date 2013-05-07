<div id="content">
	<h1><?php echo $h1 ?></h1>
	<div class="big-table" data-toggle="buttons-checkbox">
	<?php foreach ($features as $feature) { ?>
		<button data-feature="<?php echo $feature['feature_id'] ?>" type="button" class="btn"><?php echo $feature['feature'] ?></button>
	<?php } ?>
	</div>
	<div id="message"></div>
	<div class="form">
		<input id="voter" type="text" placeholder="Your name..."/>
		<input id="name" value="<?php echo $name ?>" type="hidden"/>
		<button id="btn-save" class="btn btn-primary">Save</button>
	</div>
</div>
<script type="text/javascript">
$('#btn-save').click(function(){
	var voter = $('#voter').val();
	var name = ($('#name').val()) ? $('#name').val() : $('#voter').val();
	var features = $('.btn.active');
	var btn = $(this);
	if (5 <= $('.btn.active').length && features.length <= 6 && voter) {
		if (!btn.hasClass('disabled')) {
			btn.text('Loading...').addClass('disabled');
			var join = new Array();
			features.each(function(i){
				join[i] = $(this).data('feature');
			});
			$.ajax({
				url: location,
				type: 'post',
				dataType: 'json',
				data: 'name=' + name + '&voter=' + voter + '&features=' + join.join(','), 
				success: function(json) {
					if (json['error']) {
						$('#message').html('<div class="alert alert-error"><b>Error!</b> ' + json['error'] + '</div>');
						btn.text('Save').removeClass('disabled');
					}
					if (json['success']) {
						location = '<?php echo $base ?>?view=' + name;
					}
				}
			});
		}
	} else {
		$('#message').html('<div class="alert alert-error"><b>Error!</b> Please enter your name and select 5 or 6 features</div>');
	}

});
</script>