<template>
    <router-view></router-view>
    <Header/>
    <ShopHeader/>
    <ProductShop/>
    <Footer/>
        
    </template>
    <script>
        import Header from "../components/user/Header.vue";
    import Footer from "../components/user/Footer.vue";
   import ShopHeader from "../components/user/shop/ShopHeader.vue";
  import ProductShop from "../components/user/shop/ProductShop.vue";
 
    export default {
        components: {
           ShopHeader,Footer,ProductShop,Header
        }
    }
    </script>