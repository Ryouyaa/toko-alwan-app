<?php

return [
    /**
     * Default route to see the UML diagram.
     */
    'route' => '/uml',
    
    /**
     * You can turn on or off the indexing of specific types
     * of classes. By default, LTU processes only controllers 
     * and models.
     */
    'casts'         => false,
    'channels'      => false,
    'commands'      => false,
    'components'    => false,
    'controllers'   => true,
    'events'        => false,
    'exceptions'    => false,
    'jobs'          => false,
    'listeners'     => false,
    'mails'         => false,
    'middlewares'   => false,
    'models'        => true,
    'notifications' => false,
    'observers'     => false,
    'policies'      => false,
    'providers'     => false,
    'requests'      => false,
    'resources'     => false,
    'rules'         => false,

    /**
     * You can define specific nomnoml styling.
     * For more information: https://github.com/skanaar/nomnoml
     */
    'style' => [
    'background' => '#FFFFFF',   // Warna latar belakang (misalnya: '#071013')
    'stroke'     => '#000000',   // Warna garis (misalnya: '#EBEBEB')
    'arrowSize'  => 1,           // Ukuran panah (misalnya: 1)
    'bendSize'   => 0.3,         // Ukuran lengkungan (misalnya: 0.3)
    'direction'  => 'down',      // Arah diagram (misalnya: 'down')
    'gutter'     => 5,           // Jarak antara elemen-elemen (misalnya: 5)
    'edgeMargin' => 0,           // Jarak antara garis tepi dan elemen (misalnya: 0)
    'gravity'    => 1,           // Gravitasi elemen (misalnya: 1)
    'edges'      => 'rounded',   // Bentuk ujung garis (misalnya: 'rounded')
    'fill'       => '#FFFFFF',   // Warna isi elemen (misalnya: '#3A6EA5')
    'fillArrows' => false,       // Mengisi panah dengan warna yang sama (misalnya: false)
    'font'       => 'Calibri',   // Jenis font teks (misalnya: 'Calibri')
    'fontSize'   => 12,          // Ukuran font teks (misalnya: 12)
    'leading'    => 1.25,        // Spasi antara baris teks (misalnya: 1.25)
    'lineWidth'  => 3,           // Ketebalan garis (misalnya: 3)
    'padding'    => 8,           // Ruang kosong dalam elemen (misalnya: 8)
    'spacing'    => 40,          // Jarak antara elemen dan teksnya (misalnya: 40)
    'title'      => 'Filename',  // Judul diagram (misalnya: 'Filename')
    'zoom'       => 1,           // Perbesaran diagram (misalnya: 1)
    'acyclicer'  => 'greedy',    // Algoritma penghilangan siklus (misalnya: 'greedy')
    'ranker'     => 'network-simplex' // Algoritma pengaturan posisi elemen (misalnya: 'longest-path')
    ],

    // 'style' => [
    //     'background' => '#071013',
    //     'stroke'     => '#EBEBEB',
    //     'arrowSize'  => 1,
    //     'bendSize'   => 0.3,
    //     'direction'  => 'down',
    //     'gutter'     => 5,
    //     'edgeMargin' => 0,
    //     'gravity'    => 1,
    //     'edges'      => 'rounded',
    //     'fill'       => '#3A6EA5',
    //     'fillArrows' => false,
    //     'font'       => 'Calibri',
    //     'fontSize'   => 12,
    //     'leading'    => 1.25,
    //     'lineWidth'  => 3,
    //     'padding'    => 8,
    //     'spacing'    => 40,
    //     'title'      => 'Filename',
    //     'zoom'       => 1,
    //     'acyclicer'  => 'greedy',
    //     'ranker'     => 'longest-path'
    // ],

    /**
     * Specific files can be excluded if need be.
     * By default, all default Laravel classes are ignored.
     */
    'excludeFiles' => [
        'Http/Kernel.php',
        'Console/Kernel.php',
        'Exceptions/Handler.php',
        'Http/Controllers/Controller.php',
        'Http/Middleware/Authenticate.php',
        'Http/Middleware/EncryptCookies.php',
        'Http/Middleware/PreventRequestsDuringMaintenance.php',
        'Http/Middleware/RedirectIfAuthenticated.php',
        'Http/Middleware/TrimStrings.php',
        'Http/Middleware/TrustHosts.php',
        'Http/Middleware/TrustProxies.php',
        'Http/Middleware/VerifyCsrfToken.php',
        'Providers/AppServiceProvider.php',
        'Providers/AuthServiceProvider.php',
        'Providers/BroadcastServiceProvider.php',
        'Providers/EventServiceProvider.php',
        'Providers/RouteServiceProvider.php',
    ],

    /**
     * In case you changed any of the default directories
     * for different classes, please amend below.
     */
    'directories' => [
        'casts'         => 'Casts/',
        'channels'      => 'Broadcasting/',
        'commands'      => 'Console/Commands/',
        'components'    => 'View/Components/',
        'controllers'   => 'Http/Controllers/',
        'events'        => 'Events/',
        'exceptions'    => 'Exceptions/',
        'jobs'          => 'Jobs/',
        'listeners'     => 'Listeners/',
        'mails'         => 'Mail/',
        'middlewares'   => 'Http/Middleware/',
        'models'        => 'Models/',
        'notifications' => 'Notifications/',
        'observers'     => 'Observers/',
        'policies'      => 'Policies/',
        'providers'     => 'Providers/',
        'requests'      => 'Http/Requests/',
        'resources'     => 'Http/Resources/',
        'rules'         => 'Rules/',
    ],
];