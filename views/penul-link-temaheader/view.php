<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\PenulLinkTemaheader */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Penul Link Temaheader', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penul-link-temaheader-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
             <?php if ((Mimin::checkRoute($this->context->id."/copylinktema"))){ ?>        <?= Html::a('Copy data', ['copylinktema', 'id' => $model->id], [
            'class' => 'btn btn-warning',
            'data' => [
                'confirm' => 'Apakah Anda yakin ingin copy data ini??',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>

             <?php if ((Mimin::checkRoute($this->context->id."/update"))){ ?>        <?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?php } 
        
        if ((Mimin::checkRoute($this->context->id."/delete"))){ ?>        <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Apakah Anda yakin ingin menghapus item ini??',
                'method' => 'post',
            ],
        ]) ?>


        <?php } ?>    <?php if ((Mimin::checkRoute($this->context->id."/downloaddatapib"))){ ?>        <?= Html::a('Download data pib', ['downloaddatapib', 'id' => $model->id], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Apakah Anda yakin ingin download  pib file ini??',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?> 

        <?php if ((Mimin::checkRoute($this->context->id."/downloaddatapib"))){ ?>        <?= Html::a('Download template penul', ['downloaddatapib', 'id' => 1], [
            'class' => 'btn btn-dark',
            'data' => [
                'confirm' => 'Apakah Anda yakin ingin download  template file ini??',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>

        <?php if ((Mimin::checkRoute($this->context->id."/copydraftrha"))){ ?>        <?= Html::a('Copy Draft RHA', ['copydraftrha', 'id' => $model->id], [
            'class' => 'btn btn-warning',
            'data' => [
                'confirm' => 'Apakah Anda yakin ingin copy draft rha??',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?> </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'link_tema',
            'link_header',
            'keyword_specific',
            'dap_rha:ntext',
            'dap_rha2:ntext',
            'dap_rha3:ntext',
            'dap_rha4',
            'dap_rha5:ntext',
            'dap_rha6:ntext',
            'dap_rha7:ntext',
            'data_pib',
            'data_gambar',
            'data_gambar_filename',
            'data_pib_filename',
            'periode_tarik_data',
            'link_upload_berkas',
            'ket',
            'created_at:datetime',
            'created_by',
            'updated_by',
            'updated_at:date',
        ],
    ]) ?>
<?= Html::img(Yii::getAlias('@web').'/uploads/'.$model->data_gambar_filename,['class'=> 'w3-round-small', 'style'=> 'float:left;']);?>
<?= Html::img(Yii::getAlias('@web').'/uploads/'.$model->data_pib_filename,['class'=> 'w3-round-small', 'style'=> 'float:left;']);?>
</div>
