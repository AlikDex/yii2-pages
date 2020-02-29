<?php
namespace Adx\PagesModule\Form\Admin;

use yii\base\Model;

/**
 * Модель для обработки формы создания\редактирования страницы.
 */
class PageForm extends Model
{
    public $title;
    public $slug;
    public $meta_title;
    public $meta_description;
    public $content;
    public $template;
    public $comment;
    public $noindex;
    public $nofollow;
    public $enabled;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'slug', 'meta_title', 'meta_description', 'content', 'template', 'comment'], 'string'],
            [['noindex', 'nofollow', 'enabled'], 'boolean'],

            [['noindex', 'nofollow', 'enabled'], 'default', 'value' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function formName()
    {
        return '';
    }

    /**
     * Валидирует форму и возвращает результат валидации.
     * true если все правила успешно пройдены.
     *
     * @return boolean
     */
    public function isValid()
    {
        return $this->validate();
    }
}
