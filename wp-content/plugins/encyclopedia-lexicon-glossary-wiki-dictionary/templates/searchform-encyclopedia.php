<?php
use WordPress\Plugin\Encyclopedia\Post_Type;
?>

<form role="search" method="get" class="encyclopedia search-form" action="<?php echo esc_URL(home_url('/')) ?>">
  <label class="screen-reader-text" for="encyclopedia-search-term"><?php _e('Search') ?></label>
  <input type="text" id="encyclopedia-search-term" name="s" class="search-field" value="<?php the_Search_Query() ?>" placeholder="<?php echo esc_Attr_X( 'Search &hellip;', 'placeholder' ) ?>">
  <button type="submit" class="search-submit submit button" id="encyclopedia-search-submit"><?php esc_attr_e('Search') ?></button>
  <input type="hidden" name="post_type" value="<?php echo Post_Type::post_type_name ?>">
</form>
