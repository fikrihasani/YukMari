<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "peserta".
 *
 * @property integer $id_peserta
 * @property integer $User
 * @property integer $Thread
 */
class Peserta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'peserta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Thread','nama_peserta','kontak_hp'], 'required'],
            // ['nama_peserta','unique','message'=>'Nama sudah ada. Siapakah anda?'],
            [['User', 'Thread'], 'integer'],
            [['nama_peserta', 'kontak_hp'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_peserta' => 'Id Peserta',
            'User' => 'User',
            'Thread' => 'Thread',
            'nama_peserta' => 'Nama Lengkap',
            'kontak_hp' => 'Nomor HP',
            'kontak_lain' => 'Kontak Lain',
        ];
    }

    public function getThread()
    {
        return $this->hasMany(Thread::className(), ['id_event' => 'Thread']);
    }
    public function getMember()
    {
        return $this->hasMany(Member::className(), ['id_user' => 'User']);
    }
}
