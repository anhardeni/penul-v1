<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\Uploadberkas */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Uploadberkas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uploadberkas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
             <?php if ((Mimin::checkRoute($this->context->id."/update"))){ ?>        <?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?php } if ((Mimin::checkRoute($this->context->id."/delete"))){ ?>        <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Apakah Anda yakin ingin menghapus item ini??',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>  

       <?php if ((Mimin::checkRoute($this->context->id."/download"))){ ?>        <?= Html::a('Download', ['download', 'id' => $model->id], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Apakah Anda yakin ingin download file ini??',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>  </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_berkas',
            'no_dok',
            'tgl_dok',
            'ket',
            'src_filename',
            'web_filename',
            'created_at',
            'created_by',
        ],
    ]) ?>

<?= Html::img(Yii::getAlias('@web').'/uploads/'.$model->web_filename,['class'=> 'w3-round-small', 'style'=> 'float:left;']);?>

</div>
