<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PenulAnalisPenyaji]].
 *
 * @see PenulAnalisPenyaji
 */
class PenulAnalisPenyajiQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PenulAnalisPenyaji[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PenulAnalisPenyaji|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
