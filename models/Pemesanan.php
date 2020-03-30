<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%pemesanan}}".
 *
 * @property string $nomor_tiket
 * @property integer $id_tiket
 * @property integer $nomor_kursi
 * @property integer $pemesanan_oleh
 * @property integer $id_penumpang
 * @property integer $kode_promo
 * @property string $tanggal_berangkat
 * @property string $status
 * @property string $dibuat_tanggal
 * @property string $terakhir_diedit
 *
 * @property Tiket $idTiket
 * @property MasterKursi $nomorKursi
 * @property HakAkses $pemesananOleh
 * @property MasterPenumpang $idPenumpang
 * @property MasterPromo $kodePromo
 */
class Pemesanan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pemesanan}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nomor_tiket', 'id_tiket', 'nomor_kursi', 'pemesanan_oleh', 'id_penumpang', 'kode_promo', 'tanggal_berangkat', 'status'], 'required'],
            [['id_tiket', 'nomor_kursi', 'pemesanan_oleh', 'id_penumpang', 'kode_promo'], 'integer'],
            [['tanggal_berangkat', 'dibuat_tanggal', 'terakhir_diedit'], 'safe'],
            [['status'], 'string'],
            [['nomor_tiket'], 'string', 'max' => 20],
            [['nomor_kursi'], 'unique'],
            [['id_tiket'], 'exist', 'skipOnError' => true, 'targetClass' => Tiket::className(), 'targetAttribute' => ['id_tiket' => 'id_tiket']],
            [['nomor_kursi'], 'exist', 'skipOnError' => true, 'targetClass' => MasterKursi::className(), 'targetAttribute' => ['nomor_kursi' => 'id_kursi']],
            [['pemesanan_oleh'], 'exist', 'skipOnError' => true, 'targetClass' => HakAkses::className(), 'targetAttribute' => ['pemesanan_oleh' => 'id_hak_aks']],
            [['id_penumpang'], 'exist', 'skipOnError' => true, 'targetClass' => MasterPenumpang::className(), 'targetAttribute' => ['id_penumpang' => 'id_penumpang']],
            [['kode_promo'], 'exist', 'skipOnError' => true, 'targetClass' => MasterPromo::className(), 'targetAttribute' => ['kode_promo' => 'id_promo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nomor_tiket' => 'Nomor Tiket',
            'id_tiket' => 'Id Tiket',
            'nomor_kursi' => 'Nomor Kursi',
            'pemesanan_oleh' => 'Pemesanan Oleh',
            'id_penumpang' => 'Id Penumpang',
            'kode_promo' => 'Kode Promo',
            'tanggal_berangkat' => 'Tanggal Berangkat',
            'status' => 'Status',
            'dibuat_tanggal' => 'Dibuat Tanggal',
            'terakhir_diedit' => 'Terakhir Diedit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTiket()
    {
        return $this->hasOne(Tiket::className(), ['id_tiket' => 'id_tiket']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNomorKursi()
    {
        return $this->hasOne(MasterKursi::className(), ['id_kursi' => 'nomor_kursi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPemesananOleh()
    {
        return $this->hasOne(HakAkses::className(), ['id_hak_aks' => 'pemesanan_oleh']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPenumpang()
    {
        return $this->hasOne(MasterPenumpang::className(), ['id_penumpang' => 'id_penumpang']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodePromo()
    {
        return $this->hasOne(MasterPromo::className(), ['id_promo' => 'kode_promo']);
    }
}
