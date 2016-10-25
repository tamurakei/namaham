<?php Namespace WordPress\Plugin\Encyclopedia;

use WP_Query;

abstract class WPML {

  static function init(){
    add_Filter('gettext_with_context', Array(__CLASS__, 'filterGettextWithContext'), 1, 4);
    add_Filter('encyclopedia_available_prefix_filters', Array(__CLASS__, 'filterAvailablePrefixFilters'));
    add_Action('encyclopedia_tag_related_terms_query_object', Array(__CLASS__, 'filterTagRelatedTerms'), 10, 2);
  }

  static function isWPMLActive(){
    return defined('ICL_SITEPRESS_VERSION');
  }

  static function filterGettextWithContext($translation, $text, $context, $domain){
    # If you are using WPML the post type slug MUST NOT be translated! You can translate your slug in WPML directly
    if (self::isWPMLActive() && $context == 'URL slug' && $domain == I18n::getTextDomain())
      return $text;
    else
      return $translation;
  }

  static function filterAvailablePrefixFilters($arr_filter){
    if (self::isWPMLActive() && is_Array($arr_filter)){
      foreach ($arr_filter as $index => $filter){
        # Check if there are posts behind this filter in this language
        $query = new WP_Query(Array(
          'post_type' => Post_Type::post_type_name,
          'post_title_like' => $filter . '%',
          'posts_per_page' => 1,
          'cache_results' => False,
          'no_count_rows' => True
        ));
        if (!$query->have_Posts()) unset($arr_filter[$index]);
      }
    }

    return $arr_filter;
  }

  static function filterTagRelatedTerms($query, $arguments){
    if (self::isWPMLActive()){
      $original_term_id = $arguments->term_id;
      $arr_related_terms_ids = Array();
      foreach ($query->posts as $related_term) $arr_related_terms_ids[] = $related_term->ID;

      $query->query(Array(
        'post_type' => Post_Type::post_type_name,
        'post__in' => $arr_related_terms_ids,
        'orderby' => 'post__in',
        'nopaging' => True,
        'ignore_sticky_posts' => False
      ));

      foreach ($query->posts as $index => $related_term){
        if ($related_term->ID == $original_term_id){
          unset($query->posts[$index]);
          $query->post_count = count($query->posts);
          $query->rewind_Posts();
          break;
        }
      }
    }
  }

}

WPML::init();
