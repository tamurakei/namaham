<?php /* Global: $widget, $options */ ?>

<ul class="related-terms">
	<?php while ($widget->terms->have_Posts()): $widget->terms->the_Post() ?>
	<li class="term"><a href="<?php the_Permalink() ?>" title="<?php the_Title_Attribute() ?>"><?php the_Title() ?></a></li>
	<?php endwhile; WP_Reset_Postdata() ?>
</ul>
