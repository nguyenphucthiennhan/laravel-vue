<template>
  <div class="section trending">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="section-heading">
            <h6>Trending</h6>
            <h2 class="text-light">Trending Games</h2>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="main-button">
            <a href="shop.html">View All</a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6" v-for="product in products">
          <div class="item">
            <div class="thumb image-contraint" v-for="image in product.images">
              <router-link :to="'/details/' + product.id" active-class="active">
                <img class="img-fluid" :src="'http://[::1]:5173/resources/images/' + image.name" alt="">
              </router-link>
              <span class="price"><em>{{ product.price }}</em>{{ product.discount }}</span>
            </div>
            <div class="down-content">
              <span class="category">Quantity sold: {{ product.frequency }}</span>
              <h4>{{ product.name }}</h4>
              <a href="product-details.html"><i class="fa fa-shopping-bag"></i></a>
            </div>
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
      products: [],
    };
  },
  created() {
    this.getTrengding();
  },
  methods: {
    async getTrengding() {
      try {
        const response = await axios.get('http://localhost:8000/api/get-trending-games');
        this.products = response.data;
      } catch (error) {
        console.error(error);
      }
    },
  }
};
</script>