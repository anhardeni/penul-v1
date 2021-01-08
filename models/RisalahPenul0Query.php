<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RisalahPenul0]].
 *
 * @see RisalahPenul0
 */
class RisalahPenul0Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RisalahPenul0[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RisalahPenul0|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
