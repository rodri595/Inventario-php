<div class="container">
	<div class="row justify-content-center">
		<div class="col-sm-6">
			<div class="card card-body">
				<h2><?php print_lang('password_reset_'); ?></h2>
				<hr />	
				<h4 class="animated bounce text-success">
					<i class="fa fa-check-circle"></i> <?php print_lang('your_password_has_been_changed_successfully'); ?>
				</h4>
				<hr />
			</div>
			<br />
			<a href="<?php print_link(""); ?>" class="btn btn-info"><?php print_lang('click_here_to_login'); ?></a>
			<?php 
				if(DEVELOPMENT_MODE){ 
			?>
				<div class="text-muted">To edit the email template, browse to :- <i>app/view/partials/passwordmanager/password_reset_completed.php</i></div>
			<?php 
				} 
			?>
		</div>
	</div>
</div>
	