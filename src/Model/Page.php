<?php
namespace Adx\PagesModule\Model;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "pages".
 *
 * @property string $title
 * @property string $slug
 * @property string $meta_title
 * @property string $meta_description
 * @property string $content
 * @property string $template
 * @property string $comment
 * @property boolean $noindex
 * @property boolean $nofollow
 * @property boolean $enabled
 * @property string $updated_at
 * @property string $created_at
 */
class Page extends ActiveRecord implements SlugAwareInterface
{
    use SlugGeneratorTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'meta_title', 'meta_description', 'content', 'template', 'comment'], 'string'],
            [['slug'], 'unique'],
            [['noindex', 'nofollow', 'enabled'], 'boolean'],
            [['updated_at', 'created_at'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
        ];
    }

    /**
     * Return page id or null, if is it new record
     * 
     * @return int|null
     */
    public function getId()
    {
        return $this->page_id;
    }

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @inheritdoc
     */
    public function setTitle($title)
    {
        $this->title = (string) $title;
    }

    /**
     * @inheritdoc
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @inheritdoc
     */
    public function setSlug($slug)
    {
        $this->slug = (string) $slug;
    }

    /**
     * Check is enabled.
     * 
     * @return bool
     */
    public function isEnabled()
    {
        return (bool) $this->enabled;
    }

    /**
     * Set enabled/disabled state.
     * 
     * @param bool $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = (bool) $enabled;
    }

    /**
     * Set enabled state.
     *
     * @return void
     */
    public function enable()
    {
        $this->enabled = true;
    }

    /**
     * Set disabled state.
     *
     * @return void
     */
    public function disable()
    {
        $this->enabled = false;
    }
}
