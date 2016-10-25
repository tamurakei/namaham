<?php Namespace WordPress\Plugin\Encyclopedia ?>

<table class="form-table">
<tr>
  <th><label for="enable_editor"><?php echo I18n::t('Text Editor') ?></label></th>
  <td>
		<select name="enable_editor" id="enable_editor">
			<option value="1" <?php selected(Options::get('enable_editor')) ?> ><?php echo I18n::t('On') ?></option>
			<option value="0" <?php selected(!Options::get('enable_editor')) ?> ><?php echo I18n::t('Off') ?></option>
		</select>
		<p class="help"><?php echo I18n::t('Enables or disables the text editor for the terms.') ?></p>
	</td>
</tr>

<tr>
  <th><label for="enable_excerpt"><?php echo I18n::t('Excerpt') ?></label></th>
  <td>
		<select name="enable_excerpt" id="enable_excerpt">
			<option value="1" <?php selected(Options::get('enable_excerpt')) ?> ><?php echo I18n::t('On') ?></option>
			<option value="0" <?php selected(!Options::get('enable_excerpt')) ?> ><?php echo I18n::t('Off') ?></option>
		</select>
    <p class="help"><?php echo I18n::t('Enables or disables the text excerpt for the terms.') ?></p>
	</td>
</tr>

<tr>
  <th><label><?php echo I18n::t('Revisions') ?></label></th>
  <td>
		<select <?php disabled(True) ?> >
			<option <?php disabled(True) ?>><?php echo I18n::t('On') ?></option>
			<option <?php selected(True) ?>><?php echo I18n::t('Off') ?></option>
		</select><?php Mocking_Bird::printProNotice('unlock') ?>
		<p class="help"><?php echo I18n::t('Enables or disables revisions for the terms.') ?></p>
	</td>
</tr>

<tr>
  <th><label><?php echo I18n::t('Comments &amp; Trackbacks') ?></label></th>
  <td>
		<select <?php disabled(True) ?> >
			<option <?php disabled(True) ?> ><?php echo I18n::t('On') ?></option>
			<option <?php selected(True) ?>><?php echo I18n::t('Off') ?></option>
		</select><?php Mocking_Bird::printProNotice('unlock') ?>
		<p class="help"><?php echo I18n::t('Enables or disables comments and trackbacks for the terms.') ?></p>
	</td>
</tr>

<tr>
  <th><label><?php echo I18n::t('Featured Image') ?></label></th>
  <td>
		<select <?php disabled(True) ?> >
			<option <?php disabled(True) ?> ><?php echo I18n::t('On') ?></option>
			<option <?php selected(True) ?>><?php echo I18n::t('Off') ?></option>
		</select><?php Mocking_Bird::printProNotice('unlock') ?>
		<p class="help"><?php echo I18n::t('Enables or disables the featured image for the terms.') ?></p>
	</td>
</tr>

<tr>
  <th><label for="enable_custom_fields"><?php echo I18n::t('Custom Fields') ?></label></th>
  <td>
		<select name="enable_custom_fields" id="enable_custom_fields">
			<option value="1" <?php selected(Options::get('enable_custom_fields')) ?> ><?php echo I18n::t('On') ?></option>
			<option value="0" <?php selected(!Options::get('enable_custom_fields')) ?> ><?php echo I18n::t('Off') ?></option>
		</select>
		<p class="help"><?php echo I18n::t('Enables or disables custom fields for the terms.') ?></p>
	</td>
</tr>
</table>
