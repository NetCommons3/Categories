Categories
==============

Categories for NetComomns3

[![Build Status](https://api.travis-ci.org/NetCommons3/Categories.png?branch=master)](https://travis-ci.org/NetCommons3/Categories)
[![Coverage Status](https://coveralls.io/repos/NetCommons3/Categories/badge.png?branch=master)](https://coveralls.io/r/NetCommons3/Categories?branch=master)

| dependencies  | status |
| ------------- | ------ |
| composer.json | [![Dependency Status](https://www.versioneye.com/user/projects/54fd286dfcd47ac3bb0000d2/badge.png)](https://www.versioneye.com/user/projects/54fd286dfcd47ac3bb0000d2) |

### 概要

コンテンツをカテゴリー毎に分類できます。<br>
分類するためにコンテンツのテーブルには'category_id'が必要です。<br>
コンテンツ登録時のカテゴリー選択、コンテンツ一覧のカテゴリー絞り込みを行う場合はCategoriesComponentを定義してください。<br>
CategoryHelperは、CategoriesComponentで追加されます。

#### [CategoriesComponent](https://github.com/NetCommons3/NetCommons3Docs/blob/master/phpdocMd/Categories/CategoriesComponent.md#categoriescomponent)
#### [CategoryHelper](https://github.com/NetCommons3/NetCommons3Docs/blob/master/phpdocMd/Categories/CategoryHelper.md#categoryhelper)


カテゴリーデータを登録する場合は、CategoryEditComponent、CategoryBehaviorを定義してください。<br>
カテゴリーデータはブロック毎に保持します。<br>

#### [CategoryEditComponent](https://github.com/NetCommons3/NetCommons3Docs/blob/master/phpdocMd/Categories/CategoryEditComponent.md#categoryeditcomponent)
#### [CategoryBehavior](https://github.com/NetCommons3/NetCommons3Docs/blob/master/phpdocMd/Categories/CategoryBehavior.md#categorybehavior)
