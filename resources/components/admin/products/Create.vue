<template>
    <div class="container">
        <h1>Create a product</h1>
        <form @submit.prevent="addProduct" class="form" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="productName" class="form-label">Name</label>
                <input type="text" class="form-control" id="productName" v-model="productName" required>
            </div>
            <div class="mb-3">
                <label for="productPrice" class="form-label">Price</label>
                <input type="text" class="form-control" id="productPrice" v-model="productPrice" required>
            </div>
            <div class="mb-3">
                <label for="productDescription" class="form-label">Description</label>
                <textarea class="form-control" id="productDescription" v-model="productDescription"></textarea>
            </div>
            <div class="mb-3 text-light">
                <label for="productImage" class="form-label">Image</label>
                <input type="file" class="form-control" id="productImage" @change="handleFileChange" multiple>
            </div>
            <div class="form-check text-light" v-for="(category, index) in categories" :key="index">
                <input class="form-check-input" type="checkbox" :value="category.id" :id="'category_' + category.id"
                    v-model="categoriesId">
                <label class="form-check-label" :for="'category_' + category.id">
                    {{ category.name }}
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            categories: [],
            productName: '',
            productPrice: '',
            productDescription: '',
            productImage: null,
            categoriesId: [],
        };
    },
    created() {
        this.fetchCategories();
    },
    methods: {
        async fetchCategories() {
            let url = 'http://localhost:8000/api/get-categories';
            try {
                const response = await axios.get(url);
                this.categories = response.data;
            } catch (error) {
                console.error(error);
            }
        },
        handleFileChange(e) {
            this.productImage = e.target.files;
        },
        async addProduct() {
            let url = 'http://localhost:8000/api/add-product';
            let formData = new FormData();
            formData.append('productName', this.productName);
            formData.append('productPrice', this.productPrice);
            formData.append('productDescription', this.productDescription);
            for (let i = 0; i < this.productImage.length; i++) {
                formData.append('productImage[]', this.productImage.item(i));
            }
            for (let i = 0; i < this.categoriesId.length; i++) {
                formData.append('categoriesId[]', this.categoriesId[i]);
            }
            try {
                const response = await axios.post(url, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });
                console.log(response.data);
                this.$router.push({ name: 'admin-product'});
            } catch (error) {
                console.error(error);
            }
        },
    }
};

</script>
