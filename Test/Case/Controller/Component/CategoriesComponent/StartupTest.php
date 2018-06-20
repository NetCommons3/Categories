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

		Current::write('Language.id', '2');

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
 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
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
				),
				//'Block' => array(
				//	'id' => '2',
				//	'room_id' => '2',
				//	'plugin_key' => 'categories',
				//	'key' => 'block_1',
				//	'public_type' => '1',
				//	'publish_start' => null,
				//	'publish_end' => null,
				//	'content_count' => '0',
				//),
				//'TrackableCreator' => array(
				//	'id' => '1', 'handlename' => 'System Administrator',
				//),
				//'TrackableUpdater' => array(
				//	'id' => '1', 'handlename' => 'System Administrator',
				//),
				'CategoryOrder' => array(
					'id' => '1',
					'category_key' => 'category_1',
					'block_key' => 'block_1',
					'weight' => '1',
				),
				'CategoriesLanguage' => array(
					'id' => '1',
					'language_id' => '2',
					'category_id' => '1',
					'name' => 'Category 1',
					//'is_origin' => true,
					//'is_translation' => false,
				),
			),
			1 => array(
				'Category' => array(
					'id' => '2',
					'block_id' => '2',
					'key' => 'category_2',
				),
				//'Block' => array(
				//	'id' => '2',
				//	'room_id' => '2',
				//	'plugin_key' => 'categories',
				//	'key' => 'block_1',
				//	'public_type' => '1',
				//	'publish_start' => null,
				//	'publish_end' => null,
				//	'content_count' => '0',
				//),
				//'TrackableCreator' => array(
				//	'id' => '1', 'handlename' => 'System Administrator',
				//),
				//'TrackableUpdater' => array(
				//	'id' => '1', 'handlename' => 'System Administrator',
				//),
				'CategoryOrder' => array(
					'id' => '2',
					'category_key' => 'category_2',
					'block_key' => 'block_1',
					'weight' => '2',
				),
				'CategoriesLanguage' => array(
					'id' => '2',
					'language_id' => '2',
					'category_id' => '2',
					'name' => 'Category 2',
					//'is_origin' => true,
					//'is_translation' => false,
				),
			),
			2 => array(
				'Category' => array(
					'id' => '3',
					'block_id' => '2',
					'key' => 'category_3',
				),
				//'Block' => array(
				//	'id' => '2',
				//	'room_id' => '2',
				//	'plugin_key' => 'categories',
				//	'key' => 'block_1',
				//	'public_type' => '1',
				//	'publish_start' => null,
				//	'publish_end' => null,
				//	'content_count' => '0',
				//),
				//'TrackableCreator' => array(
				//	'id' => '1', 'handlename' => 'System Administrator',
				//),
				//'TrackableUpdater' => array(
				//	'id' => '1', 'handlename' => 'System Administrator',
				//),
				'CategoryOrder' => array(
					'id' => '3',
					'category_key' => 'category_3',
					'block_key' => 'block_1',
					'weight' => '3',
				),
				'CategoriesLanguage' => array(
					'id' => '3',
					'language_id' => '2',
					'category_id' => '3',
					'name' => 'Category 3',
					//'is_origin' => true,
					//'is_translation' => false,
				),
			),
		);

		$actual = $this->vars['categories'];
		//$actual = Hash::remove($actual, '{n}.{s}.created_user');
		//$actual = Hash::remove($actual, '{n}.{s}.created');
		//$actual = Hash::remove($actual, '{n}.{s}.modified_user');
		//$actual = Hash::remove($actual, '{n}.{s}.modified');

		$this->assertEquals($actual, $expected);
		$this->assertTrue(in_array('Categories.Category', $this->controller->helpers, true));
	}

}
