<?php

namespace app\models;

use Yii;

class Member extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
         return [
            [['username','nama_user', 'tanggal_lahir','alamat_user','password_user','jenKel','email_user','hp_user'], 'required'],
            ['email_user', 'email'],
            [['foto_profil'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            ['username','unique','message'=>'Username sudah ada'],
          ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' =>  'Username',
            'nama_user' =>  'Nama',
            'tanggal_lahir' => 'Tanggal Lahir',
            'hp_user'=>'Nomor HP untuk dihubungi',
            'alamat_user' => 'Alamat',
            'email_user' =>  'Email',
            'password_user'=>'Password',
            'jenKel'=>'Jenis Kelamin',
            'foto_profil'=>'Foto Profil',
        ];
    }

    // fungsi biasa
    public function getAll(){
      $data = User::find()->all();
      return $data;
    }

    public function getProfile($id){
      $data = User::find()->where(['id_user'=>$id])->one();
      return $data;
    }

    public function getThread()
    {
        return $this->hasMany(Thread::className(), ['user_pembuat' => 'id_user']);
    }
    //
    public function getPeserta()
    {
        return $this->hasMany(Peserta::className(), ['User' => 'id_user']);
    }
    public function getKomentar()
	{
      return $this->hasMany(Komentar::className(),['id_user'=>'id_user']);
    }
	

    // fungsi buat login
    public static function findIdentity($ID_user)
    {
        $user = Member::find()->with(['thread'])->where(['id_user'=>$ID_user])->one();
        if(count($user)){
            return new static($user);
        }
        return null;
    }

    public function getAuthKey()
    {
        throw new \yii\base\NotSupportedException();
    }

    public function getId()
    {
        return $this->id_user;
    }

    public function validateAuthKey($authKey)
    {
        throw new \yii\base\NotSupportedException();
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new \yii\base\NotSupportedException();
    }

    public static function findByUsername($username)
    {
        $user = Member::find()->where(['username'=>$username])->one();
        if(count($user)){
            return new static($user);
        }
        return null;
    }

    public function validatePassword($password)
    {
        return $this->password_user===$password;
    }
}
