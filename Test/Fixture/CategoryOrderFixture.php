<?php
/**
 * CategoryOrderFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Ryo Ozawa <ozawa.ryo@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * CategoryOrderFixture
 */
class CategoryOrderFixture extends CakeTestFixture {

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'category_key' => 'category_1',
			'block_key' => 'block_1',
			'weight' => 1,
			'created_user' => 1,
			'created' => '2015-01-28 04:57:05',
			'modified_user' => 1,
			'modified' => '2015-01-28 04:57:05'
		),
		array(
			'id' => 2,
			'category_key' => 'category_2',
			'block_key' => 'block_1',
			'weight' => 2,
			'created_user' => 1,
			'created' => '2015-01-28 04:57:05',
			'modified_user' => 1,
			'modified' => '2015-01-28 04:57:05'
		),
		array(
			'id' => 3,
			'category_key' => 'category_3',
			'block_key' => 'block_1',
			'weight' => 3,
			'created_user' => 1,
			'created' => '2015-01-28 04:57:05',
			'modified_user' => 1,
			'modified' => '2015-01-28 04:57:05'
		),

		//Faqs plugin
		array(
			'id' => 100,
			'category_key' => 'category_100',
			'block_key' => 'block_100',
			'weight' => 1,
			'created_user' => 1,
			'created' => '2015-01-28 04:57:05',
			'modified_user' => 1,
			'modified' => '2015-01-28 04:57:05'
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
