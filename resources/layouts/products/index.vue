<template>

    <TheHeader/>
    <Products/>
        <router-view></router-view>
    </template>
    <script>
    import TheHeader from "../../components/TheHeader.vue";
    import Products from "../../components/admin/products/Products.vue";
    import '../../css/admin-style.css';
    export default {
        components: {
            TheHeader,Products
        }
    }
    </script>