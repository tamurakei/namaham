<?php Namespace WordPress\Plugin\Encyclopedia;

use WP_Widget;

class Related_Terms_Widget extends WP_Widget {

  function __construct(){
    # Setup the Widget data
    parent::__construct (
      'encyclopdia_related_terms',
      sprintf(I18n::t('Related %s Terms'), Encyclopedia_Type::$type->label),
      Array('description' => I18n::t('A list with the related terms of the current entry.'))
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
      'title' => '',
      'number'  => 5
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

    <p>
      <label for="<?php echo $this->get_Field_Id('number') ?>"><?php echo I18n::t('Number:') ?></label>
      <input type="number" id="<?php echo $this->get_Field_Id('number') ?>" name="<?php echo $this->get_Field_Name('number')?>" value="<?php echo esc_Attr($options->number) ?>" min="1" max="<?php echo PHP_INT_MAX ?>" step="1" class="widefat">
      <small><?php echo I18n::t('The number of related terms the widget should show.') ?></small>
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

    # Load the related terms
    $widget->terms = Core::getTagRelatedTerms(Array(
      'number' => $options->number
    ));

    if (!$widget->terms) return;

    # Display Widget
    echo $widget->before_widget;
    !empty($widget->title) && Print($widget->before_title . $widget->title . $widget->after_title);
    echo Template::load('encyclopedia-related-terms-widget.php', Array('widget' => $widget, 'options' => $options));
    echo $widget->after_widget;

    # Reset Post data
    WP_Reset_Postdata();
  }

}

Related_Terms_Widget::registerWidget();
