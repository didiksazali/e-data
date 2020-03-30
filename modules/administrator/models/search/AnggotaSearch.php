<?php

namespace app\modules\administrator\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\administrator\models\general\Anggota;

/**
 * AnggotaSearch represents the model behind the search form about `app\modules\administrator\models\general\Anggota`.
 */
class AnggotaSearch extends Anggota
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_anggota', 'no_id_pkdp', 'id_pendidikan', 'id_penghasilan'], 'integer'],
            [['no_ktp', 'nama', 'alamat_sekarang', 'tempat_lahir', 'tanggal_lahir', 'jk', 'no_hp', 'email', 'pekerjaan', 'dpw', 'dpd', 'dpc', 'alamat_kampung', 'prestasi', 'motivasi_bergabung', 'masukan_untuk_ranah', 'masukan_untuk_rantau', 'foto', 'kk'], 'safe'],
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
        $query = Anggota::find();

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
            'id_anggota' => $this->id_anggota,
            'no_id_pkdp' => $this->no_id_pkdp,
            'tanggal_lahir' => $this->tanggal_lahir,
            'id_pendidikan' => $this->id_pendidikan,
            'id_penghasilan' => $this->id_penghasilan,
        ]);

        $query->andFilterWhere(['like', 'no_ktp', $this->no_ktp])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'alamat_sekarang', $this->alamat_sekarang])
            ->andFilterWhere(['like', 'tempat_lahir', $this->tempat_lahir])
            ->andFilterWhere(['like', 'jk', $this->jk])
            ->andFilterWhere(['like', 'no_hp', $this->no_hp])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'pekerjaan', $this->pekerjaan])
            ->andFilterWhere(['like', 'dpw', $this->dpw])
            ->andFilterWhere(['like', 'dpd', $this->dpd])
            ->andFilterWhere(['like', 'dpc', $this->dpc])
            ->andFilterWhere(['like', 'alamat_kampung', $this->alamat_kampung])
            ->andFilterWhere(['like', 'prestasi', $this->prestasi])
            ->andFilterWhere(['like', 'motivasi_bergabung', $this->motivasi_bergabung])
            ->andFilterWhere(['like', 'masukan_untuk_ranah', $this->masukan_untuk_ranah])
            ->andFilterWhere(['like', 'masukan_untuk_rantau', $this->masukan_untuk_rantau])
            ->andFilterWhere(['like', 'foto', $this->foto])
            ->andFilterWhere(['like', 'kk', $this->kk]);

        return $dataProvider;
    }
}
