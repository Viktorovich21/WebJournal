<template>
  <div>
    <form class="loginForm" @submit.prevent='register' v-if = "$root.username === 'undefined'">
      <h1>Registration</h1>
      <input type="text" v-model = 'name' name = "Name" placeholder="Login" required>
      <input type="email" v-model = 'email' name = "email" placeholder="Email" required>
      <select v-model = 'gender'>
        <option disabled>Choice gender</option>
        <option value = '0'>Male</option>
        <option value = '1'>Female</option>
      </select>
      <input type="password" v-model = 'password' name = "password" placeholder="Password" required>
      <input type="password" v-model = 'confirm_password' name = "confirm_password" placeholder="Confirmation password" required>
      <button type="submit">Sign Up</button>
    </form>
  </div>
</template>

<script>
import { PostQuery, GetQuery } from '../host_query'

export default {
  beforeCreate () {
    this.userIsLogin = localStorage.token !== undefined
  },
  data: function () {
    return {
      name: '',
      email: '',
      password: '',
      gender: '',
      confirm_password: '',
      userIsLogin: false
    }
  },
  methods: {
    register: async function () {
      const queryArray = {
        name: this.name,
        email: this.email,
        password: this.password,
        gender: this.gender,
        confirm_password: this.confirm_password
      }
      let result = await PostQuery(localStorage.hostname, 'register', queryArray)
      if (result.success) {
        localStorage.token = result.success.token
        this.userIsLogin = true
        result = await GetQuery(localStorage.hostname, 'user_info/' + localStorage.token, [])
        console.log(result)
        window.location.replace('/')
      }
    }
  }
}

</script>

<style lang="sass">
  @import "../sass/forms"
</style>
