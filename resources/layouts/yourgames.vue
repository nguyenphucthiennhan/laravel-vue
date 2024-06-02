<template>
    <Header />
    <Banner />
    <div class="container">
        <YourGame />
    </div>
    <Footer />
</template>
<script>
import '../css/styles.css';
import '../css/appgame.css';
import Footer from "../components/user/Footer.vue";
import Header from "../components/user/Header.vue";
import YourGame from "../components/user/yourgame/YourGame.vue";
import Banner from "../components/user/yourgame/Banner.vue";
export default {
    components: {
        Header, Footer, YourGame, Banner
    }
}
</script>