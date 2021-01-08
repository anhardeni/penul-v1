<?php

use yii\helpers\Url;
use hscstudio\mimin\components\Mimin;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Nav;


?>
<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="<?= Url::to(["/"]) ?>">SECONDEE KANWIL DJP JAKSEL 2 </a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="<?= Url::to(["/"]) ?>">DJBC - DJP</a>
  </div>
  <ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li class="active"><a class="nav-link" href="<?= Url::to(["/"]) ?>"><i class="fa fa-columns"></i> <span>Dashboard</span></a></li>
    
    <li class="menu-header">User / Group </li>
    <li class="active"><a class="nav-link" href="<?= Url::to(["/route"]) ?>"><i class="fa fa-route"></i> <span>App.Route</span></a></li>
    <li class="active"><a class="nav-link" href="<?= Url::to(["/barang"]) ?>"><i class="fa fa-cloud"></i> <span>Barang</span></a></li>

     <li>
                        <li class="active"><a class="nav-link" href="<?= Url::to(["/about"]) ?>"><i class="fa fa-car"></i> <span>About</span></a></li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">RBAC</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                           
            <li class="active"><a class="nav-link" href="<?= Url::to(["/route"]) ?>"><i class="fa fa-route"></i> <span>App.Route</span></a></li>
            <li class="active"><a class="nav-link" href="<?= Url::to(["/role"]) ?>"><i class="fa fa-tasks"></i> <span>Role</span></a></li>
            <li class="active"><a class="nav-link" href="<?= Url::to(["/user"]) ?>"><i class="fa fa-user"></i> <span>Users</span></a></li>
                        </ul>
      </li>




  </ul>

  </aside>

<?php
NavBar::begin();

echo Nav::widget([
    'items' => [
        ['label' => 'Home', 'url' => ['/role']],
        ['label' => 'About', 'url' => ['/route']],
    ],
    'options' => ['class' => 'navbar-nav navbar-right'],
]);
NavBar::end();

?>

</aside>