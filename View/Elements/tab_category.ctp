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

<ul class="nav nav-tabs">
<?php foreach ($options['categories'] as $key => $category) : ?>
	<li role="presentation" 
		<?php if ($category['id'] == $currentCategoryId) {
			echo 'class="active"';
								} ?>>
		<?php echo $this->Html->link($category['name'], Hash::merge($options['url'], array('category_id' => $category['id']))); ?>
	</li>
<?php endforeach; ?>
</ul>
