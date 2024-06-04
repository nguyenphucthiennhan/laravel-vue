const admin=[
    {
        path:"/admin",
        component:() => import("../layouts/admin.vue"),
        children: [
            {
                path: "users",
                name: "admin-user",
                component: () => import("../pages/admin/users/index.vue"),
            }
        ]

},
    {
        path:"/admin",
        component:() => import("../layouts/products/index.vue"),
        children: [
            {
                path: "products",
                name: "admin-product",
                component: () => import("../pages/admin/products/index.vue"),
            }
        ]

},
    {
        path:"/admin",
        component:() => import("../layouts/products/create.vue"),
        children: [
            {
                path: "create-product",
                name: "create-product",
                component: () => import("../pages/admin/products/index.vue"),
            }
        ]

}
  
    
];
export default admin;