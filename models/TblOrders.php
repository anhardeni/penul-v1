<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_orders".
 *
 * @property string $customerName
 * @property string $dollar_sales
 * @property string $orderDate
 */
class TblOrders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dollar_sales'], 'number'],
            [['customerName'], 'string', 'max' => 34],
            [['orderDate'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'customerName' => 'Customer Name',
            'dollar_sales' => 'Dollar Sales',
            'orderDate' => 'Order Date',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TblOrdersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TblOrdersQuery(get_called_class());
    }
}
