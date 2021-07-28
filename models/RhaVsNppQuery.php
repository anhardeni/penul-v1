<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RhaVsNpp]].
 *
 * @see RhaVsNpp
 */
class RhaVsNppQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RhaVsNpp[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RhaVsNpp|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
