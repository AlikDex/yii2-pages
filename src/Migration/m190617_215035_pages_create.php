<?php

use yii\db\Migration;

/**
 * Class m190617_215035_pages_create
 */
class m190617_215035_pages_create extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('pages', [
            'page_id' => 'int(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'title' => 'varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT \'\'',
            'slug' => 'varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT \'\'',
            'meta_title' => 'varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT \'\'',
            'meta_description' => 'varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT \'\'',
            'content' => 'TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL',
            'template' => 'varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT \'\'',
            'comment' => 'varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT \'\'',
            'noindex' => 'tinyint(1) UNSIGNED NOT NULL DEFAULT 0',
            'nofollow' => 'tinyint(1) UNSIGNED NOT NULL DEFAULT 0',
            'enabled' => 'tinyint(1) UNSIGNED NOT NULL DEFAULT 0',
            'updated_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'created_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
        ], $tableOptions);

        $this->createIndex('slug', 'pages', 'slug', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190617_215035_pages_create cannot be reverted.\n";

        return false;
    }
}
