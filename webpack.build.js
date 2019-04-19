exports.build = {
    shell : [
        'php artisan lang:js public/modules/architect/js/lang.dist.js -s Modules/Architect/Resources/lang'
    ],

    copy: [
        /*
         *
         * EXEMPLE :
         *
         *
        {
            from: 'Modules/RRHH/Resources/assets/js/admin/',
            to: './modules/rrhh/js/admin/',
            toType: 'dir'
        },
        {
            from: 'Modules/RRHH/Resources/assets/js/libs/',
            to: './modules/rrhh/js/libs/',
            toType: 'dir'
        },
        */
    ],

    react : {
        src : 'Modules/Architect/Resources/assets/js/app.js',
        path : 'modules/architect/js'
    },

    sass : {
        src : 'Modules/Architect/Resources/assets/sass/architect/app.scss',
        path : 'modules/architect/css'
    },

    scripts: {
        src : [
            'Modules/Architect/Resources/assets/js/architect/architect.js',
            'Modules/Architect/Resources/assets/js/architect/architect.dialog.js',
            'Modules/Architect/Resources/assets/js/architect/architect.medias.js',
            'Modules/Architect/Resources/assets/js/architect/architect.contents.js',
            'Modules/Architect/Resources/assets/js/architect/architect.tags.js',
            'Modules/Architect/Resources/assets/js/architect/architect.users.js',
            'Modules/Architect/Resources/assets/js/architect/architect.pageLayouts.js',
            'Modules/Architect/Resources/assets/js/architect/architect.menu.js',
            'Modules/Architect/Resources/assets/js/architect/architect.languages.js',
            'Modules/Architect/Resources/assets/js/architect/architect.translations.js'
        ],
        path : 'public/modules/architect/js/architect.js'
    }
};