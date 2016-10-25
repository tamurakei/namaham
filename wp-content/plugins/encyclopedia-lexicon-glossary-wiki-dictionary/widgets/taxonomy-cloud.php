<?php Namespace WordPress\Plugin\Encyclopedia;

use WP_Widget;

class Taxonomy_Cloud_Widget extends WP_Widget {

  function __construct(){
    parent::__construct (
      'encyclopedia_taxonomy_cloud',
      sprintf(I18n::t('%s Taxonomy Cloud'), Encyclopedia_Type::$type->label),
      Array('description' => sprintf(I18n::t('A cloud of your most used %s taxonomy items.'), Encyclopedia_Type::$type->label))
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
      'title'    => '',
      'taxonomy' => False,
      'number'   => Null,
      'orderby'  => 'name',
      'order'    => 'RAND'
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
      <label for="<?php echo $this->get_Field_Id('taxonomy') ?>"><?php echo I18n::t('Taxonomy:') ?></label>
      <select id="<?php echo $this->get_Field_Id('taxonomy') ?>" name="<?php echo $this->get_Field_Name('taxonomy') ?>" class="widefat">
        <?php foreach (get_Object_Taxonomies(Post_Type::post_type_name) as $taxonomy) : $taxonomy = get_Taxonomy($taxonomy) ?>
        <option value="<?php echo $taxonomy->name ?>" <?php selected($options->taxonomy, $taxonomy->name) ?>><?php echo esc_Attr($taxonomy->labels->name) ?></option>
        <?php endforeach ?>
      </select>
    </p>

    <p>
      <label for="<?php echo $this->get_Field_Id('number') ?>"><?php echo I18n::t('Number:') ?></label>
      <input type="number" id="<?php echo $this->get_Field_Id('number') ?>" name="<?php echo $this->get_Field_Name('number')?>" value="<?php echo esc_Attr($options->number) ?>" min="0" max="<?php echo PHP_INT_MAX ?>" step="1" class="widefat">
      <small><?php echo I18n::t('Leave blank to show all.') ?></small>
    </p>

    <p>
      <label for="<?php echo $this->get_Field_Id('orderby') ?>"><?php echo I18n::t('Order by:') ?></label>
      <select id="<?php echo $this->get_Field_Id('orderby') ?>" name="<?php echo $this->get_Field_Name('orderby') ?>" class="widefat">
        <option value="name" <?php selected($options->orderby, 'name') ?>><?php echo __('Name') ?></option>
        <option value="count" <?php selected($options->orderby, 'count') ?>><?php echo I18n::t('Term Count') ?></option>
      </select>
    </p>

    <p>
      <label for="<?php echo $this->get_Field_Id('order') ?>"><?php echo I18n::t('Order:') ?></label>
      <select id="<?php echo $this->get_Field_Id('order') ?>" name="<?php echo $this->get_Field_Name('order') ?>" class="widefat">
        <option value="RAND" <?php selected($options->order, 'RAND') ?>><?php _e('Random') ?></option>
        <option value="ASC" <?php selected($options->order, 'ASC') ?>><?php _e('Ascending') ?></option>
        <option value="DESC" <?php selected($options->order, 'DESC') ?>><?php _e('Descending') ?></option>
      </select>
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

    # Check if the Taxonomy is alive
    if (!Taxonomy_Exists($options->taxonomy)) return False;

    # Display Widget
    echo $widget->before_widget;

    !empty($widget->title) && Print($widget->before_title . $widget->title . $widget->after_title);

    $cloud_parameters = Array(
      'taxonomy'   => $options->taxonomy,
      'number'     => (Int) $options->number, # "0" means no limit; empty string and (bool) false will result in default limit
      'order'      => $options->order,
      'orderby'    => $options->orderby,
    );

    echo '<ul>';
    WP_Tag_Cloud($cloud_parameters);
    echo '</ul>';

    echo $widget->after_widget;
  }

}

Taxonomy_Cloud_Widget::registerWidget();
