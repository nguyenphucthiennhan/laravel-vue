<template>
    <div class="container py-5">
        <div class="my-3" v-for="(product, index) in products" :key="index">
            <h2 class="text-secondary">{{ product.name }}</h2>
            <p class="text-secondary fs-3">Price: {{ product.discount }} $</p>
            <hr>
        </div>
        <h3 class="text-info">Total: {{ total }} $</h3>
        <div class="btn btn-primary fs-3 fw-bold mt-5" @click="pay">Pay</div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            products: [],
            total: 0
        }
    },
    created() {
        this.products = JSON.parse(localStorage.getItem('productCart'));
        this.total = JSON.parse(localStorage.getItem('amount'));
    },
    methods: {
        async pay() {
            try {
                let user_id = JSON.parse(localStorage.getItem('id'));
                const response = await axios.post('http://localhost:8000/api/pay', {
                    user_id: user_id,
                    products: this.products,
                });
                localStorage.removeItem('productCart');
                localStorage.removeItem('amount');
                this.$router.push({ name: 'YourGame' });
            } catch (error) {
                console.error(error);
            }
        },
    },
}
</script>