<?php
if ($this->uri->segment(2) == 'edit')
{
		$action = 'edit/' . $id;
}
else
{
		$action = 'add';
}

echo form_open_multipart('admin_reviews/' . $action);


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
		<legend>Testimonial Info</legend>
		
		<div class="form-group">
			<label>Testimonial Text: </label>
			<textarea name="review" class="form-control" style="height:120px;"><?php echo (isset($form->review)) ? $form->review : set_value('review'); ?></textarea>
		</div>
		
		<div class="form-group">
			<label for="title">From: </label>
			<input type="text" name="name" class="form-control" value="<?php echo (isset($form->name)) ? $form->name : set_value('name'); ?>">
		</div>

	</fieldset>
		
	<fieldset>
		<legend>Save Changes</legend>
		
		<div class="form-group submit">
			<input type="submit" class="btn btn-primary btn-lg" value="Save Page">
		</div>
	</fieldset>
	
</form>