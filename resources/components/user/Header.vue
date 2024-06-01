<template>
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">
                            <img src="../../images/lg2.jpg" alt="" style="width: 58px;">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><router-link to="/home" active-class="active">Home</router-link></li>
                            <li><router-link to="/shop" active-class="active">Shop</router-link></li>
                            <li><router-link to="/liked-game" active-class="active">Liked list</router-link></li>
                            <li><router-link to="/cart" active-class="active">Cart</router-link></li>
                            <li class="text-light">Wellcome {{ name }}</li>
                            <li v-if="name">
                                <router-link to="your-game" active-class="active">Your game</router-link>
                            </li>
                            <li v-if="name">
                                <div @click="logout" class="btn btn-danger">Logout</div>
                            </li>
                            <li v-else>
                                <router-link to="/login" active-class="active">Login</router-link>
                            </li>

                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->
</template>
<script>
export default {
    data() {
        return {
            name: ''
        }
    },
    methods: {
        getNameFromLocalStorage() {
            this.name = JSON.parse(localStorage.getItem('name'));
        }
        ,
        logout() {
            localStorage.clear();
            this.$router.push('/login');
        }
    },
    created() {
        this.getNameFromLocalStorage();
    }
}
</script>