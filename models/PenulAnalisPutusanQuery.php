<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PenulAnalisPutusan]].
 *
 * @see PenulAnalisPutusan
 */
class PenulAnalisPutusanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PenulAnalisPutusan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PenulAnalisPutusan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
