<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PenulUraianAnalisa]].
 *
 * @see PenulUraianAnalisa
 */
class PenulUraianAnalisaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PenulUraianAnalisa[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PenulUraianAnalisa|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
