    <template>
        <div class="container py-5">
            <h1 class="py-5">Your Search Here</h1>
            <div class="row trending-box">
                <div class="col-lg-3 col-md-6 align-self-center mb-30 trending-items col-md-6 adv"
                    v-for="product in filteredProducts" :key="product.id">
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
                            <span class="category">{{ product.category }}</span>
                            <h4>{{ product.name }}</h4>
                            <a href="product-details.html"><i class="fa fa-shopping-bag"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
<script>
export default {
    props: ['searchKeyword'],
    data() {
        return {
            products: [],
        };
    },
    computed: {
        filteredProducts() {
            if (!this.searchKeyword) return this.products;
            return this.products.filter(product => product.name.includes(this.searchKeyword));
        },
    },
    methods: {
        async fetchProducts() {
            let url = '';
            if (this.searchKeyword) {
                url = `http://localhost:8000/api/search/${this.searchKeyword}`;
                try {
                    const response = await fetch(url);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    this.products = await response.json();
                } catch (error) {
                    console.error(error);
                }
            }
        },
    },
    watch: {
        searchKeyword: {
            immediate: true,
            handler() {
                this.fetchProducts();
            },
        },
    },
};
</script>