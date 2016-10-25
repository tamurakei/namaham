<?php Namespace WordPress\Plugin\Encyclopedia;

$link_terms = is_Array(Options::get('link_terms')) ? Options::get('link_terms') : Array();
?>

<table class="form-table">

<?php foreach (get_Post_Types(Array('show_ui' => True),'objects') as $type): ?>
<tr>
  <th><?php echo $type->label ?></th>
  <td>
    <label>
      <input type="checkbox" <?php disabled(True); checked(True) ?> >
      <?php printf(I18n::t('Link terms in %s'), $type->label) ?>
      <?php Mocking_Bird::printProNotice('unlock') ?>
    </label><br>

    <label>
      <input type="checkbox" <?php disabled(True) ?> >
      <?php echo I18n::t('Open link in a new window/tab') ?>
    </label>
  </td>
</tr>
<?php endforeach ?>

<tr>
  <th><?php echo I18n::t('Filter order') ?></th>
  <td>
    <label for="cross_linker_priority">
      <select id="cross_linker_priority" name="cross_linker_priority">
        <option value="before_shortcodes" <?php selected(Options::get('cross_linker_priority') == 'before_shortcodes') ?> ><?php echo I18n::t('Before shortcodes') ?></option>
        <option value="" <?php selected(Options::get('cross_linker_priority') == 'after_shortcodes') ?> ><?php echo I18n::t('After shortcodes') ?></option>
      </select>
    </label>
    <p class="help"><?php echo I18n::t('By default the cross links should be added to the content after rendering all shortcodes. This works not for shortcodes which are calling the "the_content" filter while rendering. In this case please change this setting to "Before shortcodes".') ?></p>
  </td>
</tr>

<tr>
  <th><?php echo I18n::t('Complete words') ?></th>
  <td>
    <label>
      <input type="checkbox" <?php disabled(True) ?> >
      <?php echo I18n::t('Link complete words only.') ?><?php Mocking_Bird::printProNotice('unlock') ?>
    </label>
  </td>
</tr>

<tr>
  <th><?php echo I18n::t('Case sensitivity') ?></th>
  <td>
    <label>
      <input type="checkbox" <?php disabled(True) ?> >
      <?php echo I18n::t('Link terms case sensitive.') ?><?php Mocking_Bird::printProNotice('unlock') ?>
    </label>
  </td>
</tr>

<tr>
  <th><?php echo I18n::t('First match only') ?></th>
  <td>
    <label>
      <input type="checkbox" <?php disabled(True) ?> >
      <?php echo I18n::t('Link the first match of each term only.') ?><?php Mocking_Bird::printProNotice('unlock') ?>
    </label>
  </td>
</tr>

<tr>
  <th><?php echo I18n::t('Recursion') ?></th>
  <td>
    <label>
      <input type="checkbox" <?php disabled(True) ?> >
      <?php echo I18n::t('Link the term in its own content.') ?><?php Mocking_Bird::printProNotice('unlock') ?>
    </label>
  </td>
</tr>

<tr>
	<th><label><?php echo I18n::t('Link title length') ?></label></th>
	<td>
		<input type="number" value="<?php echo esc_Attr(Options::get('cross_link_title_length')) ?>" <?php disabled(True) ?> >
    <?php echo I18n::t('words') ?><?php Mocking_Bird::printProNotice('unlock') ?>
    <p class="help"><?php echo I18n::t('The number of words of the linked term used as link title. This option does not affect manually created excerpts.') ?></p>
	</td>
</tr>

</table>
