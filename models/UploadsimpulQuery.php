<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Uploadsimpul]].
 *
 * @see Uploadsimpul
 */
class UploadsimpulQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Uploadsimpul[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Uploadsimpul|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
