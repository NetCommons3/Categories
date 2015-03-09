<?php
/**
 * Categories edit element
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Ryo Ozawa <ozawa.ryo@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<div id="nc-categories-<?php echo $frameId; ?>"
	 ng-controller="Categories"
	 ng-init="init(<?php echo h(json_encode($this->viewVars)); ?>)">

	<?php echo $this->Form->create('Faq',
		array(
			'name' => 'CategoryForm' . $frameId,
			'novalidate' => true,
		)); ?>

		<?php echo $this->element('Categories.Categories/form_category'); ?>

		<p class="text-center">
			<button class="btn btn-default" ng-click="cancel()">
				<span class="glyphicon glyphicon-remove small"></span>
				<?php echo __d('net_commons', 'Cancel'); ?>
			</button>
			<button class="btn btn-primary">
				<?php echo __d('net_commons', 'OK'); ?>
			</button>
		</p>

	<?php echo $this->Form->end(); ?>
</div>