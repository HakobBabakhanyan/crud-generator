<?php
//
//crud=>[
//    'pages'=>[
//        'title'=>'title' title for crud
//        'list_show'=>show crud form list
//    ]
//]

return [
    'crud' => [
        'Pages' => [
            'title' => 'Pages',
            'route' => 'pages',
//            'childes' => ['SubPages' => 'parent_id'],
            'controller' => 'Admin\PagesController',
            'model' => 'App\Models\Pages',
            'sortable' => 'sorting',
            'validate' => [ // TODO  validate edited
                'store' => [
                    'name.*' => 'required',
                ],
                'update' => [
                    'name.*' => 'required',
                ]
            ],
            'column' => [
                'url' => [
                    'title' => 'Url',
                    'type' => 'text',
                    'custom'=>[
                        'id'=>[
                            2=>false
                        ]
                    ]
                ],
                'name' => [
                    'title' => 'Name',
                    'translate' => true,
                    'type' => 'text',
                    'casts'=>'collection'
                ],
                'status' => [
                    'title' => 'Active',
                    'type' => 'checkbox',
                    'default' => 0
                ]
            ],
            'list' => [
                'name', 'url', 'status'
            ],
            'images'=>[
                'default'=>[
                    'title'=>'select default',
                    'path'=>'images/pages/default/',
                    'custom'=>[
                        'id'=>[
                            1=>false,
                            2=>[
                                'title'=>'select gallery',
                                'path'=>'images/pages/gallery/',
                                'multiple'=>true
                            ],
                            3=>[
                                'title'=>'Select title' // TODO edited select parent config
                            ]
                        ]
                    ]
                ]
            ]
        ],
    ],

];
