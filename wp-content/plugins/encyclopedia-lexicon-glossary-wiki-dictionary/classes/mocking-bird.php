<?php Namespace WordPress\Plugin\Encyclopedia;

abstract class Mocking_Bird {

  static function init(){
    add_Action('wp_insert_post_empty_content', Array(__CLASS__, 'checkCreatedPost'), 10, 3);
    add_Action('admin_notices', Array(__CLASS__, 'printTermCountNotice'));
    add_Action('admin_footer', Array(__CLASS__, 'printDashboardJavaScript'));
    add_Action('admin_bar_menu', Array(__CLASS__, 'removeAdminBarAddButton'), PHP_INT_MAX);
  }

  static function getProNotice($message_id = 'option'){
    $arr_message = Array(
      'upgrade' => I18n::t('Upgrade to Pro'),
      'upgrade_url' => '%s',
      'feature' => I18n::t('Available in the <a href="%s" target="_blank">premium version</a> only.'),
      'unlock' => sprintf('<a href="%%s" title="%s" class="unlock" target="_blank"><span class="dashicons dashicons-lock"></span></a>', I18n::t('Unlock this feature')),
      'option' => I18n::t('This option is changeable in the <a href="%s" target="_blank">premium version</a> only.'),
      'custom_tax' => I18n::t('Do you need a special taxonomy for your project? No problem! Just <a href="%s" target="_blank">get in touch</a> through our support section.'),
      'count_limit' => I18n::t('In the <a href="%s" target="_blank">premium version of Encyclopedia</a> you will take advantage of unlimited terms and many more features.'),
      #'changeable' => I18n::t('Changeable in the <a href="%s" target="_blank">premium version</a> only.'),
      #'do_you_like' => I18n::t('Do you like the term management? Upgrade to the <a href="%s" target="_blank">premium version of Encyclopedia</a>!')
    );

    if (isSet($arr_message[$message_id])){
      $message = sprintf($arr_message[$message_id], I18n::t('http://dennishoppe.de/en/wordpress-plugins/encyclopedia', 'Link to the authors website'));
      return $message;
    }
    else
      return False;
  }

  static function printProNotice($message_id){
    echo self::getProNotice($message_id);
  }

  static function getNumberOfTerms($limit = -1){
    return count(get_Posts(Array('post_type' => Post_Type::post_type_name, 'post_status' => 'any', 'numberposts' => $limit)));
  }

  static function checkTermCount(){
    return self::getNumberOfTerms(12) < 12;
  }

  static function checkCreatedPost($maybe_empty, $post_data){
    if ($post_data['post_type'] == Post_Type::post_type_name){
      $new_record = empty($post_data['ID']);
      $untrash = !$new_record && get_Post_Status($post_data['ID']) == 'trash';
      if (($new_record || $untrash) && !self::checkTermCount()){
        #WP_Die(sprintf('<h1>%s</h1><pre>%s</pre>', __FUNCTION__, Print_R ($post_data, True)));
        self::printTermCountLimit();
      }
    }
  }

  static function printTermCountLimit(){
    WP_Die(
      sprintf('<p>%s</p><p>%s</p>',
        self::getProNotice('count_limit'),
        sprintf('<a href="%s" class="button">%s</a>', Admin_URL('edit.php?post_type=' . Post_Type::post_type_name), I18n::t('&laquo; Back to your terms'))
      )
    );
  }

  static function printTermCountNotice(){
    if (self::getNumberOfTerms(20) >= 20): ?>
    <div class="updated"><p>
      <?php printf(I18n::t('Sorry, there are to many %s terms for Encyclopedia Lite. This could result in strange behaviors of the plugin. It is strongly recommended to delete some terms.'), Encyclopedia_Type::$type->label) ?>
      <?php self::printProNotice('count_limit') ?>
    </p></div>
    <?php endif;
  }

  static function printDashboardJavaScript(){
    if (!self::checkTermCount()): ?>
    <script type="text/javascript">
    (function($){
      $('a[href*="post-new.php?post_type=<?php echo Post_Type::post_type_name ?>"]')
        .text('<?php self::printProNotice('upgrade') ?>')
        .attr({
          'title': '<?php self::printProNotice('upgrade') ?>',
          'href': '<?php self::printProNotice('upgrade_url') ?>',
          'target': '_blank'
        })
        .css({
          'color': '#46b450',
          'font-weight': 'bold'
        });
    }(jQuery));
    </script>
    <?php endif;
  }

  static function removeAdminBarAddButton($admin_bar){
    if (!self::checkTermCount()) $admin_bar->remove_Node(sprintf('new-%s', Post_Type::post_type_name));
  }

}

Mocking_Bird::init();
