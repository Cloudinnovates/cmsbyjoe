<?php
if ($this->uri->segment(2) == 'edit')
{
		$action = 'edit/' . $id;
		$form = $query->row();
}
else
{
		$action = 'add';
		//$form->parent_page = 0;
}

echo form_open('admin_posts/' . $action);

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
		<legend>News Story Content </legend>
		
		<div class="form-group">
			<label for="title">Headline: </label>
			<input type="text" name="headline" class="form-control" value="<?php echo (isset($form->headline)) ? $form->headline : set_value('headline'); ?>"> 
		</div>

		<div class="form-group">
			<label for="title">URL: </label>
			<small><?php echo $this->config->item('base_url'); ?>news/detail/...</small>
			<input type="text" name="slug" class="form-control" value="<?php echo (isset($form->slug)) ? $form->slug : set_value('slug'); ?>">
		</div>
		
		<div class="form-group">
			<label>Opening Text:</label>
			<textarea class="form-control" name="opener"><?php echo (isset($form->opener)) ? $form->opener : ''; ?></textarea>
		</div>
		
		<div class="form-group">
			<label for="content">Page Content:</label>
			<textarea id="summernote" name="story" class="form-control">
			<?php
			if (isset($form->story))
			{
					echo $form->story;
			}
			?>
			</textarea>
		</div>
		
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
	</fieldset>
	<fieldset>
		<legend>Save Changes</legend>			
		
		<div class="form-group">
			<input type="submit" value="Save" class="btn btn-primary btn-lg">
		</div>
	</fieldset>
	
</form>

<script type="text/javascript">
jQuery(document).ready(function() {
	
	// datepicker
	//jQuery("#datestamp").datepicker({ dateFormat: 'yy-mm-dd' });
	
	//jQuery('#datestamp').datetime({ userLang	: 'en', americanMode: true });
  
	<?php if ($this->uri->segment(2) == 'add') : ?>
  // auto slug helper
  $('input[name="headline"]').keyup(function() {
      var headline = $(this).val();
      //console.log(headline);
      var slug = headline.toLowerCase();
      slug = slug.replace(/[^a-zA-Z 0-9]+/g,'');
      slug = slug.replace(/ /g, '-');
      $('input[name="slug"]').val(slug);
  });
  <?php endif; ?>

});
</script>