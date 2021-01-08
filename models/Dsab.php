<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dsab".
 *
 * @property int $id
 * @property string $tim_secondment
 * @property string $nama_wp
 * @property string $npwp
 * @property string $kpp
 * @property string $kanwil
 * @property string $dsab_nondsab
 * @property string $status
 * @property string $rencana_tindaklanjut
 * @property double $earlycalculation_sekber
 * @property double $nilai_potensi
 * @property double $realisasi
 * @property string $gappotensi_dan_realisasi
 * @property string $hal_yg_perlu_dieskalasi
 * @property string $keterangan
 * @property string $status_pemeriksaan
 * @property string $follow_up
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property DsabDetail[] $dsabDetails
 */
class Dsab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dsab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['earlycalculation_sekber', 'nilai_potensi', 'realisasi'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['tim_secondment', 'nama_wp'], 'string', 'max' => 50],
            [['npwp'], 'string', 'max' => 16],
            [['kpp', 'kanwil', 'status'], 'string', 'max' => 100],
            [['dsab_nondsab'], 'string', 'max' => 9],
            [['rencana_tindaklanjut'], 'string', 'max' => 577],
            [['gappotensi_dan_realisasi'], 'string', 'max' => 1488],
            [['hal_yg_perlu_dieskalasi'], 'string', 'max' => 200],
            [['keterangan'], 'string', 'max' => 247],
            [['status_pemeriksaan'], 'string', 'max' => 299],
            [['follow_up'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tim_secondment' => 'Tim Secondment',
            'nama_wp' => 'Nama Wp',
            'npwp' => 'Npwp',
            'kpp' => 'Kpp',
            'kanwil' => 'Kanwil',
            'dsab_nondsab' => 'Dsab Nondsab',
            'status' => 'Status',
            'rencana_tindaklanjut' => 'Rencana Tindaklanjut',
            'earlycalculation_sekber' => 'Earlycalculation Sekber',
            'nilai_potensi' => 'Nilai Potensi',
            'realisasi' => 'Realisasi',
            'gappotensi_dan_realisasi' => 'Gappotensi Dan Realisasi',
            'hal_yg_perlu_dieskalasi' => 'Hal Yg Perlu Dieskalasi',
            'keterangan' => 'Keterangan',
            'status_pemeriksaan' => 'Status Pemeriksaan',
            'follow_up' => 'Follow Up',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDsabDetails()
    {
        return $this->hasMany(DsabDetail::className(), ['dsab_fk' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return DsabQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DsabQuery(get_called_class());
    }
}
