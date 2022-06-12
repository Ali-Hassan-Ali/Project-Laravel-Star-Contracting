
<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [

        'super_admin' => [
            'roles'        => 'c,r,u,d',
            'admins'       => 'c,r,u,d',
            'users'        => 'c,r,u,d',
            'countrys'     => 'c,r,u,d',
            'citys'        => 'c,r,u,d',
            'types'        => 'c,r,u,d',
            'status'       => 'c,r,u,d',
            'specs'        => 'c,r,u,d',
            'eirs'         => 'c,r,u,d',
            'fuels'        => 'c,r,u,d',
            'spares'       => 'c,r,u,d',
            'equipments'   => 'c,r,u,d',
            'maintenances' => 'c,r,u,d',
            'request_parts'=> 'c,r,u,d',
            'insurances'   => 'c,r,u,d',
            'settings'     => 'c,r,u,d',
            'statistics'   => 'c,r,u,d',
        ],
        'admin' => [],
        'user' => [],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
