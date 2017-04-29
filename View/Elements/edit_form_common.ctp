<?php
/**
 * Element of Categories edit form
 *   - $categories:
 *       The results data of Category->getCategories(), and The formatter is camelized data.
 *   - $cancelUrl: Cancel url.
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

echo $this->NetCommonsHtml->script('/categories/js/categories.js');

if (! isset($this->request->data['Categories'])) {
	$this->request->data['Categories'] = array();
}
if (! isset($this->request->data['CategoryMap'])) {
	$this->request->data['CategoryMap'] = array();
}
?>

<?php
	foreach ($this->request->data['CategoryMap'] as $category) {
		echo $this->NetCommonsForm->hidden('CategoryMap.' . $category['Category']['id'] . '.Category.id');
		echo $this->NetCommonsForm->hidden('CategoryMap.' . $category['Category']['id'] . '.Category.key');
		echo $this->NetCommonsForm->hidden('CategoryMap.' . $category['Category']['id'] . '.CategoriesLanguage.id');
		echo $this->NetCommonsForm->hidden('CategoryMap.' . $category['Category']['id'] . '.CategoriesLanguage.language_id');
		echo $this->NetCommonsForm->hidden('CategoryMap.' . $category['Category']['id'] . '.CategoryOrder.id');
		echo $this->NetCommonsForm->hidden('CategoryMap.' . $category['Category']['id'] . '.CategoryOrder.key');
		echo $this->NetCommonsForm->hidden('CategoryMap.' . $category['Category']['id'] . '.CategoryOrder.category_key');
	}
?>

<?php $this->NetCommonsForm->unlockField('Categories');
