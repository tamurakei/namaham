<?php
/**
 * @package Seller
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-3 col-sm-6 grid3'); ?>>

		<div class="featured-thumb col-md-12">
			
				<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><img src="<?php echo get_template_directory_uri()."/defaults/images/dimg".mt_rand(1,7).".jpg"; ?>"></a>
		</div><!--.featured-thumb-->
			
		<div class="out-thumb col-md-12">
			<header class="entry-header">
				<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
				<span class="entry-excerpt"><?php echo substr(get_the_excerpt(),0,200).(get_the_excerpt() ? "..." : "" ); ?></span>
			</header><!-- .entry-header -->
		</div><!--.out-thumb-->
		
</article><!-- #post-## -->