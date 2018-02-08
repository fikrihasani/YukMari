<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Thread;

/**
 * EventSearch represents the model behind the search form about `app\models\Event`.
 */
class EventSearch extends Thread
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_event', 'max_user', 'min_user', 'user_pembuat', 'jum_peserta'], 'integer'],
            [['nama_event', 'konten_event', 'tanggal_event', 'lokasi', 'kategori_event', 'gambar_event'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Thread::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_event' => $this->id_event,
            'tanggal_event' => $this->tanggal_event,
            'max_user' => $this->max_user,
            'min_user' => $this->min_user,
            'user_pembuat' => $this->user_pembuat,
            'jum_peserta' => $this->jum_peserta,
        ]);

        $query->andFilterWhere(['like', 'nama_event', $this->nama_event])
            ->andFilterWhere(['like', 'konten_event', $this->konten_event])
            ->andFilterWhere(['like', 'lokasi', $this->lokasi])
            ->andFilterWhere(['like', 'kategori_event', $this->kategori_event])
            ->andFilterWhere(['like', 'gambar_event', $this->gambar_event]);

        return $dataProvider;
    }
}
