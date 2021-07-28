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
    <div class="row">
        <div class="col-sm-6">

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
<?php } ?>   

<?php if ((Mimin::checkRoute($this->context->id."/downloaddatapib"))){ ?>        <?= Html::a('Download data pib', ['downloaddatapib', 'id' => $model->id], [
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

<?php if ((Mimin::checkRoute($this->context->id."/copydraftrha"))){ ?>        <?= Html::a('Copy Draft Entry RHA', ['copydraftrha', 'id' => $model->id], [
    'class' => 'btn btn-warning',
    'data' => [
        'confirm' => 'Apakah Anda yakin ingin copy draft rha??',
        'method' => 'post',
    ],
]) ?>
<?php } ?> </p>

</div>

 <div class="col-sm-6">

<?php if ((Mimin::checkRoute($this->context->id."/upload2gbr")))
            { ?>
             <?= Html::a('upload gambar ke - 2 sd ke-6 dst ', ['upload2gbr','id' => $model->id], ['class' => 'btn btn-dark',
                'data' => [
                    'confirm' => 'Apakah Anda yakin ingin upload gambar ke 2 dst (pastikan format dan size gambar sudah sesuai -> tekan shift atau Ctrl untuk pilih) ???',
                                    ],
            ]) ?>
            <?php }  ?> 

<<?php if ((Mimin::checkRoute($this->context->id."/upload3detilth")))
            { ?>
             <?= Html::a('importdata detil rha ', ['upload3detilth','id' => $model->id], ['class' => 'btn btn-dark',
                'data' => [
                    'confirm' => 'Apakah Anda yakin ingin impor data detil RHA (pastikan format dan kolom sudah sesuai template ) ???',
                                    ],
            ]) ?>
            <?php }  ?>  </p>

</div>
</div>



<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
       // 'link_tema',
        'penul_tema.tema',
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
         //    [
         //        'attribute' => 'created_by', 
         //     'value' => 'user.username'
         // ],
        'updated_by',
        'updated_at:date',
    ],
]) ?>

<!-- <?php
$images=explode('**',trim($model->data_pib_filename));
foreach($images as $imagess)
{
     echo Html::img(Yii::getAlias('@web').'/uploads/'. $imagess, ['class'=> 'w3-round-small', 'style'=> 'float:left;']);
}
?> -->




<?= Html::img(Yii::getAlias('@web').'/uploads/'.$model->data_gambar_filename,['class'=> 'w3-round-small', 'style'=> 'float:left;']);?>

</div>

