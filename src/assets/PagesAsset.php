<?php
namespace onix\assets;

use yii\web\AssetBundle;

class PagesAsset extends AssetBundle
{
    public $sourcePath = '@common/resources/pages';

    public $theme = null;

    public $js = [
        'js/pages.js',
        'js/pages.html.js',
    ];

    public $css = [
        'css/pages.css',
        'css/pages-icons.css',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'onix\assets\FontAwesomeAsset',
        'onix\assets\PaceAsset',
        'onix\assets\UnveilAsset',
        'onix\assets\JqueryScrollBarAsset',
        'onix\assets\MousewheelAsset',
    ];

    public function init()
    {
        parent::init();

        if ($this->theme !== null) {
            $this->css = [
                "css/themes/{$this->theme}/{$this->theme}.css",
                "css/pages-icons.css",
            ];
        } else {
            $this->css = [
                "css/pages.css",
                "css/pages-icons.css",
            ];
        }

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
