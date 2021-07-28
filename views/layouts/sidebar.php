<?php

use yii\helpers\Url;
use hscstudio\mimin\components\Mimin;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Nav;


?>

<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="<?= Url::to(["/"]) ?>">Tim Penul KPU Priok </a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="<?= Url::to(["/"]) ?>">DJBC</a>
  </div>

  <ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li class="active"><a class="nav-link" href="<?= Url::to(["/"]) ?>"><i class="fa fa-columns"></i> <span>Dashboard</span></a></li>
        <li class="active"><a class="nav-link" href="<?= Url::to(["/rha-vs-npp"]) ?>"><i class="fa fa-columns"></i> <span>Rekap RHA vs NPP</span></a></li>
    
    <li class="menu-header">User / Group </li>
    <li class="active"><a class="nav-link" href="<?= Url::to(["/dsab"]) ?>"><i class="fa fa-route"></i> <span>DSAB</span></a></li>
    <li class="active"><a class="nav-link" href="<?= Url::to(["/penul-header"]) ?>"><i class="fa fa-route"></i> <span>Entry RHA</span></a></li>
    <li class="active"><a class="nav-link" href="<?= Url::to(["/uploadberkas"]) ?>"><i class="fa fa-cloud"></i> <span>UploadBerkas</span></a></li>

    <li class="active"><a class="nav-link" href="<?= Url::to(["/jen-dok"]) ?>"><i class="fa fa-car"></i> <span>Jenis Dokumen</span></a></li>

    <li class="active"><a class="nav-link" href="<?= Url::to(["/jen-pelanggaran"]) ?>"><i class="fa fa-car"></i> <span>Jenis Pelanggaran</span></a></li>

    <li class="active"><a class="nav-link" href="<?= Url::to(["/penul-analis-penyaji"]) ?>"><i class="fa fa-car"></i> <span>Daftar Analis dan Penyaji</span></a></li>

    <li class="active"><a class="nav-link" href="<?= Url::to(["/jen-dok"]) ?>"><i class="fa fa-car"></i> <span>Jenis Dokumen</span></a></li>

    
    <li class="active"><a class="nav-link" href="<?= Url::to(["/risalah-penul0"]) ?>"><i class="fa fa-car"></i> <span>Risalah Penul</span></a></li>
 
    <li class="active"><a class="nav-link" href="<?= Url::to(["/penul-tema"]) ?>"><i class="fa fa-car"></i> <span>Tema Rha Drilling</span></a></li>

    <li class="active"><a class="nav-link" href="<?= Url::to(["/penul-link-temaheader"]) ?>"><i class="fa fa-car"></i> <span>Rha Detail Drilling</span></a></li>

    <li class="active"><a class="nav-link" href="<?= Url::to(["/penul-datatransaks"]) ?>"><i class="fa fa-car"></i> <span>Data Penul</span></a></li>

      <li class="active"><a class="nav-link" href="<?= Url::to(["/uploadsimpul"]) ?>"><i class="fa fa-car"></i> <span> Export excel simpul</span></a></li>

   
    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="true">Referensi</a>
    
    <ul class="collapse list-unstyled" id="pageSubmenu">
     
      <li class="active"><a class="nav-link" href="<?= Url::to(["/jen-dok"]) ?>"><i class="fa fa-route"></i> <span>Jenis Dokumen</span></a></li>
      <li class="active"><a class="nav-link" href="<?= Url::to(["/jen-pelanggaran"]) ?>"><i class="fa fa-tasks"></i> <span>Jenis Pelanggaran</span></a></li>
      <li class="active"><a class="nav-link" href="<?= Url::to(["/penul-analis-penyaji"]) ?>"><i class="fa fa-user"></i> <span>Daftar Analis dan Penyaji</span></a></li>

    </ul>

    
    <li class="menu-header">RBAC </li>

    <a href="#pageSubmenu01" data-toggle="collapse" aria-expanded="true">RBAC</a>
    
    <ul class="collapse list-unstyled" id="pageSubmenu01">
     
      <li class="active"><a class="nav-link" href="<?= Url::to(["/route"]) ?>"><i class="fa fa-route"></i> <span>App.Route</span></a></li>
      <li class="active"><a class="nav-link" href="<?= Url::to(["/role"]) ?>"><i class="fa fa-tasks"></i> <span>Role</span></a></li>
      <li class="active"><a class="nav-link" href="<?= Url::to(["/user"]) ?>"><i class="fa fa-user"></i> <span>Users</span></a></li>

    </ul>
    
  </aside>



<!-- <?php

NavBar::begin();

  $menuItems = [
    ['label' => 'Home', 'url' => ['/site/index']],
    ['label' => 'About', 'url' => ['/site/about']],
    ['label' => 'Contact', 'url' => ['/site/contact']],
];

if (\Yii::$app->user->isGuest){
    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
}
else{
    $menuItems[] = ['label' => 'App', 'items' => [
        ['label' => 'route', 'url' => ['/route']],
        ['label' => 'role', 'url' => ['/role']],
        ['label' => 'user', 'url' => ['/user']],
        ['label' => 'barang', 'url' => ['/barang']],

    ]];
  
  $menuItems[] = [
        'label' => 'Logout (' . \Yii::$app->user->identity->username . ')',
        'url' => ['/site/logout'],
        'linkOptions' => ['data-method' => 'post']
    ];
}

$menuItems = Mimin::filterMenu($menuItems);
// in other case maybe You want ensure same of route so You can add parameter strict true
// $menuItems = Mimin::filterMenu($menuItems,true); 

echo Nav::widget([
    'items' => $menuItems,
    'options' => ['class' => 'navbar-nav navbar-left'],
]);
NavBar::end();

?> -->





