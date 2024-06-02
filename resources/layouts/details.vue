<template>
        <router-view></router-view>
<Header/>
<HeaderDetails/>
<DetailsContent/>
<RelatedItem/>
<Footer/>
</template>
<script>
    import Footer from "../components/user/Footer.vue";
    import Header from "../components/user/Header.vue";
   import HeaderDetails from "../components/user/details/HeaderDetails.vue";
  import DetailsContent from "../components/user/details/DetailsContent.vue";
  import RelatedItem from "../components/user/details/RelatedItem.vue";
  import '../css/styles.css';
  import '../css/appgame.css';
 
    export default {
        components: {
            Header,Footer,HeaderDetails,DetailsContent,RelatedItem
        }
    }
</script>