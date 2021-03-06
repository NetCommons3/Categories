<?php
/**
 * CategoryFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * CategoryFixture
 *
 * @package NetCommons\Categories\Test\Fixture
 */
class CategoryFixture extends CakeTestFixture {

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'block_id' => '2',
			'key' => 'category_1',
			'created_user' => '1',
			'created' => '2015-01-28 04:56:56',
			'modified_user' => '1',
			'modified' => '2015-01-28 04:56:56'
		),
		array(
			'id' => '2',
			'block_id' => '2',
			'key' => 'category_2',
			'created_user' => '1',
			'created' => '2015-01-28 04:56:56',
			'modified_user' => '1',
			'modified' => '2015-01-28 04:56:56'
		),
		array(
			'id' => '3',
			'block_id' => '2',
			'key' => 'category_3',
			'created_user' => '1',
			'created' => '2015-01-28 04:56:56',
			'modified_user' => '1',
			'modified' => '2015-01-28 04:56:56'
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
