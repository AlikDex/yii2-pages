<?php
namespace Adx\PageModule\Asset;

use yii\web\AssetBundle;

class TinymceAsset extends AssetBundle
{
    public $sourcePath = '@vendor/tinymce/tinymce';

    public $js = [
        'tinymce.min.js'
    ];
}