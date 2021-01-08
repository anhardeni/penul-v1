<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PenulLinkTemaheader]].
 *
 * @see PenulLinkTemaheader
 */
class PenulLinkTemaheaderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PenulLinkTemaheader[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PenulLinkTemaheader|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
