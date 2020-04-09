<div class="container">
	<div>
		<h3><?php print_lang('password_reset_'); ?></h3>
		<small class="text-muted">
			<?php print_lang('please_provide_the_valid_email_address_you_used_to_register'); ?>
		</small>
	</div>
	<hr />
	<div class="row">
		<div class="col-md-8">
			<?php 
				$this :: display_page_errors(); 
			?>
			<form method="post" action="<?php print_link("passwordmanager/postresetlink?csrf_token=" . Csrf::$token); ?>">
				<div class="row">
					<div class="col-9">
						<input value="<?php echo get_form_field_value('email'); ?>" placeholder="Enter Your Email Address" required="required" class="form-control default" name="email" type="email" />
					</div>
					<div class="col-3">
						<button class="btn btn-success" type="submit"> <?php print_lang('send'); ?> <i class="fa fa-envelope"></i></button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<br />
	<div class="text-info">
		<?php print_lang('a_link_will_be_sent_to_your_email_containing_the_information_you_need_for_your_password'); ?>
	</div>
</div>




