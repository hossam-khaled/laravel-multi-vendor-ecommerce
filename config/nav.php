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
        'name' => 'Stores',
        'route' => 'dashboard.stores.index',
        'icon' => 'ri-store-3-fill',
        'active' => 'dashboard.stores.*',
    ],
    [
        'name' => 'Products',
        'route' => 'dashboard.products.index',
        'icon' => 'ri-product-hunt-line',
        'active' => 'dashboard.products.*',
    ],
    [
        'name' => 'Orders',
        'route' => 'dashboard.products.index',
        'icon' => 'ri-table-alt-line',
        'active' => 'dashboard.products.*',
    ],
];