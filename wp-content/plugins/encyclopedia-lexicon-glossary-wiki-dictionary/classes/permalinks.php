<?php Namespace WordPress\Plugin\Encyclopedia;

abstract class Permalinks {
  public static
    $rewrite_rules = Array(); # Array with the new additional rewrite rules

  static function init(){
    add_Filter('rewrite_rules_array', Array(__CLASS__, 'addRewriteRules'), 50);
    add_Action('admin_init', Array(__CLASS__, 'flushRewriteRules'), 100);
  }

  static function defineRewriteRules(){
    # Add filter permalink structure for post type archive
    $post_type = get_Post_Type_Object(Post_Type::post_type_name);
    $archive_url_path = $post_type->rewrite['slug'];
    self::$rewrite_rules[ltrim(sprintf('%s/filter:([^/]+)/?$', $archive_url_path), '/')] = sprintf('index.php?post_type=%s&filter=$matches[1]', Post_Type::post_type_name);
    self::$rewrite_rules[ltrim(sprintf('%s/filter:([^/]+)/page/([0-9]{1,})/?$', $archive_url_path), '/')] = sprintf('index.php?post_type=%s&filter=$matches[1]&paged=$matches[2]', Post_Type::post_type_name);

    # Add filter permalink structure for taxonomy archives
    foreach (get_Taxonomies(Null, 'objects') as $taxonomy){
      $taxonomy_slug = $taxonomy->rewrite['slug'];
      if (!in_Array(Post_Type::post_type_name, $taxonomy->object_type)) Continue;
      self::$rewrite_rules[ltrim(sprintf('%s/([^/]+)/filter:([^/]+)/?$', $taxonomy_slug), '/')] = sprintf('index.php?%s=$matches[1]&filter=$matches[2]', $taxonomy->name);
      self::$rewrite_rules[ltrim(sprintf('%s/([^/]+)/filter:([^/]+)/page/([0-9]{1,})/?$', $taxonomy_slug), '/')] = sprintf('index.php?%s=$matches[1]&filter=$matches[2]&paged=$matches[3]', $taxonomy->name);
    }
  }

  static function addRewriteRules($current_rewrite_rules){
    setType($current_rewrite_rules, 'ARRAY');
    if (empty(self::$rewrite_rules)) self::defineRewriteRules();
    $arr_rules = Array_Merge(self::$rewrite_rules, $current_rewrite_rules);
    return $arr_rules;
  }

  static function flushRewriteRules(){
    $current_rewrite_rules = get_Option('rewrite_rules');
    setType($current_rewrite_rules, 'ARRAY');
    if (empty(self::$rewrite_rules)) self::defineRewriteRules();

    foreach (self::$rewrite_rules as $rewrite_rule => $redirect){
      if (!isSet($current_rewrite_rules[$rewrite_rule])){
        flush_Rewrite_Rules();
        return;
      }
    }
  }

}

Permalinks::init();
