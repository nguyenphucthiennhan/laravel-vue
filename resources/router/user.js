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
];
export default home;
