<template>
  <div class="container mt-5 col-3">
    <div class="row">
      <h4>Enter your email and password</h4>
      <form @submit.prevent="loginUser" class="col-12">
        <div class="form-group mt-3">
          <input type="email" class="form-control" id="email" v-model="email" placeholder="Enter email" required @input="clearErrors">
          <small class="text-danger" v-if="errors">{{ errors }}</small>
        </div>
        <div class="form-group mt-3">
          <input type="password" class="form-control" id="password" v-model="password" placeholder="Password" required @input="clearErrors">

        </div>
        <button type="submit" class="btn btn-primary mt-3 w-100">Login</button>
      </form>
    </div>
    <div class="row">
      <div class="col-12">
          <p class="mt-3 text-left">Don't have an account? <router-link to="/register">Register here!</router-link></p>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      password: '',
      errors: null
    };
  },
  methods: {
    async loginUser() {
      try {
        // Call the login API endpoint using Axios
        // the /login is an API route that define in the backend using Laravel
        const response = await axios.post(this.$root.$data.apiUrl + '/login', {
          email: this.email,
          password: this.password
        });
        if (response.status === 201) {
          // Successful login, handle token storage and redirection
          // the token will be stored in the local storage to guard the routes
          // this will prevent to access the route without login
          localStorage.setItem('token', response.data.token);
          this.$router.push('/home');
        }
      } catch (error) {
        // Handle login error, show error message to the user
        // the errors will be displayed in the template using v-if directives
        this.errors = error.response.data.message;
      }
    },
    clearErrors() {
      // Clear error message for the specified field
      // this method is called when the user types in the input field triggering the event handler 
      this.errors = null;
    }

  }
};
</script>
