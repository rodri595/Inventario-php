<div class="container">
	<h3><?php print_lang('password_reset_'); ?></h3>
	<hr />
	<div class="">
		<h4 class="text-info bold">
			<i class="fa fa-envelope"></i> <?php print_lang('a_message_has_been_sent_to_your_email_kindly_follow_the_link_to_reset_your_password'); ?>
		</h4>
		<?php
		if (DEVELOPMENT_MODE) {
			?>
			<div class="text-muted">
				To edit this file, browse to :- <i>app/view/partials/passwordmanager/password_reset_link_sent.php</i>
			</div>
		<?php
		}
		?>
	</div>
	<hr />
	<a href="<?php print_link(""); ?>" class="btn btn-info"><?php print_lang('click_here_to_login'); ?></a>
	<?php
	if (DEVELOPMENT_MODE) {
		$mailbody = $this->view_data;
		?>
		<hr />
		<div class="bg-light p-4 border">
			<div class="text-danger">
				<h3>
					<b>Disclaimer:</b> You are seeing this because you published under development mode.
					<br />We understand that sending email in localhost might be problematic.
				</h3>
				<div class="text-muted">To edit the email template, browse to :- <i>app/view/partials/passwordmanager/password_reset_email_template.html</i></div>
			</div>
			<hr />
			<?php echo $mailbody; ?>
		</div>
	<?php
	}
	?>
</div>