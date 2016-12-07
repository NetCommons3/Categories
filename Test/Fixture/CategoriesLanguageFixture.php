<?php
/**
 * CategoriesLanguageFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * CategoriesLanguageFixture
 *
 * @package NetCommons\Categories\Test\Fixture
 */
class CategoriesLanguageFixture extends CakeTestFixture {

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'category_id' => '1',
			'language_id' => '2',
			'name' => 'Category 1',
			'created_user' => '1',
			'created' => '2016-12-06 09:58:24',
			'modified_user' => '1',
			'created' => '2016-12-06 09:58:24',
		),
		array(
			'id' => '2',
			'category_id' => '2',
			'language_id' => '2',
			'name' => 'Category 2',
			'created_user' => '1',
			'created' => '2016-12-06 09:58:24',
			'modified_user' => '1',
			'created' => '2016-12-06 09:58:24',
		),
		array(
			'id' => '3',
			'category_id' => '3',
			'language_id' => '2',
			'name' => 'Category 3',
			'created_user' => '1',
			'created' => '2016-12-06 09:58:24',
			'modified_user' => '1',
			'created' => '2016-12-06 09:58:24',
		),
	);

/**
 * Initialize the fixture.
 *
 * @return void
 */
	public function init() {
		require_once App::pluginPath('Categories') . 'Config' . DS . 'Schema' . DS . 'schema.php';
		$this->fields = (new CategoriesSchema())->tables[Inflector::tableize($this->name)];
		parent::init();
	}

}
