Nova.booting((Vue, router, store) => {
    router.addRoutes([
        {
            name: 'nova-laravel-api-logger',
            path: '/nova-laravel-api-logger',
            component: require('./components/Index'),
        },
        {
            name: 'nova-laravel-api-logger-log',
            path: '/nova-laravel-api-logger/:id',
            component: require('./components/Log'),
        },
    ])
})
