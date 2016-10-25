<?php Namespace WordPress\Plugin\Encyclopedia ?>

<div class="wrap">

  <h1><?php printf(I18n::t('%s Settings'), Encyclopedia_Type::$type->label) ?></h1>

  <?php if (isSet($_GET['options_saved'])): ?>
  <div id="message" class="updated fade">
    <p><strong><?php _e('Settings saved.') ?></strong></p>
  </div>
  <?php endif ?>

  <form method="post" action="">
    <div class="metabox-holder">

      <div class="postbox-container left">
        <?php foreach (Options::$arr_option_box['main'] as $box): ?>
          <div class="postbox">
            <h2 class="hndle"><?php echo $box->title ?></h2>
            <div class="inside"><?php include $box->file ?></div>
          </div>
        <?php endforeach ?>
      </div>

      <div class="postbox-container right">
        <?php foreach (Options::$arr_option_box['side'] as $box): ?>
          <div class="postbox">
            <h2 class="hndle"><?php echo $box->title ?></h2>
            <div class="inside"><?php include $box->file ?></div>
          </div>
        <?php endforeach ?>
      </div>

    </div>

    <p class="submit">
      <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>">
    </p>
  </form>

</div>
