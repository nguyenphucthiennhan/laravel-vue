<template>
<Header/>
<Banner/>
<ItemLiked/>
<Footer/>
</template>
<script>
import Footer from "../components/user/Footer.vue";
import Header from "../components/user/Header.vue";
import ItemLiked from "../components/user/liked/ItemLiked.vue";
import Banner from "../components/user/liked/Banner.vue";




export default {
    components: {
        Header, Footer,ItemLiked,Banner
    }
}
</script>