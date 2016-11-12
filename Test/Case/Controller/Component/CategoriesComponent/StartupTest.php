<?php
/**
 * CategoriesComponent::startup()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('CategoriesControllerTestCase', 'Categories.TestSuite');

/**
 * CategoriesComponent::startup()のテスト
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Categories\Test\Case\Controller\Component\CategoriesComponent
 */
class CategoriesComponentStartupTest extends CategoriesControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array();

/**
 * Plugin name
 *
 * @var string
 */
	public $plugin = 'categories';

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		//テストプラグインのロード
		NetCommonsCakeTestCase::loadTestPlugin($this, 'Categories', 'TestCategories');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		//ログアウト
		TestAuthGeneral::logout($this);

		parent::tearDown();
	}

/**
 * startup()のテスト
 *
 * @return void
 */
	public function testStartup() {
		//テストコントローラ生成
		$this->generateNc('TestCategories.TestCategoriesComponent');

		//ログイン
		TestAuthGeneral::login($this);

		//テスト実行
		$this->_testGetAction('/test_categories/test_categories_component/index/2',
				array('method' => 'assertNotEmpty'), null, 'view');

		//チェック
		$pattern = '/' . preg_quote('Controller/Component/TestCategoriesComponent/index', '/') . '/';
		$this->assertRegExp($pattern, $this->view);

		$expected = array(
			0 => array(
				'Category' => array(
					'id' => '1',
					'block_id' => '2',
					'key' => 'category_1',
					'language_id' => '2',
					'name' => 'Category 1',
					'created_user' => '1',
					'created' => '2015-01-28 04:56:56',
					'modified_user' => '1',
					'modified' => '2015-01-28 04:56:56',
				),
				'CategoryOrder' => array(
					'id' => '1',
					'category_key' => 'category_1',
					'block_key' => 'block_1',
					'weight' => '1',
					'created_user' => '1',
					'created' => '2015-01-28 04:57:05',
					'modified_user' => '1',
					'modified' => '2015-01-28 04:57:05',
				),
			),
			1 => array(
				'Category' => array(
					'id' => '2',
					'block_id' => '2',
					'key' => 'category_2',
					'language_id' => '2',
					'name' => 'Category 2',
					'created_user' => '1',
					'created' => '2015-01-28 04:56:56',
					'modified_user' => '1',
					'modified' => '2015-01-28 04:56:56',
				),
				'CategoryOrder' => array(
					'id' => '2',
					'category_key' => 'category_2',
					'block_key' => 'block_1',
					'weight' => '2',
					'created_user' => '1',
					'created' => '2015-01-28 04:57:05',
					'modified_user' => '1',
					'modified' => '2015-01-28 04:57:05',
				),
			),
			2 => array(
				'Category' => array(
					'id' => '3',
					'block_id' => '2',
					'key' => 'category_3',
					'language_id' => '2',
					'name' => 'Category 3',
					'created_user' => '1',
					'created' => '2015-01-28 04:56:56',
					'modified_user' => '1',
					'modified' => '2015-01-28 04:56:56',
				),
				'CategoryOrder' => array(
					'id' => '3',
					'category_key' => 'category_3',
					'block_key' => 'block_1',
					'weight' => '3',
					'created_user' => '1',
					'created' => '2015-01-28 04:57:05',
					'modified_user' => '1',
					'modified' => '2015-01-28 04:57:05',
				),
			),
		);
		$this->assertEquals($this->vars['categories'], $expected);
		$this->assertTrue(in_array('Categories.Category', $this->controller->helpers, true));
	}

}
