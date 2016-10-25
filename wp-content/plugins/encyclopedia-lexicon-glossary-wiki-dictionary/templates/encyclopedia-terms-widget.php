<?php /* Global: $widget, $options */ ?>

<ul>
  <?php while ($widget->terms->have_Posts()): $widget->terms->the_Post() ?>
  <li><a href="<?php the_Permalink() ?>" title="<?php the_Title_Attribute() ?>"><?php the_Title() ?></a></li>
  <?php endwhile ?>
</ul>
