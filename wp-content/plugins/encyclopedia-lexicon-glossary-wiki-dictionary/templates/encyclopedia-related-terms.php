<?php Namespace WordPress\Plugin\Encyclopedia;

if ($related_terms): ?>
<h3><?php echo I18n::t('Related entries') ?></h3>
<ul class="related-terms">
	<?php while ($related_terms->have_Posts()): $related_terms->the_Post() ?>
	<li class="term"><a href="<?php the_Permalink() ?>" title="<?php the_Title_Attribute() ?>"><?php the_Title() ?></a></li>
	<?php endwhile; WP_Reset_Postdata() ?>
</ul>
<?php endif;
