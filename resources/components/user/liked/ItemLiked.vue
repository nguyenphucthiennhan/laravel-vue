<template>
    <div class="container">
        <h2 class="py-5 text-light">List game liked</h2>
        <table>
            <tbody>
                <tr v-for="product in products" :id="'product' + product.id" >
                    <router-link :to="'/details/' + product.id" active-class="active">
                        <td class="image-item" v-for="image in product.images">
                            <img class="image-contraint" :src="'http://[::1]:5173/resources/images/' + image.name"
                                alt="">
                        </td>
                    </router-link>
                    <td>
                        <h3 class="py-4 name">{{ product.name }}</h3>
                        <h4 class="price text-warning"><em>{{ product.price }} </em>$</h4>
                        <h3 class="text-danger">{{ product.discount }}</h3>
                    </td>
                    <td :id="'this' + product.id">
                        <div class="btn btn-success" @click="addToCart(product.id)">Add to cart</div>
                    </td>
                    <td>
                        <div @click="deleteLike(product.id)" class="btn btn-danger">x</div>
                    </td>
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
            message: null
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
        async addToCart(productId) {
            try {
                let user_id = JSON.parse(localStorage.getItem('id'));
                const response = await axios.post('http://localhost:8000/api/add-to-cart', {
                    user_id: user_id,
                    product_id: productId,
                });
                if (response.data === 0) {
                    this.message = 'This product is already in your cart!';
                    const mess = document.querySelector(`#this${productId}`);
                    mess.innerHTML += `<div class="text-danger">${this.message}</div>`;
                }
                else {
                    this.message = 'Add to cart is success!';
                    const mess = document.querySelector(`#this${productId}`);
                    mess.innerHTML += `<div class="text-success">${this.message}</div>`;
                }
            } catch (error) {
                console.error(error);
            }
        },
        async deleteLike(productId) {
            try {
                let user_id = JSON.parse(localStorage.getItem('id'));
                const response = await axios.post('http://localhost:8000/api/delete-like', {
                    user_id: user_id,
                    product_id: productId,
                });
                const tr = document.querySelector(`#product${productId}`);
                tr.style.transform = 'translateX(-1000px) scale(0.2)';
                tr.style.opacity = '0';
                tr.style.transition = '.5s ease-out';
                 this.getProduct();
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

tr:hover .name {
    color: black;
}

.price {
    text-decoration: line-through;
}

.name {
    color: white;
}
</style>