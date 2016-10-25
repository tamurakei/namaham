<?php Namespace WordPress\Plugin\Encyclopedia ?>

<table class="form-table">
<tr>
  <th><label for="related_terms"><?php echo I18n::t('Display related terms') ?></label></th>
  <td>
		<input type="radio" id="related_terms_below" <?php checked(True) ?>> <label for="related_terms_below"><?php echo I18n::t('below the current entry') ?></label><br>
		<input type="radio" id="related_terms_above" <?php disabled(True) ?>> <label for="related_terms_above"><?php echo I18n::t('above the current entry') ?></label><?php Mocking_Bird::printProNotice('unlock') ?><br>
		<input type="radio" id="related_terms_none" <?php disabled(True) ?>> <label for="related_terms_none"><?php echo I18n::t('Do not show related terms.') ?></label><?php Mocking_Bird::printProNotice('unlock') ?>
	</td>
</tr>

<tr>
  <th><label><?php echo I18n::t('Number of related terms') ?></label></th>
  <td>
    <input type="number" value="10" <?php disabled(True) ?>><?php Mocking_Bird::printProNotice('unlock') ?>
    <p class="help"><?php echo I18n::t('Number of related terms which should be shown.') ?></p>
	</td>
</tr>

<tr>
  <th><label for="prefix_filter_for_singulars"><?php echo I18n::t('Prefix filter') ?></label></th>
  <td>
		<select name="prefix_filter_for_singulars" id="prefix_filter_for_singulars">
			<option value="1" <?php selected(Options::get('prefix_filter_for_singulars')) ?> ><?php echo I18n::t('On') ?></option>
			<option value="0" <?php selected(!Options::get('prefix_filter_for_singulars')) ?> ><?php echo I18n::t('Off') ?></option>
		</select>
		<p class="help"><?php echo I18n::t('Enables or disables the prefix filter above the encyclopedia term.') ?></p>
	</td>
</tr>

<tr>
	<th><label for="prefix_filter_singular_depth"><?php echo I18n::t('Prefix filter depth') ?></label></th>
	<td>
    <input type="number" name="prefix_filter_singular_depth" id="prefix_filter_singular_depth" value="<?php echo Options::get('prefix_filter_singular_depth') ?>" min="1" max="<?php echo PHP_INT_MAX ?>" step="1">
    <p class="help"><?php echo I18n::t('The depth of the prefix filter is usually the number of lines with prefixes which are shown.') ?></p>
  </td>
</tr>
</table>
