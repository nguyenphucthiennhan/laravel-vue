<template>
    <div class="container">
        <h2 class="py-5">List game liked</h2>
        <table>
            <tbody>
                <tr v-for="product in products">
                    <router-link :to="'/details/' + product.id" active-class="active">
                        <td class="image-item" v-for="image in product.images">
                            <img class="image-contraint" :src="'http://[::1]:5173/resources/images/' + image.name" alt="">
                        </td>
                    </router-link>
                    <td>
                        <h3 class="py-4">{{ product.name }}</h3>
                        <h4 class="price text-warning"><em>{{product.price }} </em>$</h4>
                        <h3 class="text-danger">{{product.discount}}</h3>
                    </td>
                    <td><div class="btn btn-success">Add to cart</div></td>
                    <td><div class="btn btn-danger">x</div></td>
                </tr>
            </tbody>
        </table>

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
        this.getProduct();
    },
    methods: {
        async getProduct() {
            try {
                let id = JSON.parse(localStorage.getItem('id'));
                const response = await axios.get(`http://localhost:8000/api/liked/${id}`);
                this.products = response.data;
            } catch (error) {
                console.error(error);
            }
        },


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
    transition: .4s cubic-bezier(0.6, -0.28, 0.735, 0.045);
}

tr:hover {
    background-color: #00aeff;
    transform: scale(1.1);
    box-shadow: 0 0 15px #00fff2;
}

.price {
    text-decoration: line-through;
}
</style>