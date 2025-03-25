<?php
$loggedUserId = $this->request->getSession()->read('Auth.User.id');
$this->assign('title', 'Colaborador');
?>
<section class="content mt-4">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                            <h3 class="card-title">
                                <?= __('Visualizar colaborador') ?>
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
                                        <a href="<?= $this->Url->build(['action' => 'index']) ?>">Colaboradores</a>
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
                        <?= $this->Number->format($collaborator->id) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Nome'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($collaborator->name) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Cargo'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $collaborator->has('position') ? $this->Html->link($collaborator->position->name, ['controller' => 'Positions', 'action' => 'view', $collaborator->position->id]) : '' ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Usuário'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $collaborator->has('user') ? $this->Html->link($collaborator->user->email, ['controller' => 'Users', 'action' => 'view', $collaborator->user->id]) : '' ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Gênero'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($collaborator->gender) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Imagem'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($collaborator->img) ?>
                    </div>
                </div>

                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Data de Nascimento'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($collaborator->birth_date) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Data de Entrada'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($collaborator->entry_date) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Ativo'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= $collaborator->active ? __('Sim') : __('Não'); ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Criado'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($collaborator->created) ?>
                    </div>
                </div>
                <div class="row item-row">
                    <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 control-label">
                        <?= __('Modificado'); ?>
                    </label>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 control-label">
                        <?= h($collaborator->modified) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($collaborator->calleds)) : ?>
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
                                    <button type="button" class="btn btn-tool" id="icon-dropdown" data-card-widget="collapse">
                                        <i class="fas fa-minus" data-collapsed-icon="fa-plus" data-expanded-icon="fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr />
                    </div>
                </div>
                <?php if (!empty($collaborator->calleds)) : ?>
                    <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                        <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                            <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                                <div class="input-group">
                                    <input id="CalledsSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>" />
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
                                <?php foreach ($collaborator->calleds as $calleds) : ?>
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
                                            <?= $this->Html->link(
                                                '<i class="fas fa-eye"></i>',
                                                [
                                                    'controller' => 'Calleds',
                                                    'action' => 'view',
                                                    $collaborator->id
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
                        <div id="CalledsNoResultsMessage" style="display: none; text-align: center; padding: 10px">
                            <?= __('Nenhum resultado encontrado.') ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <script>
            $("#CalledsSearchInput").on("keyup", function() {
                var input, filter, table, tr, td, i, j, txtValue, found;
                input = $("#CalledsSearchInput");
                filter = input.val().toUpperCase();
                table = $("#CalledsTable");
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

                $("#CalledsNoResultsMessage").toggle(!found);
            });
        </script>
    </section>
<?php endif; ?>

<?php if (!empty($collaborator->events)) : ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                                <h3 class="card-title">
                                    <?= __('Relacionado Events') ?>
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
                <?php if (!empty($collaborator->events)) : ?>
                    <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                        <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                            <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                                <div class="input-group">
                                    <input id="EventsSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>" />
                                </div>
                            </form>
                        </div>
                        <table id="EventsTable" class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th><?= __('Id') ?></th>
                                    <th><?= __('Name') ?></th>
                                    <th><?= __('Description') ?></th>
                                    <th><?= __('Date') ?></th>
                                    <th><?= __('Location') ?></th>
                                    <th><?= __('Max Participants') ?></th>
                                    <th><?= __('Collaborator Id') ?></th>
                                    <th><?= __('Created') ?></th>
                                    <th><?= __('Modified') ?></th>
                                    <th class="actions"><?= __('Ações') ?></th>
                                </tr>
                            </thead>
                            <tbody id="EventsTableBody">
                                <?php foreach ($collaborator->events as $events) : ?>
                                    <tr>
                                        <td>
                                            <?= h($events->id) ?>
                                        </td>
                                        <td>
                                            <?= h($events->name) ?>
                                        </td>
                                        <td>
                                            <?= h($events->description) ?>
                                        </td>
                                        <td>
                                            <?= h($events->date) ?>
                                        </td>
                                        <td>
                                            <?= h($events->location) ?>
                                        </td>
                                        <td>
                                            <?= h($events->max_participants) ?>
                                        </td>
                                        <td>
                                            <?= h($events->collaborator_id) ?>
                                        </td>
                                        <td>
                                            <?= h($events->created) ?>
                                        </td>
                                        <td>
                                            <?= h($events->modified) ?>
                                        </td>
                                        <td class="actions">
                                            <?= $this->Html->link(
                                                '<i class="fas fa-eye"></i>',
                                                [
                                                    'controller' => 'Events',
                                                    'action' => 'view',
                                                    $collaborator->id
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
                        <div id="EventsNoResultsMessage" style="display: none; text-align: center; padding: 10px">
                            <?= __('Nenhum resultado encontrado.') ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <script>
            $("#EventsSearchInput").on("keyup", function() {
                var input, filter, table, tr, td, i, j, txtValue, found;
                input = $("#EventsSearchInput");
                filter = input.val().toUpperCase();
                table = $("#EventsTable");
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

                $("#EventsNoResultsMessage").toggle(!found);
            });
        </script>
    </section>
<?php endif; ?>

<?php if (!empty($collaborator->medias)) : ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                                <h3 class="card-title">
                                    <?= __('Relacionado Medias') ?>
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
                <?php if (!empty($collaborator->medias)) : ?>
                    <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                        <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                            <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                                <div class="input-group">
                                    <input id="MediasSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>" />
                                </div>
                            </form>
                        </div>
                        <table id="MediasTable" class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th><?= __('Id') ?></th>
                                    <th><?= __('Title') ?></th>
                                    <th><?= __('Type') ?></th>
                                    <th><?= __('Img') ?></th>
                                    <th><?= __('Link') ?></th>
                                    <th><?= __('Description') ?></th>
                                    <th><?= __('Collaborator Id') ?></th>
                                    <th><?= __('Active') ?></th>
                                    <th><?= __('Created') ?></th>
                                    <th><?= __('Modified') ?></th>
                                    <th class="actions"><?= __('Ações') ?></th>
                                </tr>
                            </thead>
                            <tbody id="MediasTableBody">
                                <?php foreach ($collaborator->medias as $medias) : ?>
                                    <tr>
                                        <td>
                                            <?= h($medias->id) ?>
                                        </td>
                                        <td>
                                            <?= h($medias->title) ?>
                                        </td>
                                        <td>
                                            <?= h($medias->type) ?>
                                        </td>
                                        <td>
                                            <?= h($medias->img) ?>
                                        </td>
                                        <td>
                                            <?= h($medias->link) ?>
                                        </td>
                                        <td>
                                            <?= h($medias->description) ?>
                                        </td>
                                        <td>
                                            <?= h($medias->collaborator_id) ?>
                                        </td>
                                        <td>
                                            <?= h($medias->active) ?>
                                        </td>
                                        <td>
                                            <?= h($medias->created) ?>
                                        </td>
                                        <td>
                                            <?= h($medias->modified) ?>
                                        </td>
                                        <td class="actions">
                                            <?= $this->Html->link(
                                                '<i class="fas fa-eye"></i>',
                                                [
                                                    'controller' => 'Medias',
                                                    'action' => 'view',
                                                    $collaborator->id
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
                        <div id="MediasNoResultsMessage" style="display: none; text-align: center; padding: 10px">
                            <?= __('Nenhum resultado encontrado.') ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <script>
            $("#MediasSearchInput").on("keyup", function() {
                var input, filter, table, tr, td, i, j, txtValue, found;
                input = $("#MediasSearchInput");
                filter = input.val().toUpperCase();
                table = $("#MediasTable");
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

                $("#MediasNoResultsMessage").toggle(!found);
            });
        </script>
    </section>
<?php endif; ?>

<?php if (!empty($collaborator->monthly_plans)) : ?>
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
                                    <button type="button" class="btn btn-tool" id="icon-dropdown" data-card-widget="collapse">
                                        <i class="fas fa-minus" data-collapsed-icon="fa-plus" data-expanded-icon="fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr />
                    </div>
                </div>
                <?php if (!empty($collaborator->monthly_plans)) : ?>
                    <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                        <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                            <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                                <div class="input-group">
                                    <input id="Monthly PlansSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>" />
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
                                <?php foreach ($collaborator->monthly_plans as $monthlyPlans) : ?>
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
                                            <?= $this->Html->link(
                                                '<i class="fas fa-eye"></i>',
                                                [
                                                    'controller' => 'Monthly Plans',
                                                    'action' => 'view',
                                                    $collaborator->id
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
                        <div id="Monthly PlansNoResultsMessage" style="display: none; text-align: center; padding: 10px">
                            <?= __('Nenhum resultado encontrado.') ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <script>
            $("#Monthly PlansSearchInput").on("keyup", function() {
                var input, filter, table, tr, td, i, j, txtValue, found;
                input = $("#Monthly PlansSearchInput");
                filter = input.val().toUpperCase();
                table = $("#Monthly PlansTable");
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

                $("#Monthly PlansNoResultsMessage").toggle(!found);
            });
        </script>
    </section>
<?php endif; ?>

<?php if (!empty($collaborator->work_logs)) : ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6 order-2 order-md-1 mt-4">
                                <h3 class="card-title">
                                    <?= __('Relacionado Work Logs') ?>
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
                <?php if (!empty($collaborator->work_logs)) : ?>
                    <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto">
                        <div class="col-12 col-md-6 mb-2 mb-md-2 mt-2">
                            <form class="form-inline w-100" method="get" action="<?= $this->Url->build() ?>">
                                <div class="input-group">
                                    <input id="Work LogsSearchInput" class="form-control col-12" type="search" placeholder="Pesquisar..." aria-label="Pesquisar" name="search" value="<?= $this->request->getQuery('search') ?>" />
                                </div>
                            </form>
                        </div>
                        <table id="Work LogsTable" class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th><?= __('Id') ?></th>
                                    <th><?= __('Collaborator Id') ?></th>
                                    <th><?= __('Log Date') ?></th>
                                    <th><?= __('Log Type') ?></th>
                                    <th><?= __('Log Time') ?></th>
                                    <th><?= __('Log Address') ?></th>
                                    <th><?= __('Latitude') ?></th>
                                    <th><?= __('Longitude') ?></th>
                                    <th><?= __('Created') ?></th>
                                    <th><?= __('Modified') ?></th>
                                    <th class="actions"><?= __('Ações') ?></th>
                                </tr>
                            </thead>
                            <tbody id="Work LogsTableBody">
                                <?php foreach ($collaborator->work_logs as $workLogs) : ?>
                                    <tr>
                                        <td>
                                            <?= h($workLogs->id) ?>
                                        </td>
                                        <td>
                                            <?= h($workLogs->collaborator_id) ?>
                                        </td>
                                        <td>
                                            <?= h($workLogs->log_date) ?>
                                        </td>
                                        <td>
                                            <?= h($workLogs->log_type) ?>
                                        </td>
                                        <td>
                                            <?= h($workLogs->log_time) ?>
                                        </td>
                                        <td>
                                            <?= h($workLogs->log_address) ?>
                                        </td>
                                        <td>
                                            <?= h($workLogs->latitude) ?>
                                        </td>
                                        <td>
                                            <?= h($workLogs->longitude) ?>
                                        </td>
                                        <td>
                                            <?= h($workLogs->created) ?>
                                        </td>
                                        <td>
                                            <?= h($workLogs->modified) ?>
                                        </td>
                                        <td class="actions">
                                            <?= $this->Html->link(
                                                '<i class="fas fa-eye"></i>',
                                                [
                                                    'controller' => 'Work Logs',
                                                    'action' => 'view',
                                                    $collaborator->id
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
                        <div id="Work LogsNoResultsMessage" style="display: none; text-align: center; padding: 10px">
                            <?= __('Nenhum resultado encontrado.') ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <script>
            $("#Work LogsSearchInput").on("keyup", function() {
                var input, filter, table, tr, td, i, j, txtValue, found;
                input = $("#Work LogsSearchInput");
                filter = input.val().toUpperCase();
                table = $("#Work LogsTable");
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

                $("#Work LogsNoResultsMessage").toggle(!found);
            });
        </script>
    </section>
<?php endif; ?>