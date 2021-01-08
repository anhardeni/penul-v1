<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Uploadberkas]].
 *
 * @see Uploadberkas
 */
class UploadberkasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Uploadberkas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Uploadberkas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
