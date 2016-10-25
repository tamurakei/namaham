<?php Namespace WordPress\Plugin\Encyclopedia;

use WP_Widget;

class Search_Widget extends WP_Widget {

  function __construct(){
    parent::__construct (
      'encyclopedia_search',
      sprintf(I18n::t('%s Search'), Encyclopedia_Type::$type->label),
      Array('description' => sprintf(I18n::t('A search form for your %s terms.'), Encyclopedia_Type::$type->label))
    );
  }

  static function registerWidget(){
    if (doing_Action('widgets_init'))
      register_Widget(__CLASS__);
    else
      add_Action('widgets_init', Array(__CLASS__, __FUNCTION__));
  }

  function getDefaultOptions(){
    # Default settings
    return Array(
      'title' => ''
    );
  }

  function loadOptions(&$options){
    setType($options, 'ARRAY');
    $options = Array_Filter($options);
    $options = Array_Merge($this->getDefaultOptions(), $options);
    setType($options, 'OBJECT');
  }

  function Form($options){
    $this->loadOptions($options);
    ?>

    <p>
      <label for="<?php echo $this->get_Field_Id('title') ?>"><?php _e('Title:') ?></label>
      <input type="text" id="<?php echo $this->get_Field_Id('title') ?>" name="<?php echo $this->get_Field_Name('title')?>" value="<?php echo esc_Attr($options->title) ?>" class="widefat">
    </p>

    <?php
  }

  function Widget($widget, $options){
    # Load widget args
    setType($widget, 'OBJECT');

    # Load options
    $this->loadOptions($options);

    # Load widget title
    $widget->title = apply_Filters('widget_title', $options->title, (Array) $options, $this->id_base);

    # Enqueue Javascript in Website footer
    WP_Enqueue_Script('encyclopedia-search', Core::$base_url.'/assets/js/search-form.js', Array('jquery-ui-autocomplete'), Null, True);
    WP_Localize_Script('encyclopedia-search', 'Encyclopedia_Search', apply_Filters('encyclopedia-search-widget', Array(
      'ajax_url' => add_Query_Arg(Array('action' => 'encyclopedia_search'), Admin_URL('admin-ajax.php')),
      'minLength' => Options::get('autocomplete_min_length'),
      'delay' => Options::get('autocomplete_delay')
    )));

    # Display Widget
    echo $widget->before_widget;
    !empty($widget->title) && Print($widget->before_title . $widget->title . $widget->after_title);
    echo Template::load('searchform-encyclopedia.php');
    echo $widget->after_widget;
  }

}

Search_Widget::registerWidget();
