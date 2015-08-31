<?php
/**
 * Category Behavior
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('ModelBehavior', 'Model');

/**
 * Category Behavior
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Category\Model\Behavior
 */
class CategoryBehavior extends ModelBehavior {

/**
 * beforeValidate is called before a model is validated, you can use this callback to
 * add behavior validation rules into a models validate array. Returning false
 * will allow you to make the validation fail.
 *
 * @param Model $model Model using this behavior
 * @param array $options Options passed from Model::save().
 * @return mixed False or null will abort the operation. Any other result will continue.
 * @see Model::save()
 */
	public function beforeValidate(Model $model, $options = array()) {
		if (! isset($model->data['Categories'])) {
			return true;
		}
		$model->loadModels(array(
			'Category' => 'Categories.Category',
			'CategoryOrder' => 'Categories.CategoryOrder',
		));

		foreach ($model->data['Categories'] as $category) {
			$model->Category->set($category['Category']);
			$model->Category->validates();
			if ($model->Category->validationErrors) {
				$model->validationErrors = Hash::merge($model->validationErrors, $model->Category->validationErrors);
				return false;
			}

			$model->CategoryOrder->set($category['CategoryOrder']);
			$model->CategoryOrder->validates();
			if ($model->CategoryOrder->validationErrors) {
				$model->validationErrors = Hash::merge($model->validationErrors, $model->CategoryOrder->validationErrors);
				return false;
			}
		}
		return true;
	}

/**
 * afterSave is called after a model is saved.
 *
 * @param Model $model Model using this behavior
 * @param bool $created True if this save created a new record
 * @param array $options Options passed from Model::save().
 * @return bool
 * @throws InternalErrorException
 * @see Model::save()
 */
	public function afterSave(Model $model, $created, $options = array()) {
		if (! isset($model->data['Categories'])) {
			return true;
		}
		$model->loadModels(array(
			'Category' => 'Categories.Category',
			'CategoryOrder' => 'Categories.CategoryOrder',
		));

		$categoryKeys = Hash::combine($model->data['Categories'], '{n}.Category.key', '{n}.Category.key');

		//削除処理
		$conditions = array(
			'block_id' => $model->data['Block']['id']
		);
		if ($categoryKeys) {
			$conditions[$model->Category->alias . '.key NOT'] = $categoryKeys;
		}
		if (! $model->Category->deleteAll($conditions, false)) {
			throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
		}

		$conditions = array(
			'block_key' => $model->data['Block']['key']
		);
		if ($categoryKeys) {
			$conditions[$model->CategoryOrder->alias . '.category_key NOT'] = $categoryKeys;
		}
		if (! $model->CategoryOrder->deleteAll($conditions, false)) {
			throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
		}

		//登録処理
		foreach ($model->data['Categories'] as $category) {
			if (! $result = $model->Category->save($category['Category'], false)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			$category['CategoryOrder']['category_key'] = $result['Category']['key'];
			if (! $model->CategoryOrder->save($category['CategoryOrder'], false)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}
		}

		return parent::afterSave($model, $created, $options);
	}

/**
 * Delete categories by blocks.key
 *
 * @param Model $model Model using this behavior
 * @param string $blockKey blocks.key
 * @return bool True on success
 * @throws InternalErrorException
 */
	public function deleteCategoriesByBlockKey(Model $model, $blockKey) {
		$model->loadModels([
			'Category' => 'Categories.Category',
			'CategoryOrder' => 'Categories.CategoryOrder',
			'Block' => 'Blocks.Block',
		]);

		$blocks = $model->Block->find('list', array(
			'recursive' => -1,
			'conditions' => array(
				$model->Block->alias . '.key' => $blockKey
			),
		));
		$blocks = array_keys($blocks);

		//Categoryデータ削除
		if (! $model->Category->deleteAll(array($model->Category->alias . '.block_id' => $blocks), false)) {
			throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
		}

		//CategoryOrderデータ削除
		if (! $model->CategoryOrder->deleteAll(array($model->CategoryOrder->alias . '.block_key' => $blockKey), false)) {
			throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
		}

		return true;
	}

}
