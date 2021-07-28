<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PenulDatatransaksTh]].
 *
 * @see PenulDatatransaksTh
 */
class PenulDatatransaksThQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PenulDatatransaksTh[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PenulDatatransaksTh|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
