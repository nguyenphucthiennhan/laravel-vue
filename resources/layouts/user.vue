<template>
    <router-view></router-view>
<Header/>
<Banner @search="updateSearchKeyword"/>
<Item/>
<SearchItem :search-keyword="searchKeyword"/>
<TrendingItem/>
<MostItem/>
<Category/>
<Cta/>
<Footer/>
    
</template>
<script>
import '../css/styles.css';
import '../css/appgame.css';
import Header from "../components/user/Header.vue";
import Footer from "../components/user/Footer.vue";
import Item from "../components/user/Item.vue";
import TrendingItem from "../components/user/TrendingItem.vue";
import MostItem from "../components/user/MostItem.vue";
import Category from "../components/user/Category.vue";
import Cta from "../components/user/Cta.vue";
import SearchItem from "../components/user/SearchItem.vue";
import Banner from "../components/user/Banner.vue";

export default {
    components: {
        Header,Footer,Item,TrendingItem,MostItem,Category,Cta,Banner,SearchItem
    },
    data() {
        return {
            searchKeyword: '',
        };
    },
    methods: {
        updateSearchKeyword(keyword) {
            this.searchKeyword = keyword;
        }
    }
}
</script>