<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * CLass m141208_201480_blog_init
 * @package funson86\cms\migrations
 *
 * Create blog tables.
 *
 * This will create 2 tables:
 * - `{{%cms_catalog}}` - Cms catalog or page
 * - `{{%cms_show}}` - Cms page of list item
 */
class m141208_201481_cms_init extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // MySql table options
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        // table cms_catalog
        $this->createTable(
            '{{%cms_catalog}}',
            [
                'id' => Schema::TYPE_PK,
                'parent_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
                'title' => Schema::TYPE_STRING . '(255) NOT NULL',
                'surname' => Schema::TYPE_STRING . '(255) DEFAULT NULL',
                'brief' => Schema::TYPE_STRING . '(1022) DEFAULT NULL',
                'content' => Schema::TYPE_TEXT . ' DEFAULT NULL',
                'seo_title' => Schema::TYPE_STRING . '(255)',
                'seo_keywords' => Schema::TYPE_STRING . '(255)',
                'seo_description' => Schema::TYPE_STRING . '(255)',
                'banner' => Schema::TYPE_STRING . '(255)',
                'is_nav' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
                'sort_order' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 50',
                'page_type' => Schema::TYPE_STRING . ' NOT NULL DEFAULT "page"',
                'page_size' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 10',
                'template_list' => Schema::TYPE_STRING . '(255) NOT NULL DEFAULT "list"',
                'template_show' => Schema::TYPE_STRING . '(255) NOT NULL DEFAULT "show"',
                'template_page' => Schema::TYPE_STRING . '(255) NOT NULL DEFAULT "page"',
                'redirect_url' => Schema::TYPE_STRING . '(255) DEFAULT NULL',
                'click' => Schema::TYPE_INTEGER . ' DEFAULT 0',
                'status' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
                'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
                'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL'
            ],
            $tableOptions
        );

        // Indexes
        $this->createIndex('is_nav', '{{%cms_catalog}}', 'is_nav');
        $this->createIndex('sort_order', '{{%cms_catalog}}', 'sort_order');
        $this->createIndex('status', '{{%cms_catalog}}', 'status');
        $this->createIndex('created_at', '{{%cms_catalog}}', 'created_at');


        // table cms_show
        $this->createTable(
            '{{%cms_show}}',
            [
                'id' => Schema::TYPE_PK,
                'catalog_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
                'title' => Schema::TYPE_STRING . '(255) NOT NULL',
                'surname' => Schema::TYPE_STRING . '(128) DEFAULT NULL',
                'brief' => Schema::TYPE_STRING . '(1022) DEFAULT NULL',
                'content' => Schema::TYPE_TEXT . ' DEFAULT NULL',
                'seo_title' => Schema::TYPE_STRING . '(255)',
                'seo_keywords' => Schema::TYPE_STRING . '(255)',
                'seo_description' => Schema::TYPE_STRING . '(255)',
                'banner' => Schema::TYPE_STRING . '(255)',
                'template_show' => Schema::TYPE_STRING . '(255) NOT NULL DEFAULT "show"',
                'author' => Schema::TYPE_STRING . '(255) NOT NULL DEFAULT "admin"',
                'click' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
                'status' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
                'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
                'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL'
            ],
            $tableOptions
        );

        // Indexes
        $this->createIndex('catalog_id', '{{%cms_show}}', 'catalog_id');
        $this->createIndex('status', '{{%cms_show}}', 'status');
        $this->createIndex('created_at', '{{%cms_show}}', 'created_at');

        // Foreign Keys
        $this->addForeignKey('FK_cms_catalog', '{{%cms_show}}', 'catalog_id', '{{%cms_catalog}}', 'id', 'CASCADE', 'CASCADE');

        // Add super-administrator
        //$this->execute($this->getUserSql());
        //$this->execute($this->getProfileSql());
    }

    /**
     * @return string SQL to insert first user
     */
    private function getUserSql()
    {
        $time = time();
        $password_hash = Yii::$app->security->generatePasswordHash('admin12345');
        $auth_key = Yii::$app->security->generateRandomString();
        $token = Security::generateExpiringRandomString();
        return "INSERT INTO {{%users}} (`username`, `email`, `password_hash`, `auth_key`, `token`, `role`, `status_id`, `created_at`, `updated_at`) VALUES ('admin', 'admin@demo.com', '$password_hash', '$auth_key', '$token', 'superadmin', 1, $time, $time)";
    }


    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%cms_show}}');
        $this->dropTable('{{%cms_catalog}}');
    }
}
