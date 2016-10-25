<?php Namespace WordPress\Plugin\Encyclopedia ?>

<table class="form-table">
<tr>
  <th><label><?php echo I18n::t('Query terms directly') ?></label></th>
  <td>
  	<select <?php disabled(True) ?>>
  		<option <?php disabled(True) ?>><?php echo I18n::t('On') ?></option>
  		<option <?php selected(True) ?>><?php echo I18n::t('Off') ?></option>
  	</select><?php Mocking_Bird::printProNotice('unlock') ?>
    <p class="help"><?php echo I18n::t('Enable this feature to redirect the user to the term if he searched for its exactly title.') ?></p>
  </td>
</tr>

<tr>
  <th><label><?php echo I18n::t('Autocomplete min length') ?></label></th>
  <td>
    <input type="number" value="2" <?php disabled(True) ?>>
    <?php echo I18n::t('characters', 'characters unit') ?><?php Mocking_Bird::printProNotice('unlock') ?>
    <p class="help"><?php echo I18n::t('The minimum number of characters a user must type before suggestions will be shown.') ?></p>
  </td>
</tr>

<tr>
  <th><label><?php echo I18n::t('Autocomplete delay') ?></label></th>
  <td>
    <input type="number" value="400" <?php disabled(True) ?>>
    <?php echo I18n::t('ms', 'milliseconds time unit') ?><?php Mocking_Bird::printProNotice('unlock') ?>
    <p class="help"><?php echo I18n::t('The delay in milliseconds between a keystroke occurs and the suggestions will be shown.') ?></p>
  </td>
</tr>
</table>
