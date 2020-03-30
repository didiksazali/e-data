<?php

namespace app\modules\administrator\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\administrator\models\general\StafJenisSurat;

/**
 * StafJenisSuratSearch represents the model behind the search form about `app\modules\administrator\models\general\StafJenisSurat`.
 */
class StafJenisSuratSearch extends StafJenisSurat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_jenis_surat', 'nama_jenis_surat', 'uid_template_surat', 'no_surat', 'default_attribute_tambahan', 'create_at', 'update_by'], 'safe'],
            [['estimasi_selesai', 'biaya', 'status', 'create_by'], 'integer'],
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
        $query = StafJenisSurat::find();

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
            'estimasi_selesai' => $this->estimasi_selesai,
            'biaya' => $this->biaya,
            'status' => $this->status,
            'create_by' => $this->create_by,
            'create_at' => $this->create_at,
            'update_by' => $this->update_by,
        ]);

        $query->andFilterWhere(['like', 'uid_jenis_surat', $this->uid_jenis_surat])
            ->andFilterWhere(['like', 'nama_jenis_surat', $this->nama_jenis_surat])
            ->andFilterWhere(['like', 'uid_template_surat', $this->uid_template_surat])
            ->andFilterWhere(['like', 'no_surat', $this->no_surat])
            ->andFilterWhere(['like', 'default_attribute_tambahan', $this->default_attribute_tambahan]);

        return $dataProvider;
    }
}
