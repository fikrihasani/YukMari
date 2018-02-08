<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id_user
 * @property string $nama_user
 * @property string $tanggal_lahir
 * @property string $alamat_user
 * @property string $email_user
 * @property string $password_user
 * @property string $jenKel
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_user', 'tanggal_lahir', 'alamat_user', 'email_user', 'password_user', 'jenKel'], 'required'],
            [['tanggal_lahir'], 'safe'],
            [['alamat_user'], 'string'],
            [['nama_user', 'password_user'], 'string', 'max' => 20],
            [['email_user'], 'string', 'max' => 50],
            [['jenKel'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'nama_user' => 'Nama User',
            'tanggal_lahir' => 'Tanggal Lahir',
            'alamat_user' => 'Alamat User',
            'email_user' => 'Email User',
            'password_user' => 'Password User',
            'jenKel' => 'Jen Kel',
        ];
    }
}
