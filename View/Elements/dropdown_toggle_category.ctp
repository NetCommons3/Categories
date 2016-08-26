<?php
/**
 * Dropdown toggle element of category
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<?php if (isset($options['displayMenu']) && $options['displayMenu']) : ?>
	<div class="dropdown btn-group">
		<button type="button" class="btn btn-default category-dropdown-toggle dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<div class="clearfix">
				<div class="pull-left nc-category-ellipsis">
					<?php echo h($options['categories'][$currentCategoryId]['name']); ?>
				</div>
				<div class="pull-right">
					<span class="caret"></span>
				</div>
			</div>
		</button>
		<ul class="dropdown-menu" role="menu">
<?php endif; ?>

<?php if (isset($options['header']) && $options['header']) : ?>
	<li class="dropdown-header">
		<?php echo $options['header']; ?>
	</li>
<?php endif; ?>

<?php foreach ($options['categories'] as $key => $category) : ?>
	<li>
		<?php echo $this->Html->link($category['name'], Hash::merge($options['url'], array('category_id' => $category['id']))); ?>
	</li>
<?php endforeach; ?>

<?php if (isset($options['divider']) && $options['divider']) : ?>
	<li class="divider"></li>
<?php endif; ?>

<?php if (isset($options['displayMenu']) && $options['displayMenu']) : ?>
		</ul>
	</div>
<?php endif;
