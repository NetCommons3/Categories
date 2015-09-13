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
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Categories\Controller\Component
 */
class CategoriesComponent extends Component {

/**
 * use component
 *
 * @var array
 */
	public $components = array();

/**
 * Called after the Controller::beforeFilter() and before the controller action
 *
 * @param Controller $controller Controller with components to startup
 * @return void
 * @throws ForbiddenException
 */
	public function startup(Controller $controller) {
		$this->controller = $controller;
		$this->controller->Category = ClassRegistry::init('Categories.Category');

		$result = $this->controller->Category->getCategories(
			Current::read('Block.id'),
			Current::read('Block.room_id')
		);
		$this->controller->set('categories', $result);

		if (! in_array('Categories.Category', $this->controller->helpers)) {
			$this->controller->helpers[] = 'Categories.Category';
		}
	}
}
