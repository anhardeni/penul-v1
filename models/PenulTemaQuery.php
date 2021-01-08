<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PenulTema]].
 *
 * @see PenulTema
 */
class PenulTemaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PenulTema[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PenulTema|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
