<?php

namespace app\modules\administrator\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\administrator\models\general\DmSekolah;

/**
 * DmSekolahSearch represents the model behind the search form about `app\modules\administrator\models\general\DmSekolah`.
 */
class DmSekolahSearch extends DmSekolah
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_dm_sekolah', 'nss_nsm', 'jenjang_sekolah', 'nama', 'alamat', 'status', 'akreditas', 'logo', 'no_telp', 'fax', 'email', 'tagline', 'visi', 'misi', 'create_at', 'update_at'], 'safe'],
            [['npsn', 'kode_pos', 'create_by'], 'integer'],
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
        $query = DmSekolah::find();

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
            'npsn' => $this->npsn,
            'kode_pos' => $this->kode_pos,
            'create_by' => $this->create_by,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'uid_dm_sekolah', $this->uid_dm_sekolah])
            ->andFilterWhere(['like', 'nss_nsm', $this->nss_nsm])
            ->andFilterWhere(['like', 'jenjang_sekolah', $this->jenjang_sekolah])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'akreditas', $this->akreditas])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'no_telp', $this->no_telp])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'tagline', $this->tagline])
            ->andFilterWhere(['like', 'visi', $this->visi])
            ->andFilterWhere(['like', 'misi', $this->misi]);

        return $dataProvider;
    }
}
