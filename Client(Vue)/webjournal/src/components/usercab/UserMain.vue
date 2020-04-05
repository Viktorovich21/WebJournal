<template>
  <div class = "userCab" v-if = "$root.username !== 'undefined'">
    <div class="user_info">
      <img :src="userinfo.gender ? require('./../../assets/female.svg') : require('./../../assets/male.svg')">
      <h3>{{ userinfo.name }}</h3>
      <p>{{ userinfo.email }}</p>
      <p>Rating: {{ userinfo.rating }}</p>
    </div>
    <div class="user_actions">
      <ul>
        <li class = "beta"><a href = "/user/article">Create article</a></li>
        <li class = "work"><a href="#"></a></li>
        <li class = "work"><a href="#"></a></li>
      </ul>
    </div>
  </div>
</template>

<script>
import { GetQuery } from '../../host_query'

export default {
  created: async function () {
    const result = await GetQuery(localStorage.hostname, 'user/', { token: this.$cookies.get('user_token') })
    this.userinfo = result.user
  },
  data: function () {
    return {
      userinfo: undefined
    }
  }
}

</script>

<style lang="sass">
  @import "./../../sass/user_styles"
</style>
