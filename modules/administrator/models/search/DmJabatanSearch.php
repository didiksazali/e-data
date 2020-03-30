<?php

namespace app\modules\administrator\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\administrator\models\general\DmJabatan;

/**
 * DmJabatanSearch represents the model behind the search form about `app\modules\administrator\models\general\DmJabatan`.
 */
class DmJabatanSearch extends DmJabatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_jabatan', 'nama_jabatan', 'deskripsi_jabatan', 'create_at', 'update_at'], 'safe'],
            [['create_by'], 'integer'],
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
        $query = DmJabatan::find();

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
            'create_by' => $this->create_by,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'kode_jabatan', $this->kode_jabatan])
            ->andFilterWhere(['like', 'nama_jabatan', $this->nama_jabatan])
            ->andFilterWhere(['like', 'deskripsi_jabatan', $this->deskripsi_jabatan]);

        return $dataProvider;
    }
}
