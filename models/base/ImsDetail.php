<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "ims_detail".
 *
 * @property string $id
 * @property string $link_ims
 * @property string $urbar
 * @property string $hs
 * @property string $hs_t
 * @property double $bm
 * @property double $bm_t
 * @property double $ppn
 * @property double $ppn_t
 * @property double $pph
 * @property double $pph_t
 * @property string $val
 * @property double $np
 * @property double $np_t
 * @property string $ket
 *
 * @property \app\models\ImsMaster $linkIms
 */
class ImsDetail extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['link_ims'], 'required'],
            [['link_ims'], 'integer'],
            [['bm', 'bm_t', 'ppn', 'ppn_t', 'pph', 'pph_t', 'np', 'np_t'], 'number'],
            [['val'], 'string'],
            [['urbar'], 'string', 'max' => 55],
            [['hs', 'hs_t'], 'string', 'max' => 10],
            [['ket'], 'string', 'max' => 200]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ims_detail';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link_ims' => 'Link Ims',
            'urbar' => 'Urbar',
            'hs' => 'Hs',
            'hs_t' => 'Hs T',
            'bm' => 'Bm',
            'bm_t' => 'Bm T',
            'ppn' => 'Ppn',
            'ppn_t' => 'Ppn T',
            'pph' => 'Pph',
            'pph_t' => 'Pph T',
            'val' => 'Val',
            'np' => 'Np',
            'np_t' => 'Np T',
            'ket' => 'Ket',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinkIms()
    {
        return $this->hasOne(\app\models\ImsMaster::className(), ['id' => 'link_ims']);
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
     * @return \app\models\ImsDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ImsDetailQuery(get_called_class());
    }
}
