<template>
    <div class="container">
        <h2 class="py-5 text-light">Your Cart</h2>
        <table>
            <tbody>
                <tr v-for="product in products" :id="'id' + product.id">
                    <router-link :to="'/details/' + product.id" active-class="active">
                        <td class="image-item" v-for="image in product.images">
                            <img class="image-contraint" :src="'http://[::1]:5173/resources/images/' + image.name"
                                alt="">
                        </td>
                    </router-link>
                    <td>
                        <h3 class="py-4 text-light">{{ product.name }}</h3>
                        <h4 class="price text-warning"><em>{{ product.price }} </em>$</h4>
                        <h3 class="text-danger">{{ product.discount }}</h3>
                    </td>
                    <td>
                        <div class="btn btn-danger" @click="destroye(product.id)">x</div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="btn btn-info p-2 my-5 text-light fw-bold" @click="payForAll">Pay For All </div>
        <h3 class="text-info">Total: {{ total }} $</h3>
    </div>
</template>

<script>
export default {
    data() {
        return {
            products: [],
            total: 0
        };
    },
    created() {
        this.getProduct();
    },
    methods: {
        async getProduct() {
            try {
                let id = JSON.parse(localStorage.getItem('id'));
                const response = await axios.get(`http://localhost:8000/api/cart/${id}`);
                this.products = response.data;
                this.total = 0;
                this.products.forEach(product => {
                    this.total += parseFloat(product.discount);
                });
            } catch (error) {
                console.error(error);
            }
        },
        async destroye(productId) {
            try {
                let id = JSON.parse(localStorage.getItem('id'));
                const response = await axios.post(`http://localhost:8000/api/delete-cart`, {
                    user_id: id,
                    product_id: productId
                });
                const tr = document.querySelector(`#id${productId}`);
                tr.style.transform = 'scale(5)';
                tr.style.opacity = '0';
                tr.style.transition = '1s ease-out';
                this.getProduct();
            } catch (error) {
                console.error(error);
            }
        },
        payForAll() {
            localStorage.removeItem('productCart');
            localStorage.removeItem('amount');

            localStorage.setItem('productCart', JSON.stringify(this.products));
            localStorage.setItem('amount', JSON.stringify(this.total));
            this.$router.push('/payment');
        }

    }
}
</script>

<style scoped>
table {
    width: 100%;
    border-collapse: collapse;
}

th,
td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

tr {
    transition: .3s cubic-bezier(0.6, -0.28, 0.735, 0.045);
}

tr:hover {
    background: linear-gradient(to right, #ff0000, #ffdd00);
    transform: scale(1.1);
    box-shadow: 0 0 15px #ddff00;
}

.price {
    text-decoration: line-through;
}
</style>
