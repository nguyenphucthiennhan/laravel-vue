<template>
    <div class="login">
        <h2>Login</h2>
        <form @submit.prevent="login">
            <div>
                <label for="email">Email:</label>
                <input class="form-control" placeholder="name@example.com" type="email" id="email" v-model="email"
                    required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input class="form-control" placeholder="password" type="password" id="password" v-model="password"
                    required>
            </div>
            <button class="btn btn-primary" type="submit">Login</button>
            <div class="my-3">
                <router-link to="/register" active-class="active">Sign Up</router-link>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: '',
            password: ''
        }
    },
    methods: {
        login() {
            console.log(`Đăng nhập với tên đăng nhập: ${this.email} và mật khẩu: ${this.password}`);
        }
    }
}
</script>

<style scoped>
.login {
    position: fixed;
    top: calc(50% - 300px);
    left: calc(50% - 250px);
    border-radius: 20px;
    padding: 100px 100px;
    width: 600px;
    border: 1px solid black;
    box-shadow: 5px 5px 5px #90e4f1;

}

.login label {
    display: block;
    margin-top: 10px;


}

.login button {
    margin-top: 10px;
}
</style>