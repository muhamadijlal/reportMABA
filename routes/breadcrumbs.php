<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
  $trail->push('Dashboard', route('dashboard'));
});

// Dashboard > detail
Breadcrumbs::for('detail-report', function (BreadcrumbTrail $trail, $data) {
  $trail->parent('dashboard');  
  $trail->push('Detail Report', route('detail-report', $data));
});

// Dashboard > form edit report
Breadcrumbs::for('edit-report', function (BreadcrumbTrail $trail, $data) {
  $trail->parent('dashboard');
  $trail->push('Form Edit Report', route('edit-report', $data));
});

// dashboard > Add report
Breadcrumbs::for('add-report', function (BreadcrumbTrail $trail) {
  $trail->parent('dashboard');
  $trail->push('Tambah Report', route('add-report'));
});

// dashboard > Import
Breadcrumbs::for('import', function (BreadcrumbTrail $trail) {
  $trail->parent('dashboard');
  $trail->push('Import', route('import'));
});

// Dashboard > report data
Breadcrumbs::for('report-data', function($trail, $data){
  $trail->parent('dashboard');
  $trail->push('Report data', route('report-data', $data));
});

// Dashboard > import > manual
Breadcrumbs::for('manual-import', function($trail){
  $trail->parent('import');
  $trail->push('Tambah', route('create'));
});