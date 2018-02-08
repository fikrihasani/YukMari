<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "peserta".
 *
 * @property integer $id_peserta
 * @property integer $User
 * @property integer $Thread
 */
class Partisipan extends \app\models\Peserta
{
  public static function tableName()
  {
      return 'peserta';
  }
}
