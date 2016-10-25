<?php Namespace WordPress\Plugin\Encyclopedia ?>

<table class="form-table">
<tr>
	<th><label><?php echo I18n::t('Terms per page') ?></label></th>
	<td>
    <input type="number" value="<?php echo get_Option('posts_per_page') ?>" <?php disabled(True) ?> min="1" max="<?php echo PHP_INT_MAX ?>" step="1"><?php Mocking_Bird::printProNotice('unlock') ?>
    <p class="help"><?php echo I18n::t('This option affects all encyclopedia archive pages.') ?></p>
  </td>
</tr>

<tr>
  <th><label for="prefix_filter_for_archives"><?php echo I18n::t('Prefix filter') ?></label></th>
  <td>
		<select name="prefix_filter_for_archives" id="prefix_filter_for_archives">
			<option value="1" <?php selected(Options::get('prefix_filter_for_archives')) ?> ><?php echo I18n::t('On') ?></option>
			<option value="0" <?php selected(!Options::get('prefix_filter_for_archives')) ?> ><?php echo I18n::t('Off') ?></option>
		</select>
		<p class="help"><?php echo I18n::t('Enables or disables the prefix filter above the encyclopedia archive.') ?></p>
	</td>
</tr>

<tr>
	<th><label for="prefix_filter_archive_depth"><?php echo I18n::t('Prefix filter depth') ?></label></th>
	<td>
    <input type="number" name="prefix_filter_archive_depth" id="prefix_filter_archive_depth" value="<?php echo Options::get('prefix_filter_archive_depth') ?>" min="1" max="<?php echo PHP_INT_MAX ?>" step="1">
    <p class="help"><?php echo I18n::t('The depth of the prefix filter is usually the number of lines with prefixes which are shown.') ?></p>
  </td>
</tr>
</table>
