<?php if (validation_errors()) : ?>
	<div class="form_error_summary">
		<h3 class="error_heading">Oops! Submission Error(s)!</h3>
		<p class="error_desc">Please check the following errors:</p>
		<p><?php echo validation_errors(); ?></p>
	</div>
<?php endif; ?>

<?php if ($reviews) : ?> 
<h2>Review <?php echo $this->config->item('company_name'); ?></h2>
<?php else : ?>
<h1>Review <?php echo $this->config->item('company_name'); ?></h1>
<?php endif; ?>

<p>Please tell us about your experience at Palmer River Equestrian Center</p>

<form id="contact_form" action="/reviews" method="post">	
	<fieldset>

		<div>
			<label>Your Name: </label>
			<input type="text" class="wide" name="name" id="name" value="<?php echo set_value('name'); ?>">
			<?php echo form_error('name'); ?>
		</div>
		
		<div>
			<label>Your Email: </label>
			<input type="text" class="wide" name="email" id="email" value="<?php echo set_value('email'); ?>">
			<?php echo form_error('email'); ?>
		</div>
		
		<div>
			<label>Your Review: </label>
			<textarea name="review" id="review" rows="6" cols="50" class="wide"><?php echo set_value('review'); ?></textarea>
			<?php echo form_error('review'); ?>
		</div>

		<div class="submit">
		 	<input type="submit" value="Submit">
		</div>
		
	</fieldset>
	
</form>