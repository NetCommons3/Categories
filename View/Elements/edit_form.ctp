<?php
/**
 * Element of Categories edit form
 *   - $categories:
 *       The results data of Category->getCategories(), and The formatter is camelized data.
 *   - $cancelUrl: Cancel url.
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

echo $this->element('Categories.edit_form_common');
$categories = NetCommonsAppController::camelizeKeyRecursive($this->data['Categories']);
?>

<div class="panel panel-default" ng-controller="Categories" ng-init="initialize(<?php echo h(json_encode(['categories' => $categories])); ?>)">
	<div class="panel-heading">
		<?php echo __d('categories', 'Category'); ?>
	</div>

	<div class="panel-body">
		<div class="form-group clearfix">
			<div class="pull-left">
				<?php echo $this->NetCommonsForm->error('category_name'); ?>
			</div>

			<div class="pull-right">
				<?php echo $this->Button->add(null, ['ng-click' => 'add()', 'type' => 'button']); ?>
			</div>
		</div>

		<?php echo $this->element('Categories.edit_form_categories'); ?>
	</div>
</div>

