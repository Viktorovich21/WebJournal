<template>
  <div>
    <form class = "loginForm" v-if = '!this.userIsLogin' @submit.prevent="login">
      <h1>Signed In</h1>
      <input v-model="email" type="email" placeholder="Email" required>
      <input v-model="password" type="password" placeholder="Password" required>
      <button type = "submit">Log In</button>
    </form>
  </div>
</template>

<script>
import { PostQuery, GetQuery } from '../host_query'

export default {
  data: function () {
    return {
      email: '',
      password: '',
      userIsLogin: this.$cookies.get('user_token') !== 'undefined'
    }
  },
  methods: {
    login: async function () {
      let result = await PostQuery(localStorage.hostname, 'login', { email: this.email, password: this.password })
      if (result.success.token) {
        const token = result.success.token
        this.$cookies.set('user_token', token)
        this.userIsLogin = true
        result = await GetQuery(localStorage.hostname, 'user_info/' + token, { })
        this.$root.username = result.user
        this.$cookies.set('username', result.user)
        window.location.replace('/')
      }
    }
  }
}
</script>

<style lang="sass">
  @import "../sass/forms"
</style>
