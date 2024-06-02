<template>
    <div class="container">
        <h1 class="text-light">Product Management</h1>
        <a href="#" class="btn btn-primary">Create</a>
        <table class="table">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Price</td>  
                    <td>Discount</td>  
                    <td>Image</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products">
                    <td>{{ product.id }}</td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.price }}</td>
                    <td>{{ product.discount }}</td>
                    <td  v-for="image in product.images">
                        <img :src="'http://[::1]:5173/resources/images/' + image.name" alt="" style="width: 100px;"></td>
                    <td>
                        <a href="#" class="btn btn-warning">Edit</a>
                        <form action="#" method="post">
                            <button type="submit" class="btn btn-danger" name="productId" value="#">Delete</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="btn btn-primary">load more</div>
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
    this.fetchProducts();
  },
  methods: {
    async fetchProducts() {
      let url = 'http://localhost:8000/api/get-all-products';
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
  },
};
</script>