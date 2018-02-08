<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminAsset extends AssetBundle
{
  // public $baseUrl = '@app/modules/admin/assets';
  public $sourcePath = '@app/modules/admin/assets';
  public $publishOptions = [
    'forceCopy' => true,
  ];

  public $css = [
      'css/style.css',
      'css/dataTables.bootstrap.css',
      // 'css/admin.css',
  ];
  public $js = [
    'js/jquery.metisMenu.js',
    'js/jquery.dataTables.js',
    'js/dataTables.bootstrap.js',
    'js/custom.js',
    'js/bootstrap.min.js',
  ];
  public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
  public $depends = [
      'yii\web\YiiAsset',
      'yii\bootstrap\BootstrapAsset',
      'yii\web\JqueryAsset',
      '\rmrevin\yii\fontawesome\AssetBundle',
  ];
}
