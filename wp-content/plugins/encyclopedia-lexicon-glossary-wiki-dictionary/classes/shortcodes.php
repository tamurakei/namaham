<?php Namespace WordPress\Plugin\Encyclopedia;

abstract class Shortcodes {
  
  static function init(){
    add_Shortcode('encyclopedia_related_terms', Array(__CLASS__, 'Related_Terms'));
  }

	static function Related_Terms($attributes = Null){
    $attributes = is_Array($attributes) ? $attributes : Array();

    $attributes = Array_Merge(Array(
      'number' => 5
    ), $attributes);

    $related_terms = Core::getTagRelatedTerms($attributes);

		return Template::load('encyclopedia-related-terms.php', Array(
      'attributes' => $attributes,
      'related_terms' => $related_terms
    ));
	}


}

Shortcodes::init();