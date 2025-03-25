<?php

use App\Utility\AccessChecker;

$loggedUserId = $this->request->getSession()->read('Auth.User.id');
$this->assign('title', 'Visualizar ficha');
?>
<section class="content mt-4">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                            <h3 class="card-title">
                                <?= __('Visualizar ficha') ?>
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
                                        <a href="<?= $this->Url->build(['action' => 'index']) ?>">Fichas</a>
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
                        <?= __('Id'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $this->Number->format($ficha->id) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Aluno'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $ficha->has('student') ? $this->Html->link($ficha->student->name, ['controller' => 'Students', 'action' => 'view', $ficha->student->id]) : '' ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Data de Início'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($ficha->start_date) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Data de Término'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($ficha->end_date) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Descrição'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($ficha->description) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Ativo'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $ficha->active ? __('Sim') : __('Não'); ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Criado'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($ficha->created) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Modificado'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($ficha->modified) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($ficha->assessments)) : ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                                <h3 class="card-title">
                                    <?= __('Relacionado Assessments') ?>
                                </h3>
                            </div>
                            <div class="col-12 col-md-6 text-md-right order-1 order-md-2">
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" id="icon-dropdown" data-card-widget="collapse">
                                        <i class="fas fa-minus" data-collapsed-icon="fa-plus" data-expanded-icon="fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr />
                    </div>
                </div>
                <?php if (!empty($ficha->assessments)) : ?>
                    <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                        <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                            <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                                <div class="input-group">
                                    <input id="AssessmentsSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>" />
                                </div>
                            </form>
                        </div>
                        <table id="AssessmentsTable" class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th><?= __('Id') ?></th>
                                    <th><?= __('Goal') ?></th>
                                    <th><?= __('Observation') ?></th>
                                    <th><?= __('Term') ?></th>
                                    <th><?= __('Height') ?></th>
                                    <th><?= __('Weight') ?></th>
                                    <th><?= __('Arm') ?></th>
                                    <th><?= __('Forearm') ?></th>
                                    <th><?= __('Breastplate') ?></th>
                                    <th><?= __('Back') ?></th>
                                    <th><?= __('Waist') ?></th>
                                    <th><?= __('Glute') ?></th>
                                    <th><?= __('Hip') ?></th>
                                    <th><?= __('Thigh') ?></th>
                                    <th><?= __('Calf') ?></th>
                                    <th><?= __('Student Id') ?></th>
                                    <th><?= __('Ficha Id') ?></th>
                                    <th><?= __('Active') ?></th>
                                    <th><?= __('Created') ?></th>
                                    <th><?= __('Modified') ?></th>
                                    <th class="actions"><?= __('Ações') ?></th>
                                </tr>
                            </thead>
                            <tbody id="AssessmentsTableBody">
                                <?php foreach ($ficha->assessments as $assessments) : ?>
                                    <tr>
                                        <td>
                                            <?= h($assessments->id) ?>
                                        </td>
                                        <td>
                                            <?= h($assessments->goal) ?>
                                        </td>
                                        <td>
                                            <?= h($assessments->observation) ?>
                                        </td>
                                        <td>
                                            <?= h($assessments->term) ?>
                                        </td>
                                        <td>
                                            <?= h($assessments->height) ?>
                                        </td>
                                        <td>
                                            <?= h($assessments->weight) ?>
                                        </td>
                                        <td>
                                            <?= h($assessments->arm) ?>
                                        </td>
                                        <td>
                                            <?= h($assessments->forearm) ?>
                                        </td>
                                        <td>
                                            <?= h($assessments->breastplate) ?>
                                        </td>
                                        <td>
                                            <?= h($assessments->back) ?>
                                        </td>
                                        <td>
                                            <?= h($assessments->waist) ?>
                                        </td>
                                        <td>
                                            <?= h($assessments->glute) ?>
                                        </td>
                                        <td>
                                            <?= h($assessments->hip) ?>
                                        </td>
                                        <td>
                                            <?= h($assessments->thigh) ?>
                                        </td>
                                        <td>
                                            <?= h($assessments->calf) ?>
                                        </td>
                                        <td>
                                            <?= h($assessments->student_id) ?>
                                        </td>
                                        <td>
                                            <?= h($assessments->ficha_id) ?>
                                        </td>
                                        <td>
                                            <?= h($assessments->active) ?>
                                        </td>
                                        <td>
                                            <?= h($assessments->created) ?>
                                        </td>
                                        <td>
                                            <?= h($assessments->modified) ?>
                                        </td>
                                        <td class="actions">
                                            <?= $this->Html->link(
                                                '<i class="fas fa-eye"></i>',
                                                [
                                                    'controller' => 'Assessments',
                                                    'action' => 'view',
                                                    $ficha->id
                                                ],
                                                [
                                                    'class' => 'btn btn-view btn-sm',
                                                    'escape' => false
                                                ]
                                            )
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div id="AssessmentsNoResultsMessage" style="display: none; text-align: center; padding: 10px">
                            <?= __('Nenhum resultado encontrado.') ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <script>
            $("#AssessmentsSearchInput").on("keyup", function() {
                var input, filter, table, tr, td, i, j, txtValue, found;
                input = $("#AssessmentsSearchInput");
                filter = input.val().toUpperCase();
                table = $("#AssessmentsTable");
                tr = table.find("tr");
                found = false;

                tr.each(function(index) {
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

                $("#AssessmentsNoResultsMessage").toggle(!found);
            });
        </script>
    </section>
<?php endif; ?>

<?php if (!empty($ficha->diet_plans)) : ?>
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
                                    <button type="button" class="btn btn-tool" id="icon-dropdown" data-card-widget="collapse">
                                        <i class="fas fa-minus" data-collapsed-icon="fa-plus" data-expanded-icon="fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr />
                    </div>
                </div>
                <?php if (!empty($ficha->diet_plans)) : ?>
                    <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                        <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                            <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                                <div class="input-group">
                                    <input id="Diet PlansSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>" />
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
                                <?php foreach ($ficha->diet_plans as $dietPlans) : ?>
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
                                            <?= $this->Html->link(
                                                '<i class="fas fa-eye"></i>',
                                                [
                                                    'controller' => 'Diet Plans',
                                                    'action' => 'view',
                                                    $ficha->id
                                                ],
                                                [
                                                    'class' => 'btn btn-view btn-sm',
                                                    'escape' => false
                                                ]
                                            )
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
            $("#Diet PlansSearchInput").on("keyup", function() {
                var input, filter, table, tr, td, i, j, txtValue, found;
                input = $("#Diet PlansSearchInput");
                filter = input.val().toUpperCase();
                table = $("#Diet PlansTable");
                tr = table.find("tr");
                found = false;

                tr.each(function(index) {
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

<?php if (!empty($ficha->exercise_training_division)) : ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                                <h3 class="card-title">
                                    <?= __('Relacionado Exercise Training Division') ?>
                                </h3>
                            </div>
                            <div class="col-12 col-md-6 text-md-right order-1 order-md-2">
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" id="icon-dropdown" data-card-widget="collapse">
                                        <i class="fas fa-minus" data-collapsed-icon="fa-plus" data-expanded-icon="fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr />
                    </div>
                </div>
                <?php if (!empty($ficha->exercise_training_division)) : ?>
                    <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                        <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                            <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                                <div class="input-group">
                                    <input id="Exercise Training DivisionSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>" />
                                </div>
                            </form>
                        </div>
                        <table id="Exercise Training DivisionTable" class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th><?= __('Id') ?></th>
                                    <th><?= __('Order') ?></th>
                                    <th><?= __('Series') ?></th>
                                    <th><?= __('Repetitions') ?></th>
                                    <th><?= __('Weight') ?></th>
                                    <th><?= __('Rest') ?></th>
                                    <th><?= __('Description') ?></th>
                                    <th><?= __('Ficha Id') ?></th>
                                    <th><?= __('Exercise Id') ?></th>
                                    <th><?= __('Training Division Id') ?></th>
                                    <th><?= __('Active') ?></th>
                                    <th><?= __('Created') ?></th>
                                    <th><?= __('Modified') ?></th>
                                    <th class="actions"><?= __('Ações') ?></th>
                                </tr>
                            </thead>
                            <tbody id="Exercise Training DivisionTableBody">
                                <?php foreach ($ficha->exercise_training_division as $exerciseTrainingDivision) : ?>
                                    <tr>
                                        <td>
                                            <?= h($exerciseTrainingDivision->id) ?>
                                        </td>
                                        <td>
                                            <?= h($exerciseTrainingDivision->order) ?>
                                        </td>
                                        <td>
                                            <?= h($exerciseTrainingDivision->series) ?>
                                        </td>
                                        <td>
                                            <?= h($exerciseTrainingDivision->repetitions) ?>
                                        </td>
                                        <td>
                                            <?= h($exerciseTrainingDivision->weight) ?>
                                        </td>
                                        <td>
                                            <?= h($exerciseTrainingDivision->rest) ?>
                                        </td>
                                        <td>
                                            <?= h($exerciseTrainingDivision->description) ?>
                                        </td>
                                        <td>
                                            <?= h($exerciseTrainingDivision->ficha_id) ?>
                                        </td>
                                        <td>
                                            <?= h($exerciseTrainingDivision->exercise_id) ?>
                                        </td>
                                        <td>
                                            <?= h($exerciseTrainingDivision->training_division_id) ?>
                                        </td>
                                        <td>
                                            <?= h($exerciseTrainingDivision->active) ?>
                                        </td>
                                        <td>
                                            <?= h($exerciseTrainingDivision->created) ?>
                                        </td>
                                        <td>
                                            <?= h($exerciseTrainingDivision->modified) ?>
                                        </td>
                                        <td class="actions">
                                            <?= $this->Html->link(
                                                '<i class="fas fa-eye"></i>',
                                                [
                                                    'controller' => 'Exercise Training Division',
                                                    'action' => 'view',
                                                    $ficha->id
                                                ],
                                                [
                                                    'class' => 'btn btn-view btn-sm',
                                                    'escape' => false
                                                ]
                                            )
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div id="Exercise Training DivisionNoResultsMessage" style="display: none; text-align: center; padding: 10px">
                            <?= __('Nenhum resultado encontrado.') ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <script>
            $("#Exercise Training DivisionSearchInput").on("keyup", function() {
                var input, filter, table, tr, td, i, j, txtValue, found;
                input = $("#Exercise Training DivisionSearchInput");
                filter = input.val().toUpperCase();
                table = $("#Exercise Training DivisionTable");
                tr = table.find("tr");
                found = false;

                tr.each(function(index) {
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

                $("#Exercise Training DivisionNoResultsMessage").toggle(!found);
            });
        </script>
    </section>
<?php endif; ?>