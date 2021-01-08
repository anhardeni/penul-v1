<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PenulDatatransaks]].
 *
 * @see PenulDatatransaks
 */
class PenulDatatransaksQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PenulDatatransaks[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PenulDatatransaks|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
