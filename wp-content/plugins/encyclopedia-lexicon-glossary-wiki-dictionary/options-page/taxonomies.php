<?php Namespace WordPress\Plugin\Encyclopedia ?>

<table class="form-table">
<tr>
  <th><label><?php echo I18n::t('Categories') ?></label></th>
  <td>
		<select <?php disabled(True) ?>>
			<option <?php disabled(True) ?> ><?php echo I18n::t('On') ?></option>
			<option <?php selected(True) ?> ><?php echo I18n::t('Off') ?></option>
		</select><?php Mocking_Bird::printProNotice('unlock') ?>
    <p class="help"><?php echo I18n::t('Categories could help you structuring an awesome knowledge base.') ?></p>
	</td>
</tr>

<tr>
  <th><label for="encyclopedia_tags"><?php echo I18n::t('Tags') ?></label></th>
  <td>
		<select name="encyclopedia_tags" id="encyclopedia_tags">
			<option value="1" <?php selected(Options::get('encyclopedia_tags')) ?> ><?php echo I18n::t('On') ?></option>
			<option value="0" <?php selected(!Options::get('encyclopedia_tags')) ?> ><?php echo I18n::t('Off') ?></option>
		</select>
    <p class="help"><?php echo I18n::t('Tags are necessary to create relations between entries automatically.') ?></p>
	</td>
</tr>
</table>

<p><?php Mocking_Bird::printProNotice('custom_tax') ?></p>
