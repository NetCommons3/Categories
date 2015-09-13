<?php
/**
 * Category Helper
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('AppHelper', 'View/Helper');

/**
 * Category Helper
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Categories\View\Helper
 */
class CategoryHelper extends AppHelper {

/**
 * Other helpers used by FormHelper
 *
 * @var array
 */
	public $helpers = array(
		'Html',
		'NetCommons.NetCommonsForm',
		'NetCommons.NetCommonsHtml',
	);

/**
 * Before render callback. beforeRender is called before the view file is rendered.
 *
 * Overridden in subclasses.
 *
 * @param string $viewFile The view file that is going to be rendered
 * @return void
 */
	public function beforeRender($viewFile) {
		$this->NetCommonsHtml->css('/categories/css/style.css');
		parent::beforeRender($viewFile);
	}

/**
 * Output categories drop down toggle
 *
 * #### Options
 *
 *   - `empty`: String is empty label.
 * 　- `header`: String is header label.
 * 　- `divider`: True is divider.
 *   - `displayMenu`: True is display menu. False is <li> tag only.
 *   - `displayEmpty`: True is empty display. False is not display.
 *
 * @param array $options Array of options and HTML arguments.
 * @return string HTML tags
 */
	public function dropDownToggle($options = array()) {
		//カレントCategoryId
		if (isset($this->_View->params['named']['category_id'])) {
			$currentCategoryId = $this->_View->params['named']['category_id'];
		} else {
			$currentCategoryId = '0';
		}

		//URLのセット
		if (! isset($options['url'])) {
			$options['url'] = array(
				'plugin' => $this->_View->params['plugin'],
				'controller' => $this->_View->params['controller'],
				'action' => $this->_View->params['action'],
				Current::read('Frame.id')
			);
		}

		//オプションのセット
		if (isset($options['empty']) && $options['empty']) {
			if (is_string($options['empty'])) {
				$name = $options['empty']; //呼び出しもとでhtmlspecialcharsする
			} else {
				$name = __d('categories', 'Select Category');
			}
			$options['categories'] = array(
				'0' => array('id' => null, 'name' => $name),
			);
		} else {
			$options['categories'] = array();
		}
		$options['categories'] = Hash::merge($options['categories'], Hash::combine($this->_View->viewVars['categories'], '{n}.Category.id', '{n}.Category'));

		if (isset($options['header']) && $options['header']) {
			if (! is_string($options['header'])) {
				$options['header'] = __d('categories', 'Category');
			}
		}

		return $this->_View->element('Categories.dropdown_toggle_category', array(
			'currentCategoryId' => $currentCategoryId,
			'options' => $options
		));
	}

/**
 * Output categories select element
 *
 * @param string $fieldName This should be "Modelname.fieldname"
 * @param array $attributes Array of attributes and HTML arguments.
 * @return string HTML tags
 */
	public function select($fieldName, $attributes = array()) {
		$output = '';
		if (! isset($this->_View->viewVars['categories']) ||
				! is_array($this->_View->viewVars['categories']) ||
				count($this->_View->viewVars['categories']) === 0) {
			return $output;
		}
		if (isset($attributes['empty']) && $attributes['empty'] === true) {
			$attributes['empty'] = array(0 => __d('categories', 'Select Category'));
		}

		$categories = Hash::combine($this->_View->viewVars['categories'], '{n}.Category.id', '{n}.Category.name');
		$output .= $this->NetCommonsForm->input($fieldName, Hash::merge(array(
			'label' => __d('categories', 'Category'),
			'type' => 'select',
			'options' => $categories,
		), $attributes));

		return $output;
	}
}
