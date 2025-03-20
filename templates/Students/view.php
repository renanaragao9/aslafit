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
                                <?= __('Visualizar student') ?>
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
                                        <a href="<?= $this->Url->build(['action' => 'index']) ?>">student</a>
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
                        <?= h($student->name) ?>
                    </div>
                </div>
                                  <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Gender'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($student->gender) ?>
                    </div>
                </div>
                                  <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Color'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($student->color) ?>
                    </div>
                </div>
                                  <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Img'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($student->img) ?>
                    </div>
                </div>
                                   <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('User'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $student->has('user') ? $this->Html->link($student->user->name, ['controller' => 'Users', 'action' => 'view', $student->user->id]) : '' ?>
                    </div>
                </div>
                                     <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Id'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                                                 <?= $this->Number->format($student->id) ?> 
                                            </div>
                </div>
                                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Weight'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                                                 <?= $this->Number->format($student->weight) ?> 
                                            </div>
                </div>
                                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Height'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                                                 <?= $this->Number->format($student->height) ?> 
                                            </div>
                </div>
                                   <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Birth Date'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($student->birth_date) ?>
                    </div>
                </div>
                                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Entry Date'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($student->entry_date) ?>
                    </div>
                </div>
                                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Created'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($student->created) ?>
                    </div>
                </div>
                                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Modified'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($student->modified) ?>
                    </div>
                </div>
                                   <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label" >
                        <?= __('Active'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $student->active ? __('Sim') : __('Não'); ?>
                    </div>
                </div>
                             </div>
        </div>
    </div>
</section>
       
<?php if (!empty($student->assessments)) : ?>
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
                                <button type="button" class="btn btn-tool" id="icon-dropdown" data-card-widget="collapse" >
                                    <i class="fas fa-minus" data-collapsed-icon="fa-plus" data-expanded-icon="fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr />
                </div>
            </div>
            <?php if (!empty($student->assessments)) : ?>
                <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                    <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                        <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                            <div class="input-group">
                                <input id="AssessmentsSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>"/>
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
                            <?php foreach ($student->assessments as $assessments) : ?>
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
                                        <?= $this->Html->link('<i class="fas fa-eye"></i>', 
                                            [
                                                'controller' => 'Assessments', 
                                                'action' => 'view', 
                                                $student->id
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
                    <div id="AssessmentsNoResultsMessage" style="display: none; text-align: center; padding: 10px">
                        <?= __('Nenhum resultado encontrado.') ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script>
        $("#AssessmentsSearchInput").on("keyup", function () {
            var input, filter, table, tr, td, i, j, txtValue, found;
            input = $("#AssessmentsSearchInput");
            filter = input.val().toUpperCase();
            table = $("#AssessmentsTable");
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

            $("#AssessmentsNoResultsMessage").toggle(!found);
        });
    </script>
</section>
<?php endif; ?>
     
<?php if (!empty($student->calleds)) : ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                            <h3 class="card-title">
                                <?= __('Relacionado Calleds') ?>
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
            <?php if (!empty($student->calleds)) : ?>
                <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                    <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                        <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                            <div class="input-group">
                                <input id="CalledsSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>"/>
                            </div>
                        </form>
                    </div>
                    <table id="CalledsTable" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                                                <th><?= __('Id') ?></th>
                                                                <th><?= __('Urgency') ?></th>
                                                                <th><?= __('Title') ?></th>
                                                                <th><?= __('Subject') ?></th>
                                                                <th><?= __('Status') ?></th>
                                                                <th><?= __('Active') ?></th>
                                                                <th><?= __('Collaborator Id') ?></th>
                                                                <th><?= __('Student Id') ?></th>
                                                                <th><?= __('Created') ?></th>
                                                                <th><?= __('Modified') ?></th>
                                                                <th class="actions"><?= __('Ações') ?></th>
                            </tr>
                        </thead>
                        <tbody id="CalledsTableBody">
                            <?php foreach ($student->calleds as $calleds) : ?>
                                <tr>
                                                                        <td>
                                        <?= h($calleds->id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($calleds->urgency) ?>
                                    </td>
                                                                        <td>
                                        <?= h($calleds->title) ?>
                                    </td>
                                                                        <td>
                                        <?= h($calleds->subject) ?>
                                    </td>
                                                                        <td>
                                        <?= h($calleds->status) ?>
                                    </td>
                                                                        <td>
                                        <?= h($calleds->active) ?>
                                    </td>
                                                                        <td>
                                        <?= h($calleds->collaborator_id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($calleds->student_id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($calleds->created) ?>
                                    </td>
                                                                        <td>
                                        <?= h($calleds->modified) ?>
                                    </td>
                                                                         <td class="actions">
                                        <?= $this->Html->link('<i class="fas fa-eye"></i>', 
                                            [
                                                'controller' => 'Calleds', 
                                                'action' => 'view', 
                                                $student->id
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
                    <div id="CalledsNoResultsMessage" style="display: none; text-align: center; padding: 10px">
                        <?= __('Nenhum resultado encontrado.') ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script>
        $("#CalledsSearchInput").on("keyup", function () {
            var input, filter, table, tr, td, i, j, txtValue, found;
            input = $("#CalledsSearchInput");
            filter = input.val().toUpperCase();
            table = $("#CalledsTable");
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

            $("#CalledsNoResultsMessage").toggle(!found);
        });
    </script>
</section>
<?php endif; ?>
     
<?php if (!empty($student->diet_plans)) : ?>
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
            <?php if (!empty($student->diet_plans)) : ?>
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
                            <?php foreach ($student->diet_plans as $dietPlans) : ?>
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
                                                $student->id
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
     
<?php if (!empty($student->event_registrations)) : ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                            <h3 class="card-title">
                                <?= __('Relacionado Event Registrations') ?>
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
            <?php if (!empty($student->event_registrations)) : ?>
                <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                    <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                        <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                            <div class="input-group">
                                <input id="Event RegistrationsSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>"/>
                            </div>
                        </form>
                    </div>
                    <table id="Event RegistrationsTable" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                                                <th><?= __('Id') ?></th>
                                                                <th><?= __('Event Id') ?></th>
                                                                <th><?= __('Student Id') ?></th>
                                                                <th><?= __('Confirmed') ?></th>
                                                                <th><?= __('Created') ?></th>
                                                                <th><?= __('Modified') ?></th>
                                                                <th class="actions"><?= __('Ações') ?></th>
                            </tr>
                        </thead>
                        <tbody id="Event RegistrationsTableBody">
                            <?php foreach ($student->event_registrations as $eventRegistrations) : ?>
                                <tr>
                                                                        <td>
                                        <?= h($eventRegistrations->id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($eventRegistrations->event_id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($eventRegistrations->student_id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($eventRegistrations->confirmed) ?>
                                    </td>
                                                                        <td>
                                        <?= h($eventRegistrations->created) ?>
                                    </td>
                                                                        <td>
                                        <?= h($eventRegistrations->modified) ?>
                                    </td>
                                                                         <td class="actions">
                                        <?= $this->Html->link('<i class="fas fa-eye"></i>', 
                                            [
                                                'controller' => 'Event Registrations', 
                                                'action' => 'view', 
                                                $student->id
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
                    <div id="Event RegistrationsNoResultsMessage" style="display: none; text-align: center; padding: 10px">
                        <?= __('Nenhum resultado encontrado.') ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script>
        $("#Event RegistrationsSearchInput").on("keyup", function () {
            var input, filter, table, tr, td, i, j, txtValue, found;
            input = $("#Event RegistrationsSearchInput");
            filter = input.val().toUpperCase();
            table = $("#Event RegistrationsTable");
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

            $("#Event RegistrationsNoResultsMessage").toggle(!found);
        });
    </script>
</section>
<?php endif; ?>
     
<?php if (!empty($student->fichas)) : ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                            <h3 class="card-title">
                                <?= __('Relacionado Fichas') ?>
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
            <?php if (!empty($student->fichas)) : ?>
                <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                    <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                        <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                            <div class="input-group">
                                <input id="FichasSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>"/>
                            </div>
                        </form>
                    </div>
                    <table id="FichasTable" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                                                <th><?= __('Id') ?></th>
                                                                <th><?= __('Start Date') ?></th>
                                                                <th><?= __('End Date') ?></th>
                                                                <th><?= __('Description') ?></th>
                                                                <th><?= __('Notes') ?></th>
                                                                <th><?= __('Student Id') ?></th>
                                                                <th><?= __('Active') ?></th>
                                                                <th><?= __('Created') ?></th>
                                                                <th><?= __('Modified') ?></th>
                                                                <th class="actions"><?= __('Ações') ?></th>
                            </tr>
                        </thead>
                        <tbody id="FichasTableBody">
                            <?php foreach ($student->fichas as $fichas) : ?>
                                <tr>
                                                                        <td>
                                        <?= h($fichas->id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($fichas->start_date) ?>
                                    </td>
                                                                        <td>
                                        <?= h($fichas->end_date) ?>
                                    </td>
                                                                        <td>
                                        <?= h($fichas->description) ?>
                                    </td>
                                                                        <td>
                                        <?= h($fichas->notes) ?>
                                    </td>
                                                                        <td>
                                        <?= h($fichas->student_id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($fichas->active) ?>
                                    </td>
                                                                        <td>
                                        <?= h($fichas->created) ?>
                                    </td>
                                                                        <td>
                                        <?= h($fichas->modified) ?>
                                    </td>
                                                                         <td class="actions">
                                        <?= $this->Html->link('<i class="fas fa-eye"></i>', 
                                            [
                                                'controller' => 'Fichas', 
                                                'action' => 'view', 
                                                $student->id
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
                    <div id="FichasNoResultsMessage" style="display: none; text-align: center; padding: 10px">
                        <?= __('Nenhum resultado encontrado.') ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script>
        $("#FichasSearchInput").on("keyup", function () {
            var input, filter, table, tr, td, i, j, txtValue, found;
            input = $("#FichasSearchInput");
            filter = input.val().toUpperCase();
            table = $("#FichasTable");
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

            $("#FichasNoResultsMessage").toggle(!found);
        });
    </script>
</section>
<?php endif; ?>
     
<?php if (!empty($student->monthly_plans)) : ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                            <h3 class="card-title">
                                <?= __('Relacionado Monthly Plans') ?>
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
            <?php if (!empty($student->monthly_plans)) : ?>
                <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                    <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                        <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                            <div class="input-group">
                                <input id="Monthly PlansSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>"/>
                            </div>
                        </form>
                    </div>
                    <table id="Monthly PlansTable" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                                                <th><?= __('Id') ?></th>
                                                                <th><?= __('Date Payment') ?></th>
                                                                <th><?= __('Date Venciment') ?></th>
                                                                <th><?= __('Value') ?></th>
                                                                <th><?= __('Observation') ?></th>
                                                                <th><?= __('Payment Id') ?></th>
                                                                <th><?= __('Plan Type Id') ?></th>
                                                                <th><?= __('Student Id') ?></th>
                                                                <th><?= __('Collaborator Id') ?></th>
                                                                <th><?= __('Created') ?></th>
                                                                <th><?= __('Modified') ?></th>
                                                                <th class="actions"><?= __('Ações') ?></th>
                            </tr>
                        </thead>
                        <tbody id="Monthly PlansTableBody">
                            <?php foreach ($student->monthly_plans as $monthlyPlans) : ?>
                                <tr>
                                                                        <td>
                                        <?= h($monthlyPlans->id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($monthlyPlans->date_payment) ?>
                                    </td>
                                                                        <td>
                                        <?= h($monthlyPlans->date_venciment) ?>
                                    </td>
                                                                        <td>
                                        <?= h($monthlyPlans->value) ?>
                                    </td>
                                                                        <td>
                                        <?= h($monthlyPlans->observation) ?>
                                    </td>
                                                                        <td>
                                        <?= h($monthlyPlans->payment_id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($monthlyPlans->plan_type_id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($monthlyPlans->student_id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($monthlyPlans->collaborator_id) ?>
                                    </td>
                                                                        <td>
                                        <?= h($monthlyPlans->created) ?>
                                    </td>
                                                                        <td>
                                        <?= h($monthlyPlans->modified) ?>
                                    </td>
                                                                         <td class="actions">
                                        <?= $this->Html->link('<i class="fas fa-eye"></i>', 
                                            [
                                                'controller' => 'Monthly Plans', 
                                                'action' => 'view', 
                                                $student->id
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
                    <div id="Monthly PlansNoResultsMessage" style="display: none; text-align: center; padding: 10px">
                        <?= __('Nenhum resultado encontrado.') ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script>
        $("#Monthly PlansSearchInput").on("keyup", function () {
            var input, filter, table, tr, td, i, j, txtValue, found;
            input = $("#Monthly PlansSearchInput");
            filter = input.val().toUpperCase();
            table = $("#Monthly PlansTable");
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

            $("#Monthly PlansNoResultsMessage").toggle(!found);
        });
    </script>
</section>
<?php endif; ?>
