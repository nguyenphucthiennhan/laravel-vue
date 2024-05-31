<template>
    <div class="main-banner">
        <div class="container ">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="caption header-text">
                        <h6>Welcome to NGM</h6>
                        <h2>BEST GAMING SITE EVER!</h2>
                        <p>Nhan was a web developer by profession, and he had a particular fondness for Laravel and
                            Vue.js. He spent his days crafting intricate websites, his fingers dancing over the keyboard
                            as he wove together lines of code like a master weaver at a loom.</p>
                        <div>
                            <form @submit.prevent="search">
                                <input type="text" placeholder="Type Something" v-model="searchKeyword"
                                    @input="search" />
                            </form>
                            <div v-for="item in filteredItems" :key="item.id">
                                {{ item.name }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-2">
                    <div class="right-image">
                        <img src="../../images/logo_4x.jpg" alt="">
                        <span class="price">$22</span>
                        <span class="offer">-40%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            searchKeyword: '',
            items: [],
        };
    },
    computed: {
        filteredItems() {
            if (!this.searchKeyword) return this.items;
            return this.items.filter(item => item.name.includes(this.searchKeyword));
        },
    },
    methods: {
        search() {
            this.$emit('search', this.searchKeyword);
        },
    },
};
</script>
