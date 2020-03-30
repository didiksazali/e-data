<?php

namespace app\modules\administrator\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\administrator\models\general\DataSiswa;

/**
 * DataSiswaSearch represents the model behind the search form about `app\modules\administrator\models\general\DataSiswa`.
 */
class DataSiswaSearch extends DataSiswa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid_siswa', 'nis_siswa', 'nisn_siswa', 'nik_siswa', 'nama_siswa', 'tempat_lahir_siswa', 'tanggal_lahir_siswa', 'hobi_siswa', 'cita_cita_siswa', 'gdrive_pasfoto_siswa', 'alamat_domisili', 'no_telp_orangtua', 'nama_ayah', 'nama_ibu', 'alamat_lengkap_orang_tua', 'nama_wali', 'no_telp_wali', 'hubungan_dengan_wali', 'no_kks_kps', 'no_kartu_pkh', 'no_kip', 'kebutuhan_tuna_rungu', 'kebutuhan_tuna_daksa', 'kebutuhan_tuna_laras', 'kebutuhan_tuna_belajar', 'kebutuhan_tuna_grahita', 'kebutuhan_tuna_netra', 'kebutuhan_lamban_belajar', 'kebutuhan_sulit_belajar', 'kebutuhan_bakat_luar_biasa', 'kebutuhan_gangguan_komunikasi', 'create_at', 'update_at'], 'safe'],
            [['jenis_kelamin_siswa', 'jumlah_saudara_siswa', 'tinggi_badan_siswa', 'berat_badan_siswa', 'jenis_tempat_tinggal', 'jarak_domisili_kesekolah', 'id_transportasi_kesekolah', 'no_kk', 'no_ktp_ayah', 'id_pendidikan_ayah', 'id_pekerjaan_ayah', 'no_ktp_ibu', 'id_pendidikan_ibu', 'id_pekerjaan_ibu', 'id_penghasilan_orangtua_perbulan', 'id_area_kelurahan_orang_tua', 'kode_pos_orangtua', 'jarak_rumah_kesekolah', 'id_alat_transport_orangtua', 'id_pekerjaan_wali', 'status_siswa', 'create_by'], 'integer'],
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
        $query = DataSiswa::find();

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
            'jenis_kelamin_siswa' => $this->jenis_kelamin_siswa,
            'tanggal_lahir_siswa' => $this->tanggal_lahir_siswa,
            'jumlah_saudara_siswa' => $this->jumlah_saudara_siswa,
            'tinggi_badan_siswa' => $this->tinggi_badan_siswa,
            'berat_badan_siswa' => $this->berat_badan_siswa,
            'jenis_tempat_tinggal' => $this->jenis_tempat_tinggal,
            'jarak_domisili_kesekolah' => $this->jarak_domisili_kesekolah,
            'id_transportasi_kesekolah' => $this->id_transportasi_kesekolah,
            'no_kk' => $this->no_kk,
            'no_ktp_ayah' => $this->no_ktp_ayah,
            'id_pendidikan_ayah' => $this->id_pendidikan_ayah,
            'id_pekerjaan_ayah' => $this->id_pekerjaan_ayah,
            'no_ktp_ibu' => $this->no_ktp_ibu,
            'id_pendidikan_ibu' => $this->id_pendidikan_ibu,
            'id_pekerjaan_ibu' => $this->id_pekerjaan_ibu,
            'id_penghasilan_orangtua_perbulan' => $this->id_penghasilan_orangtua_perbulan,
            'id_area_kelurahan_orang_tua' => $this->id_area_kelurahan_orang_tua,
            'kode_pos_orangtua' => $this->kode_pos_orangtua,
            'jarak_rumah_kesekolah' => $this->jarak_rumah_kesekolah,
            'id_alat_transport_orangtua' => $this->id_alat_transport_orangtua,
            'id_pekerjaan_wali' => $this->id_pekerjaan_wali,
            'status_siswa' => $this->status_siswa,
            'create_by' => $this->create_by,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'uid_siswa', $this->uid_siswa])
            ->andFilterWhere(['like', 'nis_siswa', $this->nis_siswa])
            ->andFilterWhere(['like', 'nisn_siswa', $this->nisn_siswa])
            ->andFilterWhere(['like', 'nik_siswa', $this->nik_siswa])
            ->andFilterWhere(['like', 'nama_siswa', $this->nama_siswa])
            ->andFilterWhere(['like', 'tempat_lahir_siswa', $this->tempat_lahir_siswa])
            ->andFilterWhere(['like', 'hobi_siswa', $this->hobi_siswa])
            ->andFilterWhere(['like', 'cita_cita_siswa', $this->cita_cita_siswa])
            ->andFilterWhere(['like', 'gdrive_pasfoto_siswa', $this->gdrive_pasfoto_siswa])
            ->andFilterWhere(['like', 'alamat_domisili', $this->alamat_domisili])
            ->andFilterWhere(['like', 'no_telp_orangtua', $this->no_telp_orangtua])
            ->andFilterWhere(['like', 'nama_ayah', $this->nama_ayah])
            ->andFilterWhere(['like', 'nama_ibu', $this->nama_ibu])
            ->andFilterWhere(['like', 'alamat_lengkap_orang_tua', $this->alamat_lengkap_orang_tua])
            ->andFilterWhere(['like', 'nama_wali', $this->nama_wali])
            ->andFilterWhere(['like', 'no_telp_wali', $this->no_telp_wali])
            ->andFilterWhere(['like', 'hubungan_dengan_wali', $this->hubungan_dengan_wali])
            ->andFilterWhere(['like', 'no_kks_kps', $this->no_kks_kps])
            ->andFilterWhere(['like', 'no_kartu_pkh', $this->no_kartu_pkh])
            ->andFilterWhere(['like', 'no_kip', $this->no_kip])
            ->andFilterWhere(['like', 'kebutuhan_tuna_rungu', $this->kebutuhan_tuna_rungu])
            ->andFilterWhere(['like', 'kebutuhan_tuna_daksa', $this->kebutuhan_tuna_daksa])
            ->andFilterWhere(['like', 'kebutuhan_tuna_laras', $this->kebutuhan_tuna_laras])
            ->andFilterWhere(['like', 'kebutuhan_tuna_belajar', $this->kebutuhan_tuna_belajar])
            ->andFilterWhere(['like', 'kebutuhan_tuna_grahita', $this->kebutuhan_tuna_grahita])
            ->andFilterWhere(['like', 'kebutuhan_tuna_netra', $this->kebutuhan_tuna_netra])
            ->andFilterWhere(['like', 'kebutuhan_lamban_belajar', $this->kebutuhan_lamban_belajar])
            ->andFilterWhere(['like', 'kebutuhan_sulit_belajar', $this->kebutuhan_sulit_belajar])
            ->andFilterWhere(['like', 'kebutuhan_bakat_luar_biasa', $this->kebutuhan_bakat_luar_biasa])
            ->andFilterWhere(['like', 'kebutuhan_gangguan_komunikasi', $this->kebutuhan_gangguan_komunikasi]);

        return $dataProvider;
    }
}
