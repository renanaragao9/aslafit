<?php

use App\Utility\AccessChecker;

$loggedUserId = $this->request->getSession()->read('Auth.User.id');
$this->assign('title', 'Titulo'); 
?>     
<section class="content mt-4">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                            <h3 class="card-title">
                                <?= __('Visualizar mealType') ?>
                            </h3>
                        </div>
                        <div class="col-12 col-md-6 text-md-right order-1 order-md-2">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-md-end">
                                    <li class="breadcrumb-item">
                                        <a href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'index']) ?>">
                                            <i class="fa-regular fa-house"></i>
                                            Início
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="<?= $this->Url->build(['action' => 'index']) ?>">mealType</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <?= __('Visualizar') ?>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <hr />
                </div>
            </div>
            <div class="card-body">
                                  <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Name'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($mealType->name) ?>
                    </div>
                </div>
                                     <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Id'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                                                 <?= $this->Number->format($mealType->id) ?> 
                                            </div>
                </div>
                                   <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Created'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($mealType->created) ?>
                    </div>
                </div>
                                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Modified'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($mealType->modified) ?>
                    </div>
                </div>
                                   <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label" >
                        <?= __('Active'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $mealType->active ? __('Sim') : __('Não'); ?>
                    </div>
                </div>
                             </div>
        </div>
    </div>
</section>
       
<?php if (!empty($mealType->diet_plans)) : ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                            <h3 class="card-title">
                                <?= __('Relacionado Diet Plans') ?>
                            </h3>
                        </div>
                        <div class="col-12 col-md-6 text-md-right order-1 order-md-2">
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="icon-dropdown" data-card-widget="collapse" >
                                    <i class="fas fa-minus" data-collapsed-icon="fa-plus" data-expanded-icon="fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr />
                </div>
            </div>
            <?php if (!empty($mealType->diet_plans)) : ?>
                <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                    <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                        <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                            <div class="input-group">
                                <input id="Diet PlansSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>"/>
                            </div>
                        </form>
                    </div>
                    <table id="Diet PlansTable" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                                                <th><?= __('Id') ?></th>
                                                                <th><?= __('Description') ?></th>
                                                                <th><?= __('Student Id') ?></th>
                                                                <th><?= __('Meal Type Id') ?></th>
                                                                <th><?= __('Food Id') ?></th>
                                                                <th><?= __('Ficha Id') ?></th>
                                                                <th><?= __('Active') ?></th>
                                                                <th><?= __('Created') ?></th>
                                                                <th><?= __('Modified') ?></th>
                                                                <th class="actions"><?= __('Ações') ?></th>
                            </tr>
                        </thead>
                        <tbody id="Diet PlansTableBody">
                            <?php foreach ($mealType->diet_plans as $dietPlans) : ?>
                                <tr>
                                                                        <td>
                                        <?= h($dietPlans->id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($dietPlans->description) ?>
                                    </td>
                                                                        <td>
                                        <?= h($dietPlans->student_id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($dietPlans->meal_type_id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($dietPlans->food_id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($dietPlans->ficha_id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($dietPlans->active) ?>
                                    </td>
                                                                        <td>
                                        <?= h($dietPlans->created) ?>
                                    </td>
                                                                        <td>
                                        <?= h($dietPlans->modified) ?>
                                    </td>
                                                                         <td class="actions">
                                        <?= $this->Html->link('<i class="fas fa-eye"></i>', 
                                            [
                                                'controller' => 'Diet Plans', 
                                                'action' => 'view', 
                                                $mealType->id
                                            ], 
                                            [ 
                                                'class' => 'btn btn-view btn-sm',
                                                'escape' => false 
                                            ]) 
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div id="Diet PlansNoResultsMessage" style="display: none; text-align: center; padding: 10px">
                        <?= __('Nenhum resultado encontrado.') ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script>
        $("#Diet PlansSearchInput").on("keyup", function () {
            var input, filter, table, tr, td, i, j, txtValue, found;
            input = $("#Diet PlansSearchInput");
            filter = input.val().toUpperCase();
            table = $("#Diet PlansTable");
            tr = table.find("tr");
            found = false;

            tr.each(function (index) {
                if (index === 0) return;
                $(this).hide();
                td = $(this).find("td");
                for (j = 0; j < td.length; j++) {
                    txtValue = td.eq(j).text();
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        $(this).show();
                        found = true;
                        break;
                    }
                }
            });

            $("#Diet PlansNoResultsMessage").toggle(!found);
        });
    </script>
</section>
<?php endif; ?>
