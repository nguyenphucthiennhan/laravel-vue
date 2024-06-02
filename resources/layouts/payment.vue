<template>
    <Header/>
    <Banner/>
    <Payment/>
    <Footer/>
    </template>
    <script>
    import '../css/styles.css';
import '../css/appgame.css';
    import Footer from "../components/user/Footer.vue";
    import Header from "../components/user/Header.vue";
    import Payment from "../components/user/payment/Payment.vue";
    import Banner from "../components/user/payment/Banner.vue";
    export default {
        components: {
            Header, Footer,Payment,Banner
        }
    }
    </script>