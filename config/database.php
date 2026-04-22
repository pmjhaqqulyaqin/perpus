<?php

return [
    /**
     * Default database node profile
     */
    'default_profile' => 'SLiMS',

    /**
     * SLiMS as Service, One SLiMS for many library
     * ----------------------------------------------------
     * 
     * Switching database node access based on rule,
     * such as domain, ip, port etc
     * 
     * How to :
     * 1. make file with name database_proxy.php in config/
     * 2. make your own rule in that file.
     * 3. change this value to true
     */
    'proxy' => false,

    /**
     * Nodes profile
     */
    'nodes' => [
        'SLiMS' => [
            'host' => '127.0.0.1',
            'database' => 'mandalo1_slim423',
            'port' => 3306,
            'username' => 'mandalo1_slim423',
            'password' => 'SG7(.pf288',
            'options' => [
                'storage_engine' => 'MyISAM'
            ]
        ]
    ]
];