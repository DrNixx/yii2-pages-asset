<?php
namespace onix\assets;

use yii\web\AssetBundle;

class PagesAsset extends AssetBundle
{
    public $sourcePath = '@common/resources/pages';

    public $js = [
        'js/pages.js',
        'js/pages.jquery-wrapper.js',
    ];

    public $css = [
        'css/pages-icons.css',
        'css/pages.css',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'onix\assets\FontAwesomeAsset',
        'onix\assets\UnveilAsset',
        'onix\assets\JqueryScrollBarAsset',
        'onix\assets\MousewheelAsset',
    ];

    public function init()
    {
        parent::init();

        $this->publishOptions['beforeCopy'] = function ($from, $to) {
            if (is_dir($from)) {
                $dirname = basename($from);
                return $dirname !== 'modules';
            } else {
                $ext = pathinfo($from, PATHINFO_EXTENSION);
                switch ($ext) {
                    case 'scss':
                    case 'less':
                        return false;
                    default:
                        return true;
                }
            }
        };
    }
}
