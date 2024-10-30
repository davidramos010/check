<?php

return [
    'dominio' => 'http://ipcheck.es/',
    'proyecto' => 'IpCheck',
    'adminEmail' => 'info@ipcheck.es',
    'senderEmail' => 'info@ipcheck.es',
    'senderName' => 'www.ipcheck.es',
    'contacto' => 'ipcheck - cali - colombia',
    'empresa' => 'ipcheck',
    'email' => 'info@ipcheck.es',
    'telefono' => '123 456 789',
    'movil' => '123 456 789',
    'direccion' => 'Carrer López i Puigcerver, 111',
    'poblacion' => '12345 Cali, Colombia',
    'bsVersion' => '4.x', // this will set globally `bsVersion` to Bootstrap 5.x for all Krajee Extensions
    'hail812/yii2-adminlte3' => [
        'pluginMap' => [
            'sweetalert2' => [
                'css' => 'sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
                'js' => 'sweetalert2/sweetalert2.min.js'
            ],
            'toastr' => [
                'css' => ['toastr/toastr.min.css'],
                'js' => ['toastr/toastr.min.js']
            ],
        ]
    ],
    'index_perfil' => [
        1 => 'index.php',
        2 => 'index.php?r=registro/create'
    ],
    'bsDependencyEnabled' => false, // this will not load Bootstrap CSS and JS for all Krajee extensions
    '@plantillas' => "@web/plantillas",
    '@documents' => "@web/documents",
    'reporteMensual' => [
        'to' => 'davidfernandoramos010@gmail.com',
        'from' => 'soporte@ipcheck.es',
        'subject_ca' => 'Report mensual de claus no tornades.',
        'subject_es' => 'Reporte mensual de llaves no devueltas.',
        'subject_en' => 'Monthly report of unreturned keys.'
    ],

    'items_menu' => [

    ]

];
