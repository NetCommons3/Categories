<?php
/**
 * AddIndex migration
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * AddIndex migration
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Categories\Config\Migration
 */
class AddIndex extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'add_index';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'alter_field' => array(
				'categories' => array(
					'block_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index', 'comment' => 'ブロックID'),
				),
				'category_orders' => array(
					'category_key' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'index', 'collate' => 'utf8_general_ci', 'comment' => 'カテゴリーKey', 'charset' => 'utf8'),
				),
			),
			'create_field' => array(
				'categories' => array(
					'indexes' => array(
						'block_id' => array('column' => 'block_id', 'unique' => 0),
					),
				),
				'category_orders' => array(
					'indexes' => array(
						'category_key' => array('column' => 'category_key', 'unique' => 0),
					),
				),
			),
		),
		'down' => array(
			'alter_field' => array(
				'categories' => array(
					'block_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'comment' => 'ブロックID'),
				),
				'category_orders' => array(
					'category_key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'カテゴリーKey', 'charset' => 'utf8'),
				),
			),
			'drop_field' => array(
				'categories' => array('indexes' => array('block_id')),
				'category_orders' => array('indexes' => array('category_key')),
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function after($direction) {
		return true;
	}
}
