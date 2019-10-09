<?php

Breadcrumbs::for('admin.record.package.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('Package Management'), route('admin.record.package.index'));
});

Breadcrumbs::for('admin.record.package.create', function ($trail) {
    $trail->parent('admin.record.package.index');
    $trail->push(__('Create Package'), route('admin.record.package.create'));
});

Breadcrumbs::for('admin.record.package.edit', function ($trail, $id) {
    $trail->parent('admin.record.package.index');
    $trail->push(__('Edit Package'), route('admin.record.package.edit', $id));
});

Breadcrumbs::for('admin.record.package.show', function ($trail, $id) {
    $trail->parent('admin.record.package.index');
    $trail->push(__('Show Package'), route('admin.record.package.show', $id));
});
