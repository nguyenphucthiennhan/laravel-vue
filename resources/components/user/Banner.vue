<template>
    <div class="main-banner">
        <div class="container ">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="caption header-text">
                        <h6>Welcome to lugx</h6>
                        <h2>BEST GAMING SITE EVER!</h2>
                        <p>LUGX Gaming is free Bootstrap 5 HTML CSS website template for your gaming websites. You
                            can download and use this layout for commercial purposes. Please tell your friends about
                            TemplateMo.</p>
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
                        <img src="../../images/banner-image.jpg" alt="">
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
