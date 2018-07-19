<?php
namespace onix\assets;

use yii\bootstrap4\BootstrapAsset;
use yii\web\AssetBundle as YiiAssetBundle;

class PagesAsset extends YiiAssetBundle
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
        BootstrapAsset::class,
        FontAwesomeAsset::class,
        UnveilAsset::class,
        JqueryScrollBarAsset::class,
        MousewheelAsset::class,
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
