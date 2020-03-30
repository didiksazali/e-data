<?php

namespace app\modules\administrator\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\administrator\models\general\StafKategoriSurat;

/**
 * StafKategoriSuratSearch represents the model behind the search form about `app\modules\administrator\models\general\StafKategoriSurat`.
 */
class StafKategoriSuratSearch extends StafKategoriSurat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_kategori_surat', 'nama_kategori', 'dekripsi', 'create_at', 'update_at'], 'safe'],
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
        $query = StafKategoriSurat::find();

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

        $query->andFilterWhere(['like', 'uid_kategori_surat', $this->uid_kategori_surat])
            ->andFilterWhere(['like', 'nama_kategori', $this->nama_kategori])
            ->andFilterWhere(['like', 'dekripsi', $this->dekripsi]);

        return $dataProvider;
    }
}
