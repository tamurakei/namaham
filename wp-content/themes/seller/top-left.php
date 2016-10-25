<?php if (get_theme_mod('seller_email')) : ?>
	<span class="top-left">
		<i class="fa fa-envelope"></i> <?php echo esc_html( get_theme_mod('seller_email') ); ?>
	</span>
<?php endif; ?>
<?php if (get_theme_mod('seller_phone')) :?>
	<span class="top-left">
		<i class="fa fa-phone"></i> <?php echo esc_html( get_theme_mod('seller_phone') ) ?>
	</span>	
<?php endif; ?>