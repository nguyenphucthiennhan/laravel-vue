<template>
    <Header/>
    <Banner/>
    <CartItem/>
    <Footer/>
    </template>
    <script>
    import Footer from "../components/user/Footer.vue";
    import Header from "../components/user/Header.vue";
    import CartItem from "../components/user/cart/CartItem.vue";
    import Banner from "../components/user/cart/Banner.vue";
    
    
    
    
    export default {
        components: {
            Header, Footer,CartItem,Banner
        }
    }
    </script>