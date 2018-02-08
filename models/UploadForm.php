<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
  public $imageFile;
	public $nameFile;
	public $memberFile;
    public function rules()
    {
        return [
            [['memberFile'],'required'],
			 [['memberFile'],'file','extensions'=>'xlsx, xls','maxSize'=>1024 * 1024 * 5],
        ];
    }

}
?>
