<script src="/assets/formvalidation/dist/js/formValidation.min.js"></script>
<script src="/assets/formvalidation/dist/js/framework/bootstrap.min.js"></script>
<script src="/assets/formvalidation/dist/js/addons/reCaptcha2.min.js"></script>

<?php if (validation_errors()) : ?>
	<div class="form_error_summary">
		<h3 class="error_heading">Oops! Submission Error(s)!</h3>
		<p class="error_desc">Please check the following errors:</p>
		<div class="errors">
			<?php echo validation_errors(); ?>
		</div>
	</div>
<?php endif; ?>

<div class="contact-form">
	<h1>Contact Mark Marroletti</h1>
	
	<p>Mark Marroletti<br>
		Long &amp; Foster Realtors<br>
		2997 Dune Drive<br>
		Avalon, NJ 08202<br>
		<a href="tel:6095177305">(609) 517-7305</a><br>
		<a href="mailto:mark@mmavalon.com">mark@mmavalon.com</a>
	</p>
	
	<h3>Location Map</h3>
	<div class="map-container" style="width:320px; height:240px;">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d732.3439839505639!2d-74.71931665774608!3d39.097289392513886!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c0a4f9e6e69b15%3A0x90124c1462e9b109!2sMark+Marroletti+of+Long+%26+Foster+Real+Estate!5e0!3m2!1sen!2sus!4v1441908801074" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
	</div>
	
	<h2>Have a question or comment? Let Mark know!</h2>
	
	<form class="contact-form" action="/contact" method="post" 
		data-fv-framework="bootstrap" 
	  data-fv-icon-valid="" 
	  data-fv-icon-invalid="" 
	  data-fv-icon-validating="" 
	  data-fv-addons="reCaptcha2" 
	  data-fv-addons-recaptcha2-element="captchaContainer" 
	  data-fv-addons-recaptcha2-theme="light" 
	  data-fv-addons-recaptcha2-timeout="120" 
	  data-fv-addons-recaptcha2-sitekey="<?php echo $this->config->item('captcha_site_key'); ?>" 
	  data-fv-addons-recaptcha2-message="The captcha is not valid">

		<fieldset>
			<legend>Your Information</legend>
			<div class="form-group">
				<label>Your Name: </label>
				<input type="text" class="form-control" name="name" 
				data-fv-notempty="true" 
				data-fv-notempty-message="Required">
			</div>
			
			<div class="form-group">
				<label>Your Email: </label>
				<input type="text" class="form-control" name="email" 
				data-fv-notempty="true" 
				data-fv-notempty-message="Required" 
				data-fv-emailaddress="true" 
	      data-fv-emailaddress-message="The value is not a valid email address" 
	      data-fv-trigger="blur change keyup input">
			</div>
			
			<div class="form-group">
				<label>Your Phone: </label>
				<input type="text" class="form-control" name="phone" 
				data-fv-notempty="true" 
				data-fv-notempty-message="Required" 
				data-fv-trigger="blur change keyup input">
			</div>
			
			<div class="form-group">
				<label>Your Inquiry: </label>
				<textarea name="comments" class="form-control" 
				data-fv-notempty="true" 
				data-fv-notempty-message="Required"></textarea>
			</div>

			<div class="form-group">
				<label>Captcha:</label>
				<div id="captchaContainer"></div>
			</div>
	
			<div class="form-group">
				<input type="submit" class="btn btn-primary">
			</div>

			<div class="form-group">
				<label>
					<input type="checkbox" name="add" value="yes" checked="checked"> 
					Add me to your mailing list
				</label>
			</div>
			
		</fieldset>
		
	</form>
</div>

<script>
$().ready(function() {
	$('.contact-form').formValidation()
	.on('err.field.fv', function(e, data) {
      if (data.fv.getSubmitButton()) {
          data.fv.disableSubmitButtons(false);
      }
  })
  .on('success.field.fv', function(e, data) {
      if (data.fv.getSubmitButton()) {
          data.fv.disableSubmitButtons(false);
      }
  });
});
</script>