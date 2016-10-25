<div class="encyclopedia-prefix-filters">
<?php
/* Use the $filter var to access all available filters */

foreach ($filter as $filter_line): ?>

	<div class="encyclopedia-filter">

		<?php foreach ($filter_line as $element): ?>
			<span class="filter <?php echo ($element->active) ? 'current-filter ' : ''; echo ($element->disabled) ? 'disabled-filter ' : '' ?>">
				<?php if ($element->disabled): ?>
          <span class="filter-link">
        <?php else: ?>
          <a href="<?php echo $element->link ?>" class="filter-link">
        <?php endif ?>

        <?php echo HTMLEntities($element->filter, Null, 'UTF-8') ?>

        <?php if ($element->disabled): ?>
          </span>
        <?php else: ?>
          </a>
        <?php endif ?>
			</span>
		<?php endforeach ?>

	</div>

<?php endforeach ?>
</div>