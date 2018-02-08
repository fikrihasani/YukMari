<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "komentar".
 *
 * @property integer $id_komentar
 * @property string $isi_komentar
 * @property string $tanggal_komentar
 * @property integer $user
 * @property integer $thread
 */
class Komentar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'komentar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['isi_komentar', 'tanggal_komentar', 'id_user', 'id_thread'], 'required'],
            [['isi_komentar'], 'string'],
            [['id_user', 'id_thread'], 'integer'],
            [['tanggal_komentar'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_komentar' => 'Id Komentar',
            'isi_komentar' => 'Isi Komentar',
            'tanggal_komentar' => 'Tanggal Komentar',
            'id_user' => 'User',
            'id_thread' => 'Thread',
            'laporan_komentar' => 'Laporan',
        ];
    }

    public function getMember()
    {
        return $this->hasOne(Member::className(), ['id_user' => 'id_user']);
    }
	public function getThread()
	{
		return $this->hasOne(Thread::className(),['id_event'=>'id_thread']);
	}
}
