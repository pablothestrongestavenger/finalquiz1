<template>
  <!-- the router view is where all the routes are rendered -->
  <router-view/>
</template>

<script>
export default {
  name: 'App',
  data() {
    return {
      // assign in root component to easily change the api url in production environment
      // it can be access using this.$root.$data.apiUrl in any component
      apiUrl : 'http://127.0.0.1:8000/api'      
    }
  }
}
</script>

<style>
</style>
