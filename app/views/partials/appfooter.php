<footer class="footer border-top">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4">
				<div class="copyright"><?php print_lang('all_rights_reserved'); ?> | &copy; <?php echo SITE_NAME ?> - <?php echo date('Y') ?></div>
			</div>
			<div class="col">
				<div class="footer-links text-right">
					<a href="<?php print_link('info/about'); ?>"><?php print_lang('about_us'); ?></a> | 
					<a href="<?php print_link('info/help'); ?>"><?php print_lang('help_and_faq'); ?></a> |
					<a href="<?php print_link('info/contact'); ?>"><?php print_lang('contact_us'); ?></a>  |
					<a href="<?php print_link('info/privacy_policy'); ?>"><?php print_lang('privacy_policy'); ?></a> |
					<a href="<?php print_link('info/terms_and_conditions'); ?>"><?php print_lang('terms_and_conditions'); ?></a>
				</div>
			</div>
			
		<div class="col-sm-3">
			Language : <em><?php echo ucfirst(Lang :: get_user_language()) ?></em> <a href="<?php print_link("info/change_language") ?>" class="btn btn-secondary btn-sm">Change</a>
		</div>

		</div>
	</div>
</footer>