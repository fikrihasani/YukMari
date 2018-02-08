<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property integer $id_event
 * @property string $nama_event
 * @property string $konten_event
 * @property string $tanggal_event
 * @property string $lokasi
 * @property string $kategori
 * @property integer $max_user
 * @property integer $min_user
 * @property string $gambar_event
 * @property string $user_pembuat
 * @property integer $jum_peserta
 */
class Thread extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_event', 'konten_event', 'tanggal_event', 'lokasi', 'kategori_event', 'max_user', 'min_user'], 'required'],
            [['konten_event','alasan_batal'], 'string'],
            [['tanggal_event'], 'safe'],
            [['max_user', 'min_user','user_pembuat'], 'integer'],
            [['nama_event', 'lokasi', 'kategori_event'], 'string', 'max' => 50],
            [['gambar_event'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
			// ['min_user', 'compare', 'compareValue' => 30, 'operator' => '>=', 'type' => 'number'],
            // [['user_pembuat'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_event' => 'Id Event',
            'nama_event' => 'Nama Event',
            'konten_event' => 'Konten Event',
            'tanggal_event' => 'Tanggal Event',
            'lokasi' => 'Lokasi',
            'kategori_event' => 'Kategori',
            'max_user' => 'Max User',
            'min_user' => 'Min User',
            'gambar_event' => 'Gambar Event',
            'user_pembuat' => 'User Pembuat',
            'laporan_event' => 'Laporan Event',
            'batal'=>'Batal',
            'alasan_batal'=>'Alasan dibatalkan',
        ];
    }

	public function getMember()
	{
		return $this->hasOne(Member::className(), ['id_user'=>'user_pembuat']);
	}
	
    public function getPeserta()
    {
        return $this->hasMany(Peserta::className(), ['Thread' => 'id_event']);
    }

    public function getKomentar()
    {
        return $this->hasMany(Komentar::className(), ['id_thread' => 'id_event']);
    }

    public function getKategori()
    {
        return $this->hasOne(Kategori::className(), ['id_kategori' => 'kategori_event']);
    }

    public function getNumThreadOf($id){
      $data = Thread::find()->where(['user_pembuat'=>$id])->all();
      return count($data);
    }

    public function getThreadOf($id){
      $data = Thread::find()->where(['user_pembuat'=>$id])->all();
      return $data;
    }

}
