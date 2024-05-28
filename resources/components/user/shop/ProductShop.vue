<style scoped>
li.active {
    background-color: #f43444; 
    color: #ffffff;
}
</style>
<template>
    <div class="section trending">
        <div class="container">
            <ul class="trending-filter">
                <li :class="{ active: selectedCategoryId===null}">
                    <div @click="selectCategory(null)"
                    >Show All</div>
                </li>
                <li :class="{ active: selectedCategoryId === category.id }"  v-for="category in categories" @click="selectCategory(category.id)">
                    <div data-filter=".adv">{{ category.name }}</div>
                </li>
            </ul>
            <Product :category-id="selectedCategoryId" />
            <Page/>
        </div>
    </div>
</template>

<script>
import Product from "./ProductItem.vue";
import Page from "./Pagination.vue";
export default {
    components: {
        Product,Page
    },
    data() {
        return {
            categories: [],
            selectedCategoryId: null,
        };
    },
    methods: {
        selectCategory(id) {
            this.selectedCategoryId = id;
        }
    },
    async mounted() {
        try {
            const response = await fetch('http://localhost:8000/api/get-categories');
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            this.categories = await response.json();
        } catch (error) {
            console.error(error);
        }
    }
};
</script>
