<?php Namespace WordPress\Plugin\Encyclopedia;

require_once DirName(__FILE__ ) . '/options.php';

abstract class Content_Filter {

  static function init(){
    add_Filter('the_content', Array(__CLASS__, 'addRelatedTerms'));

    $cross_linker_priority = Options::get('cross_linker_priority') == 'before_shortcodes' ? 10.5 : 15;
    add_Filter('the_content', Array(__CLASS__, 'addCrossLinks'), $cross_linker_priority);
    add_Filter('bbp_get_forum_content', Array(__CLASS__, 'addCrossLinks'), $cross_linker_priority);
    add_Filter('bbp_get_topic_content', Array(__CLASS__, 'addCrossLinks'), $cross_linker_priority);
    add_Filter('bbp_get_reply_content', Array(__CLASS__, 'addCrossLinks'), $cross_linker_priority);
  }

  static function addRelatedTerms($content){
		global $post;
		if ($post->post_type == Post_Type::post_type_name && is_Single($post->ID)){
      if (!has_Shortcode($content, 'encyclopedia_related_terms') && Options::get('related_terms') != 'none' && !post_password_required()){
        $attributes = Array( 'max_terms' => Options::get('number_of_related_terms') );

        if (Options::get('related_terms') == 'above')
          $content = Shortcodes::Related_Terms($attributes) . $content;
        else
          $content .= Shortcodes::Related_Terms($attributes);
      }
		}

    return $content;
	}

  static function addCrossLinks($content){
    global $post;

    # If this is for the excerpt we bail out
    if (doing_Filter('get_the_excerpt')) return $content;

    # Check if Cross-Linking is activated for this post
    if (apply_Filters('encyclopedia_link_terms_in_post', True, $post)){
      $content = Core::addCrossLinks($content, $post);
    }

    return $content;
  }

}

Content_Filter::init();
