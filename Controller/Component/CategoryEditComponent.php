<?php
/**
 * Categories Component
 *   Before use of this component, please define NetCommonsFrame component,
 *   NetCommonsRoomRole component and Category model in caller.
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('Component', 'Controller');

/**
 * Categories Component
 *
 * 該当ブロックのカテゴリーをViewにセットします。
 *
 * #### サンプルコード
 * ##### コントローラー
 * ```
 * public $components = array(
 * 	'Categories.CategoryEdit'
 * )
 * ```
 * ##### ビュー
 * ```
 *<?php echo $this->element('Categories.edit_form'); ?>
 * ```
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Categories\Controller\Component
 */
class CategoryEditComponent extends Component {

/**
 * Called after the Controller::beforeFilter() and before the controller action
 *
 * @param Controller $controller Controller with components to startup
 * @return void
 * @throws ForbiddenException
 */
	public function startup(Controller $controller) {
		$controller->Category = ClassRegistry::init('Categories.Category');
		$controller->CategoryOrder = ClassRegistry::init('Categories.CategoryOrder');
		$controller->CategoriesLanguage = ClassRegistry::init('Categories.CategoriesLanguage');

		if ($controller->request->is(array('post', 'put'))) {
			$categories = array();
			if (! isset($controller->request->data['Categories'])) {
				$controller->request->data['Categories'] = array();
			}

			foreach ($controller->request->data['Categories'] as $post) {
				if (! isset($post['CategoriesLanguage']['name'])) {
					continue;
				}
				$category = null;
				if (! $post['Category']['id']) {
					$category = $controller->Category->createAll(array(
						'Category' => array(
							'id' => null,
						),
						'CategoriesLanguage' => array(
							'id' => null,
							'name' => $post['CategoriesLanguage']['name'],
							'language_id' => Current::read('Language.id'),
						),
						'CategoryOrder' => array(
							'id' => null,
							'weight' => $post['CategoryOrder']['weight'],
						),
					));
				} else {
					if (isset($controller->request->data['CategoryMap'][$post['Category']['id']])) {
						$category = Hash::merge(
							$post, $controller->request->data['CategoryMap'][$post['Category']['id']]
						);
					} else {
						$controller->request->data['Categories'] = [];
						return $controller->throwBadRequest();
					}
				}
				$category['Category']['block_id'] = $controller->request->data['Block']['id'];
				$category['CategoryOrder']['block_key'] = $controller->request->data['Block']['key'];

				$categories[] = $category;
			}
			$controller->request->data['Categories'] = $categories;
		}

		$this->controler = $controller;
	}

/**
 * Called before the Controller::beforeRender(), and before
 * the view class is loaded, and before Controller::render()
 *
 * @param Controller $controller Controller with components to beforeRender
 * @return void
 * @link http://book.cakephp.org/2.0/en/controllers/components.html#Component::beforeRender
 */
	public function beforeRender(Controller $controller) {
		if (! $controller->request->is(array('post', 'put'))) {
			if (isset($controller->request->data['Block']['id'])) {
				$controller->request->data['Categories'] = $controller->Category->getCategories(
					$controller->request->data['Block']['id'],
					$controller->request->data['Block']['room_id']
				);
				$controller->request->data['CategoryMap'] = Hash::combine(
					$controller->request->data['Categories'], '{n}.Category.id', '{n}'
				);
			} else {
				$controller->request->data['Categories'] = array();
				$controller->request->data['CategoryMap'] = array();
			}
		}

		$this->controler = $controller;
	}

}
