<?php
    return[
        [
            'label' => 'DashBoard',
            'route' => 'admin.dashboard',
            'icon' => 'fa-home'
        ],
        [
            'label' => 'Teachers',
            'route' => 'teacher.index',
            'icon' => 'fa-tachometer-alt',
            'items' => [
                [
                    'label' => 'List Teacher',
                    'route' => 'teacher.index',
                    'icon' => 'fa-circle'
                ],
                [
                    'label' => 'Add Teacher',
                    'route' => 'teacher.create',
                    'icon' => 'fa-circle'
                ]
            ]
        ],
        [
            'label' => 'Criteria KPI',
            'route' => 'criteria.index',
            'icon' => 'fa-tachometer-alt',
            'items' => [
                [
                    'label' => 'List Criteria KPI',
                    'route' => 'criteria.index',
                    'icon' => 'fa-circle'
                ],
                [
                    'label' => 'Add Criteria',
                    'route' => 'criteria.create',
                    'icon' => 'fa-circle'
                ]
            ]
        ],
        [
            'label' => 'Major',
            'route' => 'major.index',
            'icon' => 'fa-tachometer-alt',
            'items' => [
                [
                    'label' => 'List Major',
                    'route' => 'major.index',
                    'icon' => 'fa-circle',
                ],
                [
                    'label' => 'Add major',
                    'route' => 'major.create',
                    'icon' => 'fa-circle',
                ]
            ]
        ],
        [
            'label' => 'Salary',
            'route' => 'salary.index',
            'icon' => 'fa-tachometer-alt',
            'items' => [
                [
                    'label' => 'List salary teacher',
                    'route' => 'salary.index',
                    'icon' => 'fa-circle',
                ],
                [
                    'label' => 'Payroll',
                    'route' => 'salary.create',
                    'icon' => 'fa-circle',
                ],
                [
                    'label' => 'Salary level',
                    'route' => 'salary_level.index',
                    'icon' => 'fa-circle',
                ]
            ]
        ],
        [
            'label' => 'BHXH',
            'route' => 'bhxh.index',
            'icon' => 'fa-tachometer-alt',
            'items' =>[
                [
                    'label' => 'List BHXH',
                    'route' => 'bhxh.index',
                    'icon' => 'fa-circle',
                ],
                [
                    'label' => 'Add BHXH',
                    'route' => 'bhxh.create',
                    'icon' => 'fa-circle',
                ]
            ]
        ],
        [
            'label' => 'Account',
            'route' => 'user.index',
            'icon' => 'fa-tachometer-alt',
            'items' =>[
                [
                    'label' => 'List Account',
                    'route' => 'user.index',
                    'icon' => 'fa-circle',
                ],
                [
                    'label' => 'Add Account',
                    'route' => 'user.index',
                    'icon' => 'fa-circle',

                ]
            ]
        ]
        ,[
            'label' => 'File Manager',
            'route' => 'admin.file',
            'icon' => 'fa-tachometer-alt',
        ],

    ]
?>