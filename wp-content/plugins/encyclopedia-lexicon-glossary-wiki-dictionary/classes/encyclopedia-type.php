<?php Namespace WordPress\Plugin\Encyclopedia;

abstract class Encyclopedia_Type {
  public static
    $type = '';

  static function init(){
    add_Action('init', Array(__CLASS__, 'loadEncyclopediaType'), 1/2); # This needs to be loaded as early as possible
  }

  static function loadEncyclopediaType(){
		$type = Options::get('encyclopedia_type');
    $arr_types = self::getEncyclopediaTypes();

		if (isSet($arr_types[$type]))
      self::$type = $arr_types[$type];
    else
      self::$type = reset($arr_types);
	}

  static function getEncyclopediaTypes(){
		# Type definition
		$arr_types = Array(
			'lexicon' => (Object) Array(
				'label' => I18n::t('Lexicon'),
				'slug' => I18n::t('lexicon', 'URL slug')
			)
		);

		# Run filter
		$arr_types = apply_Filters('encyclopedia_types', $arr_types);

		return $arr_types;
	}

}

Encyclopedia_Type::init();
