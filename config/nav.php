<?php

return [
    [
        'name' => 'Dashboard',
        'route' => 'dashboard.dashboard',
        'icon' => 'ri-home-smile-line',
        'active' => 'dashboard.dashboard',
    ],
    [
        'name' => 'Categories',
        'route' => 'dashboard.categories.index',
        'icon' => 'ri-table-alt-line',
        'active' => 'dashboard.categories.*',
    ],
    [
        'name' => 'Products',
        'route' => 'dashboard.categories.index',
        'icon' => 'ri-table-alt-line',
        'active' => 'dashboard.products.*',
    ],
    [
        'name' => 'Orders',
        'route' => 'dashboard.categories.index',
        'icon' => 'ri-table-alt-line',
        'active' => 'dashboard.orders.*',
    ]
];