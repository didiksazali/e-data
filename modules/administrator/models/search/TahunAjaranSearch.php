<?php

namespace app\modules\administrator\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\administrator\models\general\TahunAjaran;

/**
 * TahunAjaranSearch represents the model behind the search form about `app\modules\administrator\models\general\TahunAjaran`.
 */
class TahunAjaranSearch extends TahunAjaran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_thn_ajaran', 'kode_tahun_ajaran', 'nama', 'tanggal_mulai', 'tanggal_selesai', 'create_at', 'update_at'], 'safe'],
            [['status', 'create_by'], 'integer'],
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
        $query = TahunAjaran::find();

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
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_selesai' => $this->tanggal_selesai,
            'status' => $this->status,
            'create_by' => $this->create_by,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'uid_thn_ajaran', $this->uid_thn_ajaran])
            ->andFilterWhere(['like', 'kode_tahun_ajaran', $this->kode_tahun_ajaran])
            ->andFilterWhere(['like', 'nama', $this->nama]);

        return $dataProvider;
    }
}
