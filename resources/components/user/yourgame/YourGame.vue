<template>
    <h2 class="text-light my-5"></h2>
    <div class="row trending-box py-5">
      <div class="col-lg-3 col-md-6 align-self-center mb-30 trending-items col-md-6 adv" v-for="product in products"
        :key="product.id">
        <div class="item">
          <div class="thumb">
            <div v-for="image in product.images" class="image-contraint">
              <router-link :to="'/details/' + product.id" active-class="active">
              <img :src="'http://[::1]:5173/resources/images/' + image.name" alt="">
            </router-link>
            </div>
            <span class="price"><em>{{ product.price }}</em>{{ product.discount }}</span>
          </div>
          <div class="down-content">
            <span class="category">{{ product.category}}</span>
            <h4>{{ product.name }}</h4>
           
            <a href="product-details.html"><i class="fa fa-shopping-bag"></i></a>
          </div>
        </div>
      </div>
    </div>
  </template>
  <script>
  export default {
    props: ['categoryId'],
    data() {
      return {
        products: [],
      };
    },
    created() {
        this.fetchProducts();
    },
    methods: {
        async fetchProducts() {
        let user_id = JSON.parse(localStorage.getItem('id'));
        let url = 'http://localhost:8000/api/get-your-games/'+ user_id;
        try {
          const response = await fetch(url);
          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
          }
          this.products = await response.json();
        } catch (error) {
          console.error(error);
        }
      },
    }
  };
  </script>