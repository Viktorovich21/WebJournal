<template>
  <div class = "navigation">
    <li class="menuItem"><a href="/">Index</a></li>
    <li class="menuItem"><a href="/">Papers</a></li>
    <li class="menuItem"><a href="/users">Authors</a></li>

    <div class="user_nav">
      <li class="userInformation">
        <a href="/user/home" v-if="$root.username !== 'undefined'">{{ $root.username }}</a>
        <a href="/login" v-if="!($root.username !== 'undefined')">Log In</a>
      </li>
      <li class="userInformation">
        <a v-on:click="logout" v-if="$root.username !== 'undefined'">Log Out</a>
        <a href="/registration" v-if="!($root.username !== 'undefined')">Registration</a>
      </li>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    logout: function () {
      if (this.$cookies.get('user_token') !== 'undefined') {
        this.$cookies.set('user_token', undefined)
        this.$cookies.set('username', undefined)
        this.userIsLogin = false
        this.$root.username = undefined
        window.location.replace('/')
      }
    }
  }
}
</script>

<style lang="sass">
  @import "../sass/top_styles"
</style>
