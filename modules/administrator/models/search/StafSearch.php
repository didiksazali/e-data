<?php

namespace app\modules\administrator\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\administrator\models\general\Staf;

/**
 * StafSearch represents the model behind the search form about `app\modules\administrator\models\general\Staf`.
 */
class StafSearch extends Staf
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_staf', 'nama', 'alamat', 'status_kepegawaian', 'jabatan', 'gdrive_pasfoto_staf', 'create_at', 'update_at'], 'safe'],
            [['nip', 'jenis_kelamin', 'status_keluarga', 'hak_akses', 'create_by'], 'integer'],
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
        $query = Staf::find();

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
            'nip' => $this->nip,
            'jenis_kelamin' => $this->jenis_kelamin,
            'status_keluarga' => $this->status_keluarga,
            'hak_akses' => $this->hak_akses,
            'create_by' => $this->create_by,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'uid_staf', $this->uid_staf])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'status_kepegawaian', $this->status_kepegawaian])
            ->andFilterWhere(['like', 'jabatan', $this->jabatan])
            ->andFilterWhere(['like', 'gdrive_pasfoto_staf', $this->gdrive_pasfoto_staf]);

        return $dataProvider;
    }
}
