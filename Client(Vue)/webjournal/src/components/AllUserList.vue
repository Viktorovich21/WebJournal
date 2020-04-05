<template>
  <div>
    <div class="userMainInfo" v-for = "user in usersInfo" v-bind:key="user.id" v-on:click="goToUserInfo(user.id)">
      <img :src="user.gender ? require('./../assets/female.svg') : require('./../assets/male.svg')">
      <div class = "userInfo">
        <p>{{ user.name }}</p>
        <p>Rating: {{ user.rating }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import { GetQuery } from '../host_query'

export default {
  created: async function () {
    const response = await GetQuery(localStorage.hostname, 'users', {})
    this.usersInfo = response.users
  },
  data: function () {
    return {
      usersInfo: undefined
    }
  },
  methods: {
    goToUserInfo: function (id) {
      window.location.replace('/user/' + id)
    }
  }
}
</script>

<style lang="sass">
  @import "../sass/publication"
</style>
