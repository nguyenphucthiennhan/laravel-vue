<template>
    <div class="login">
        <h2>Sign Up</h2>
        <form @submit.prevent="login">
            <div>
                <label for="username">Username:</label>
                <input class="form-control" placeholder="username" type="text" id="username" v-model="username"
                    required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input class="form-control" placeholder="password" type="password" id="password" v-model="password"
                    required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input @input="setMessage" class="form-control" placeholder="name@example.com" type="email" id="email" v-model="email"
                    required><div class="text-danger" v-if="errorMessage">{{ errorMessage }}</div>
            </div>
            <button  class="btn btn-primary" @click="register" type="submit">Sign up</button>
            <div class="my-3">
                <router-link to="/login" active-class="active">Login</router-link>
            </div>
        </form>
    </div>
    
</template>

<script>
export default {
  data() {
    return {
      username: '',
      password: '',
      email: '',
      errorMessage: ''
    }
  },
  methods: {
    register() {
        if(this.username !='' && this.password !=''&& this.email !=''){
            
            axios.post('http://localhost:8000/api/register', {
              name: this.username,
              password: this.password,
              email: this.email
            })
            .then(response => {
              if (response.data === 0) {
                  this.errorMessage = 'Email đã được đăng ký';
              }
              if(response.data === 1){
                this.$router.push('/login');
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