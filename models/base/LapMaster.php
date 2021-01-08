<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "lap_master".
 *
 * @property string $id
 * @property string $tglmasukkeberatan
 * @property string $tgljatuhtempo
 * @property string $npwpimp
 * @property string $namaimp
 * @property integer $nospkpbm_spsa
 * @property string $tglspkpbm_spsa
 * @property string $jumlahtagihan
 * @property string $salah
 * @property string $nokep
 * @property string $tglkep
 * @property string $jenispenetapan
 * @property string $hasilkeputusan
 * @property string $tagihanhasilkep
 * @property double $bm
 * @property double $bm_t
 * @property double $cukai
 * @property double $cukai_t
 * @property double $ppn
 * @property double $ppn_t
 * @property double $ppnbm
 * @property double $ppnbm_t
 * @property double $pph
 * @property double $pph_t
 * @property double $denda
 * @property double $denda_t
 * @property double $totalbeforeskep
 * @property double $totalafterskep
 */
class LapMaster extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nospkpbm_spsa'], 'integer'],
            [['tglmasukkeberatan', 'tgljatuhtempo', 'tglspkpbm_spsa', 'tglkep'], 'safe'],
            [['npwpimp', 'namaimp'], 'required'],
            [['jumlahtagihan', 'tagihanhasilkep', 'bm', 'bm_t', 'cukai', 'cukai_t', 'ppn', 'ppn_t', 'ppnbm', 'ppnbm_t', 'pph', 'pph_t', 'denda', 'denda_t', 'totalbeforeskep', 'totalafterskep'], 'number'],
            [['jenispenetapan', 'hasilkeputusan'], 'string'],
            [['npwpimp'], 'string', 'max' => 50],
            [['namaimp', 'salah', 'nokep'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lap_master';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tglmasukkeberatan' => 'Tglmasukkeberatan',
            'tgljatuhtempo' => 'Tgljatuhtempo',
            'npwpimp' => 'Npwpimp',
            'namaimp' => 'Namaimp',
            'nospkpbm_spsa' => 'Nospkpbm Spsa',
            'tglspkpbm_spsa' => 'Tglspkpbm Spsa',
            'jumlahtagihan' => 'Jumlahtagihan',
            'salah' => 'Salah',
            'nokep' => 'Nokep',
            'tglkep' => 'Tglkep',
            'jenispenetapan' => 'Jenispenetapan',
            'hasilkeputusan' => 'Hasilkeputusan',
            'tagihanhasilkep' => 'Tagihanhasilkep',
            'bm' => 'Bm',
            'bm_t' => 'Bm T',
            'cukai' => 'Cukai',
            'cukai_t' => 'Cukai T',
            'ppn' => 'Ppn',
            'ppn_t' => 'Ppn T',
            'ppnbm' => 'Ppnbm',
            'ppnbm_t' => 'Ppnbm T',
            'pph' => 'Pph',
            'pph_t' => 'Pph T',
            'denda' => 'Denda',
            'denda_t' => 'Denda T',
            'totalbeforeskep' => 'Totalbeforeskep',
            'totalafterskep' => 'Totalafterskep',
        ];
    }

/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\LapMasterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\LapMasterQuery(get_called_class());
    }
}
