<?php
if ($this->uri->segment(2) == 'edit')
{
		$action = 'edit/' . $id;
		$form = $query->row();
}
else
{
		$action = 'add';
}

echo form_open('admin_pages/' . $action);


if (validation_errors()) 
{
		echo '<div class="form_error">';
		echo '<h4>There was a problem submitting your inquiry</h4>';
		echo '<ul>' . validation_errors() . '</ul>';
		echo '<p>Please correct the fields and re-submit your inquiry.</p>';
		echo '</div>';
}

if (isset($form->id))
{
		echo form_hidden('id', $form->id);
}
?>

	<fieldset>
		<legend>Page Meta Data </legend>
		
		<div class="form-group">
			<label for="title">Page Title: </label>
			<input type="text" name="title" class="form-control" value="<?php echo (isset($form->title)) ? $form->title : set_value('title'); ?>"> 
		</div>
		
		<div class="form-group">
			<label for="title">URL: </label>
			<small><?php echo $this->config->item('base_url'); ?>pages/...</small>
			<input type="text" name="slug" class="form-control" value="<?php echo (isset($form->slug)) ? $form->slug : set_value('slug'); ?>">
		</div>
		
		<div class="form-group">
			<label for="description">Page Description: </label>
			<textarea class="form-control" name="description"><?php echo (isset($form->description)) ? $form->description : set_value('description'); ?></textarea>
		</div>
		
		<!--<div>
			<label for="keywords">Page Keywords: </label>
			<textarea cols="50" name="keywords" rows="2"><?php echo (isset($form->keywords)) ? $form->keywords : set_value('keywords'); ?></textarea>
		</div>-->
		
	</fieldset>
	
	<fieldset>
		<legend>Page Content </legend>
		
		<div class="form-group">
			<label>Heading:</label>
			<input class="form-control" name="heading" value="<?php echo (isset($form->heading)) ? $form->heading : ''; ?>">
		</div>
		
		<div class="form-group">
			<label>Opening Text:</label>
			<textarea class="form-control" name="opener"><?php echo (isset($form->opener)) ? $form->opener : ''; ?></textarea>
		</div>
		
		<div class="form-group">
			<label>Page Content:</label>
			<textarea id="summernote" class="form-control" name="content"><?php echo (isset($form->content)) ? $form->content : ''; ?></textarea>
			<script>
				$(document).ready(function() {
					$('#summernote').summernote({
						toolbar: [
							['style', ['style']],
							['font', ['bold', 'italic', 'underline', 'clear']],
							['para', ['ul', 'ol', 'paragraph']],
							['insert', ['link', 'picture', 'hr']],
							['view', ['fullscreen', 'codeview']],
							['help', ['help']]
						]
					});
				});
			</script>
			<style type="text/css">
				.note-editable {
					background: #fff;
				}
			</style>

		</div>	
	</fieldset>

	<input type="hidden" name="status" value="1">

	
	<fieldset>
		<legend>Save Changes</legend>			
		
		<div class="form-group submit">
			<input type="submit" class="btn btn-primary btn-lg" value="Save Page">
		</div>
	</fieldset>
	
</form>

<script type="text/javascript">
$().ready(function() {

	  // auto slug helper - but only when adding!
  <?php if ($this->uri->segment(2) == 'add') : ?>
  $('input[name=title]').keyup(function() {
      var headline = jQuery(this).val();
      //console.log(headline);
      var slug = headline.toLowerCase();
      slug = slug.replace(/[^a-zA-Z 0-9]+/g,'');
      slug = slug.replace(/ /g, '-');
      $('input[name=slug]').val(slug);
  });
  <?php endif; ?>

});
</script>