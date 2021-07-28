<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PenulLinkThIdm]].
 *
 * @see PenulLinkThIdm
 */
class PenulLinkThIdmQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PenulLinkThIdm[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PenulLinkThIdm|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
