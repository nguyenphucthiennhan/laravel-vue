<template>
    <div class="container">
        <h1 class="text-light">Product Management</h1>
        <router-link to="/admin/create-product" active-class="active">Create </router-link>
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
                    <td  >
                      <div class="img" v-for="image in product.images">

                        <img :src="'http://[::1]:5173/resources/images/' + image.name" alt="" style="width: 100px;">
                      </div>
                    </td>
                    <td>
                        <a href="#" class="btn btn-warning">Edit</a>
                            <button @click="deleteProduct(product.id)" type="submit" class="btn btn-danger" name="productId">Delete</button>
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
    async deleteProduct(id) {
            let url = `http://localhost:8000/api/delete-product/${id}`;
            if (confirm('Bạn có muốn xóa sản phẩm này không?')) {
            try {
                const response = await axios.delete(url);
                this.products = this.products.filter(product => product.id !== id);
                console.log(response.data);
            } catch (error) {
                console.error(error);
            }
          }
        }
  },
};
</script>