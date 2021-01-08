


<?php


namespace app\modules\course\models;


use Yii;

use yii\helpers\ArrayHelper;


class Model extends \yii\base\Model

{

    /**

     * Creates and populates a set of models.

     *

     * @param string $modelClass

     * @param array $multipleModels

     * @return array

     */

    public static function createMultiple($modelClass, $multipleModels = [])

    {

        $model    = new $modelClass;

        $formName = $model->formName();

        $post     = Yii::$app->request->post($formName);

        $models   = [];


        if (! empty($multipleModels)) {

            $keys = array_keys(ArrayHelper::map($multipleModels, 'course_instructor_id', 'course_instructor_id'));

            $multipleModels = array_combine($keys, $multipleModels);

        }


        if ($post && is_array($post)) {

            foreach ($post as $i => $item) {

                if (isset($item['course_instructor_id']) && !empty($item['course_instructor_id']) && isset($multipleModels[$item['course_instructor_id']])) {

                    $models[] = $multipleModels[$item['course_instructor_id']];

                } else {

                    $models[] = new $modelClass;

                }

            }

        }


        unset($model, $formName, $post);


        return $models;

    }

}