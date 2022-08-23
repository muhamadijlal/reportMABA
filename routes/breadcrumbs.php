<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
  $trail->push('Dashboard', route('dashboard'));
});

// Dashboard > form edit report
Breadcrumbs::for('edit-report', function (BreadcrumbTrail $trail, $data) {
  $trail->parent('dashboard');
  $trail->push('Form Edit Report', route('edit-report', $data));
});

// dashboard > Add report
Breadcrumbs::for('add-report', function (BreadcrumbTrail $trail) {
  $trail->parent('dashboard');
  $trail->push('Add Report', route('add-report'));
});

// dashboard > Import
Breadcrumbs::for('import', function (BreadcrumbTrail $trail) {
  $trail->parent('dashboard');
  $trail->push('Import', route('import'));
});