<?php Namespace WordPress\Plugin\Encyclopedia ?>

<p>
  <?php printf(I18n::t('The archive link for your %1$s is: <a href="%2$s" target="_blank">%2$s</a>'), Encyclopedia_Type::$type->label, get_Post_Type_Archive_Link(Post_Type::post_type_name)) ?>
</p>

<p>
  <?php printf(I18n::t('The archive feed for your %1$s is: <a href="%2$s" target="_blank">%2$s</a>'), Encyclopedia_Type::$type->label, get_Post_Type_Archive_Feed_Link(Post_Type::post_type_name)) ?>
</p>
