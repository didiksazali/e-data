<?php

namespace app\modules\administrator\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\administrator\models\general\StafTemplateSurat;

/**
 * StafTemplateSuratSearch represents the model behind the search form about `app\modules\administrator\models\general\StafTemplateSurat`.
 */
class StafTemplateSuratSearch extends StafTemplateSurat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_template_surat', 'uid_untuk_sekolah', 'nama_template', 'deskripsi_template', 'path_template', 'create_at', 'update_at'], 'safe'],
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
        $query = StafTemplateSurat::find();

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
            'status' => $this->status,
            'create_by' => $this->create_by,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'uid_template_surat', $this->uid_template_surat])
            ->andFilterWhere(['like', 'uid_untuk_sekolah', $this->uid_untuk_sekolah])
            ->andFilterWhere(['like', 'nama_template', $this->nama_template])
            ->andFilterWhere(['like', 'deskripsi_template', $this->deskripsi_template])
            ->andFilterWhere(['like', 'path_template', $this->path_template]);

        return $dataProvider;
    }
}
