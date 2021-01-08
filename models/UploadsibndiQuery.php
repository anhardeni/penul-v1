<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Uploadsibndi]].
 *
 * @see Uploadsibndi
 */
class UploadsibndiQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Uploadsibndi[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Uploadsibndi|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}