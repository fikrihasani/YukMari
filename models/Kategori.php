<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kategori".
 *
 * @property string $id_kategori
 * @property string $nama_kategori
 * @property string $image_kategori
 */
class Kategori extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kategori';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kategori', 'nama_kategori', 'image_kategori'], 'required'],
            [['id_kategori'], 'string', 'max' => 10],
            [['nama_kategori'], 'string', 'max' => 50],
            [['image_kategori'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_kategori' => 'Id Kategori',
            'nama_kategori' => 'Nama Kategori',
            'image_kategori' => 'Image Kategori',
        ];
    }
	
	public function getThread()
	{
		return $this->hasMany(Thread::className(),['kategori_event'=>'id_kategori']);
	}
}
