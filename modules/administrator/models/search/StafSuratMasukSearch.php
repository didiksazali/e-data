<?php

namespace app\modules\administrator\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\administrator\models\general\StafSuratMasuk;

/**
 * StafSuratMasukSearch represents the model behind the search form about `app\modules\administrator\models\general\StafSuratMasuk`.
 */
class StafSuratMasukSearch extends StafSuratMasuk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_surat_masuk', 'no_surat', 'tanggal_masuk', 'dari', 'id_google_drive', 'tujuan_surat_kesekolah', 'maksud_surat', 'uid_kategori_surat', 'tags_surat', 'tindakan_yang_harus_dilakukan', 'beban_kerja_kepada', 'create_at', 'update_at'], 'safe'],
            [['estimasi_batas_tindakan', 'create_by'], 'integer'],
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
        $query = StafSuratMasuk::find();

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
            'tanggal_masuk' => $this->tanggal_masuk,
            'estimasi_batas_tindakan' => $this->estimasi_batas_tindakan,
            'create_by' => $this->create_by,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'uid_surat_masuk', $this->uid_surat_masuk])
            ->andFilterWhere(['like', 'no_surat', $this->no_surat])
            ->andFilterWhere(['like', 'dari', $this->dari])
            ->andFilterWhere(['like', 'id_google_drive', $this->id_google_drive])
            ->andFilterWhere(['like', 'tujuan_surat_kesekolah', $this->tujuan_surat_kesekolah])
            ->andFilterWhere(['like', 'maksud_surat', $this->maksud_surat])
            ->andFilterWhere(['like', 'uid_kategori_surat', $this->uid_kategori_surat])
            ->andFilterWhere(['like', 'tags_surat', $this->tags_surat])
            ->andFilterWhere(['like', 'tindakan_yang_harus_dilakukan', $this->tindakan_yang_harus_dilakukan])
            ->andFilterWhere(['like', 'beban_kerja_kepada', $this->beban_kerja_kepada]);

        return $dataProvider;
    }

    public function search2($params)
    {
        $query = StafSuratMasuk::find();

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
            'tanggal_masuk' => $this->tanggal_masuk,
            'estimasi_batas_tindakan' => $this->estimasi_batas_tindakan,
            'create_by' => $this->create_by,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'uid_surat_masuk', $this->uid_surat_masuk])
            ->andFilterWhere(['like', 'no_surat', $this->no_surat])
            ->andFilterWhere(['like', 'dari', $this->dari])
            ->andFilterWhere(['like', 'id_google_drive', $this->id_google_drive])
            ->andFilterWhere(['like', 'tujuan_surat_kesekolah', $this->tujuan_surat_kesekolah])
            ->andFilterWhere(['like', 'maksud_surat', $this->maksud_surat])
            ->andFilterWhere(['like', 'uid_kategori_surat', $this->uid_kategori_surat])
            ->andFilterWhere(['like', 'tags_surat', $this->tags_surat])
            ->andFilterWhere(['like', 'tindakan_yang_harus_dilakukan', $this->tindakan_yang_harus_dilakukan])
            ->andFilterWhere(['like', 'beban_kerja_kepada', $this->beban_kerja_kepada]);

        return $dataProvider;
    }
}
