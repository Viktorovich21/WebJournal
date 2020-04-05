<template>
  <div>
    <div class="userModel">
      <img :src="userInfo.gender ? require('./../../assets/female.svg') : require('./../../assets/male.svg')">
      <h3>{{ userInfo.name }}</h3>
      <p>Rating: {{ userInfo.rating }}</p>
    </div>
  </div>
</template>

<script>
import { GetQuery } from '../../host_query'

export default {
  created: async function () {
    const response = await GetQuery(localStorage.hostname, 'user/', { id: this.$route.params.id.toString() })
    this.userInfo = response.user
  },
  data: function () {
    return {
      userInfo: undefined
    }
  }
}
</script>

<style lang="sass">
  @import "./../../sass/user_styles"
</style>
