<div class="container">
	<h3><?php print_lang('password_reset_'); ?></h3>
	
	<div class="card card-body mt-4 animated bounce">
		<h3 class="text-danger bold"><?php print_lang('your_password_reset_was_not_completed'); ?></h3>
		<div class="text-muted"><?php print_lang('password_reset_key_failure'); ?></div>
		<hr />
		<div class="text-success">
			<?php print_lang('please_you_can_try_reseting_your_password_by_following_these_steps_'); ?>
			<br />
			<br />
			<a href="<?php print_link("passwordmanager/") ?>" class="btn btn-primary"><?php print_lang('reset_password'); ?></a>
			
			<a href="<?php print_link(""); ?>" class="btn btn-info"><?php print_lang('click_here_to_login'); ?></a>
		</div>
	</div>
</div>
