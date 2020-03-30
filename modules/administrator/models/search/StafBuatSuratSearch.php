<?php

namespace app\modules\administrator\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\administrator\models\general\StafBuatSurat;

/**
 * StafBuatSuratSearch represents the model behind the search form about `app\modules\administrator\models\general\StafBuatSurat`.
 */
class StafBuatSuratSearch extends StafBuatSurat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_buat_surat', 'no_surat', 'uid_jenis_surat', 'uid_data_siswa', 'estimasi_selesai_tanggal', 'attribute_tambahan_optional', 'gdrive_scan_document', 'create_at', 'update_at'], 'safe'],
            [['no_urut', 'biaya_optional', 'status_selesai', 'create_by'], 'integer'],
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
        $query = StafBuatSurat::find();

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
            'no_urut' => $this->no_urut,
            'estimasi_selesai_tanggal' => $this->estimasi_selesai_tanggal,
            'biaya_optional' => $this->biaya_optional,
            'status_selesai' => $this->status_selesai,
            'create_by' => $this->create_by,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'uid_buat_surat', $this->uid_buat_surat])
            ->andFilterWhere(['like', 'no_surat', $this->no_surat])
            ->andFilterWhere(['like', 'uid_jenis_surat', $this->uid_jenis_surat])
            ->andFilterWhere(['like', 'uid_data_siswa', $this->uid_data_siswa])
            ->andFilterWhere(['like', 'attribute_tambahan_optional', $this->attribute_tambahan_optional])
            ->andFilterWhere(['like', 'gdrive_scan_document', $this->gdrive_scan_document]);

        return $dataProvider;
    }

    public function search2($params)
    {
        $query = StafBuatSurat::find()->where(['status_selesai'=>1]);

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
            'no_urut' => $this->no_urut,
            'estimasi_selesai_tanggal' => $this->estimasi_selesai_tanggal,
            'biaya_optional' => $this->biaya_optional,
            'status_selesai' => $this->status_selesai,
            'create_by' => $this->create_by,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'uid_buat_surat', $this->uid_buat_surat])
            ->andFilterWhere(['like', 'no_surat', $this->no_surat])
            ->andFilterWhere(['like', 'uid_jenis_surat', $this->uid_jenis_surat])
            ->andFilterWhere(['like', 'uid_data_siswa', $this->uid_data_siswa])
            ->andFilterWhere(['like', 'attribute_tambahan_optional', $this->attribute_tambahan_optional])
            ->andFilterWhere(['like', 'gdrive_scan_document', $this->gdrive_scan_document]);

        return $dataProvider;
    }
}
