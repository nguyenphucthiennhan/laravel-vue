const home = [
    {
        path: "/",
        component: () => import("../layouts/user.vue"),
        children: [
            {
                path: "home",
                name: "user-home",
                component: () => import("../pages/user/Home.vue"),
            },
        ],
    },
    {
        path: "/",
        component: () => import("../layouts/shop.vue"),
        children: [
            {
                path: "shop",
                name: "user-shop",
                component: () => import("../pages/user/Shop.vue"),
            },
        ],
    },
    {
        path: "/",
        component: () => import("../layouts/details.vue"),
        children: [
            {
                path: 'details/:id',
                name: "product-detail",
                component: () => import("../pages/user/Details.vue"),
            },
        ],
    },
    {
        path: "/",
        component: () => import("../layouts/login.vue"),
        children: [
            {
                path: 'login',
                name: "login",
                component: () => import("../pages/user/Auth.vue"),
            },
        ],
    },
    {
        path: "/",
        component: () => import("../layouts/register.vue"),
        children: [
            {
                path: 'register',
                name: "register",
                component: () => import("../pages/user/Auth.vue"),
            },
        ],
    },
    {
        path: "/",
        component: () => import("../layouts/liked.vue"),
        children: [
            {
                path: 'liked-game',
                name: "liked-game",
                component: () => import("../pages/user/Liked.vue"),
            },
        ],
    },
];
export default home;
