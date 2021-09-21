<?php
    return[
        [
            'label' => 'DashBoard',
            'route' => 'admin.dashboard',
            'icon' => 'fa-home'
        ],
        [
            'label' => 'PayRoll',
            'route' => 'history_salary.create',
            'icon' => 'fa-tachometer-alt'
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
            'label' => 'KPI',
            'route' => 'kpi.index',
            'icon' => 'fa-tachometer-alt',
            'items' => [
                [
                    'label' => 'List KPI Criterias',
                    'route' => 'kpi.index',
                    'icon' => 'fa-circle'
                ],
                [
                    'label' => 'Add KPI Criteria',
                    'route' => 'kpi.create',
                    'icon' => 'fa-circle'
                ]
            ]
        ],
        [
            'label' => 'History KPI',
            'route' => 'history_kpi.index',
            'icon' => 'fa-tachometer-alt',
            'items' => [
                [
                    'label' => 'All history',
                    'route' => 'history_kpi.index',
                    'icon' => 'fa-circle'
                ],
                [
                    'label' => 'Current month',
                    'route' => 'history_kpi.show_by_month',
                    'icon' => 'fa-circle'
                ]
            ]
        ],
        [
            'label' => 'History Teaching Hours',
            'route' => 'history_teaching_hours.index',
            'icon' => 'fa-tachometer-alt',
            'items' => [
                [
                    'label' => 'All history',
                    'route' => 'history_teaching_hours.index',
                    'icon' => 'fa-circle'
                ],
                [
                    'label' => 'Current month',
                    'route' => 'history_teaching_hours.show_by_month',
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
                    'label' => 'Add salary',
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
            'label' => 'Insurance',
            'route' => 'insurance.index',
            'icon' => 'fa-tachometer-alt',
            'items' =>[
                [
                    'label' => 'List Insurance',
                    'route' => 'insurance.index',
                    'icon' => 'fa-circle',
                ],
                [
                    'label' => 'Add Insurance',
                    'route' => 'insurance.create',
                    'icon' => 'fa-circle',
                ],
                [
                    'label' => 'Use by teachers',
                    'route' => 'teacher_insurance.index',
                    'icon' => 'fa-circle',
                ]
            ]
        ],
        // [
        //     'label' => 'File Manager',
        //     'route' => 'admin.file',
        //     'icon' => 'fa-tachometer-alt',
        // ],
        
    ]
?>