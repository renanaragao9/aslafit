<?php

use App\Utility\AccessChecker;

$loggedUserId = $this->request->getSession()->read('Auth.User.id');

function hasPermission($userId, $permission)
{
  return AccessChecker::hasPermission($userId, $permission);
}

function generateNavItem($controller, $action, $iconClass, $label, $request, $htmlHelper, $url = null)
{
  $currentController = $request->getParam('controller');
  $path = $request->getPath();
  $isActive = ($url && $path === $url) || (!$url && $currentController === $controller);

  return $htmlHelper->link(
    "<i class=\"$iconClass nav-icon\"></i><p>$label</p>",
    $url ?: ['controller' => $controller, 'action' => $action],
    ['class' => 'nav-link ' . ($isActive ? 'active' : ''), 'escape' => false]
  );
}

function generateMenuSection($section, $loggedUserId, $request, $htmlHelper)
{
  // Menu sem subitens
  if (!isset($section['items'])) {
    if (!isset($section['permission']) || hasPermission($loggedUserId, $section['permission'])) {
      return '<li class="nav-item">' .
        generateNavItem(
          $section['controller'] ?? null,
          $section['action'] ?? null,
          $section['icon'],
          $section['label'],
          $request,
          $htmlHelper,
          $section['url'] ?? null
        ) .
        '</li>';
    }
    return '';
  }

  // Menu com subitens
  $hasPermission = false;
  $menuItems = '';

  foreach ($section['items'] as $item) {
    if (hasPermission($loggedUserId, $item['permission'])) {
      $hasPermission = true;
      $menuItems .= '<li class="nav-item">' . generateNavItem(
        $item['controller'],
        $item['action'],
        $item['icon'],
        $item['label'],
        $request,
        $htmlHelper
      ) . '</li>';
    }
  }

  if ($hasPermission) {
    $isActive = in_array($request->getParam('controller'), array_column($section['items'], 'controller')) ? 'menu-open' : '';
    $isLinkActive = $isActive ? 'active' : '';

    return <<<HTML
<li class="nav-item has-treeview $isActive">
    <a href="#" class="nav-link $isLinkActive">
        <i class="{$section['icon']}"></i>
        <p>
            {$section['label']}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        $menuItems
    </ul>
</li>
HTML;
  }

  return '';
}

$menuSections = [
  [
    'label' => 'Dashboard',
    'icon' => 'fas fa-tachometer-alt',
    'url' => '/',
  ],
  [
    'label' => 'Colaboradores',
    'icon' => 'fas fa-users',
    'url' => '/colaboradores',
  ],
  [
    'label' => 'Alunos',
    'icon' => 'fa-regular fa-users',
    'url' => '/alunos',
  ],

  [
    'label' => 'Plano de treino',
    'icon' => 'fa-regular fa-dumbbell',
    'items' => [
      ['controller' => 'Equipments', 'action' => 'index', 'icon' => 'fa-light fa-circle-notch', 'label' => 'Equipamentos', 'permission' => 'Equipments/index'],
      ['controller' => 'TrainingDivisions', 'action' => 'index', 'icon' => 'fa-light fa-circle-notch', 'label' => 'Divisões de Treino', 'permission' => 'TrainingDivisions/index'],
      ['controller' => 'MuscleGroups', 'action' => 'index', 'icon' => 'fa-light fa-circle-notch', 'label' => 'Grupos Musculares', 'permission' => 'MuscleGroups/index'],
      ['controller' => 'Exercises', 'action' => 'index', 'icon' => 'fa-light fa-circle-notch', 'label' => 'Exercícios', 'permission' => 'Exercises/index'],
      ['controller' => 'FoodTypes', 'action' => 'index', 'icon' => 'fa-light fa-circle-notch', 'label' => 'Tipos de alimento', 'permission' => 'FoodTypes/index'],
      ['controller' => 'Foods', 'action' => 'index', 'icon' => 'fa-light fa-circle-notch', 'label' => 'Alimentos', 'permission' => 'Foods/index'],
      ['controller' => 'MealTypes', 'action' => 'index', 'icon' => 'fa-light fa-circle-notch', 'label' => 'Tipos de Refeição', 'permission' => 'MealTypes/index'],
      ['controller' => 'Fichas', 'action' => 'index', 'icon' => 'fa-light fa-circle-notch', 'label' => 'Fichas', 'permission' => 'Fichas/index'],
    ],
  ],
  [
    'label' => 'Estoque',
    'icon' => 'fa-regular fa-boxes-stacked',
    'items' => [
      ['controller' => 'ItemTypes', 'action' => 'index', 'icon' => 'fa-light fa-circle-notch', 'label' => 'Tipos de Item', 'permission' => 'ItemTypes/index'],
      ['controller' => 'StorageLocations', 'action' => 'index', 'icon' => 'fa-light fa-circle-notch', 'label' => 'Locais de armazenamento', 'permission' => 'StorageLocations/index'],
      ['controller' => 'Suppliers', 'action' => 'index', 'icon' => 'fa-light fa-circle-notch', 'label' => 'Fornecedores', 'permission' => 'Suppliers/index'],
    ],
  ],
  [
    'label' => 'Recursos humanos',
    'icon' => 'fa-regular fa-boxes-stacked',
    'items' => [
      ['controller' => 'Users', 'action' => 'index', 'icon' => 'fa-light fa-circle-notch', 'label' => 'Usuários', 'permission' => 'Users/index'],
      ['controller' => 'Roles', 'action' => 'index', 'icon' => 'fa-light fa-circle-notch', 'label' => 'Perfis', 'permission' => 'Roles/index'],
      ['controller' => 'Positions', 'action' => 'index', 'icon' => 'fa-light fa-circle-notch', 'label' => 'Cargos', 'permission' => 'Positions/index'],
      ['controller' => 'WorkLogs', 'action' => 'index', 'icon' => 'fa-light fa-circle-notch', 'label' => 'Registros de trabalho', 'permission' => 'WorkLogs/index'],
    ],
  ],
  [
    'label' => 'Financeiro',
    'icon' => 'fa-regular fa-hands-holding-dollar',
    'items' => [
      ['controller' => 'FormPayments', 'action' => 'index', 'icon' => 'fa-light fa-circle-notch', 'label' => 'Formas de pagamentos', 'permission' => 'FormPayments/index'],
      ['controller' => 'PlanTypes', 'action' => 'index', 'icon' => 'fa-light fa-circle-notch', 'label' => 'Tipos de planos', 'permission' => 'PlanTypes/index'],
      ['controller' => 'MonthlyPlans', 'action' => 'index', 'icon' => 'fa-light fa-circle-notch', 'label' => 'Mensalidades', 'permission' => 'MonthlyPlans/index'],
    ],
  ],
  [
    'label' => 'Chamados',
    'icon' => 'fa-regular fa-headset',
    'url' => '/chamados',
    'permission' => 'Calleds/index',
  ],
  [
    'label' => 'Mídias',
    'icon' => 'fa-solid fa-photo-film-music',
    'url' => '/midias',
    'permission' => 'Medias/index',
  ],
];

?>

<?php
foreach ($menuSections as $section) {
  echo generateMenuSection($section, $loggedUserId, $this->request, $this->Html);
}
?>
