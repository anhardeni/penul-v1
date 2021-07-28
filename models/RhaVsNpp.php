<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rha_vs_npp".
 * @property int $id
 * @property string $Penyaji
 * @property int $IN-RHA
 * @property int $IN-NPP
 * @property int $OUTSTANDING-Pusat
 */
class RhaVsNpp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
 public static function primaryKey() 
           { 
               return ['id']; 
           }

    public static function tableName()
    {
        return 'rha_vs_npp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Penyaji'], 'required'],
            [['id','IN-RHA', 'IN-NPP', 'OUTSTANDING-Pusat'], 'integer'],
            [['Penyaji'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
             'id' => 'ID',
            'Penyaji' => 'Penyaji',
            'IN-RHA' => 'In Rha',
            'IN-NPP' => 'In Npp',
            'OUTSTANDING-Pusat' => 'Outstanding Pusat',
        ];
    }

    /**
     * {@inheritdoc}
     * @return RhaVsNppQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RhaVsNppQuery(get_called_class());
    }
}
