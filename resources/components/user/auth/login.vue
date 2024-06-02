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
                <input @input="setMessage" class="form-control" placeholder="password" type="password" id="password" v-model="password"
                    required>
            </div>
            <button @onclick="login" class="btn btn-primary" type="submit">Login</button>
            <div class="my-3">
                <router-link to="/register" active-class="active">Sign Up</router-link>
                <div class="text-danger" v-if="errorMessage">{{ errorMessage }}</div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: '',
            password: '',
            errorMessage:''
        }
    },
    methods: {
        login() {
            if(this.password !=''&& this.email !=''){
            
            axios.post('http://localhost:8000/api/login', {
              password: this.password,
              email: this.email
            })
            .then(response => {
              if (response.data === 0) {
                  this.errorMessage = 'Sai Mật Khẩu Hoặc Sai Email!!!';
              }
              else{
                localStorage.setItem('id', JSON.stringify(response.data.id));
                localStorage.setItem('name', JSON.stringify(response.data.name));
                this.$router.push('/home');
              }
            })
            .catch(error => {
              console.error(error);
            });
        }
        },
        setMessage(){
        this.errorMessage = '';
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