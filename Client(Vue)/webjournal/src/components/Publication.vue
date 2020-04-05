<template>
  <div class="fullPublication">
    <div class = "titlePub">
      <h2>{{ publication.title }}</h2>
      <p class = "starsPub"> <img :src="require('../assets/star.svg')"> {{ publication.stars }}</p>
    </div>
    <span class = "fulltextPub" v-html = "publication.text"></span>
    <p class = "createPub">{{ publication.created_at }}</p>
    <div class="publicationAuthor" v-on:click="goToUserInfo(authorInfo.id)">
      <img :src="authorInfo.gender ? require('./../assets/female.svg') : require('./../assets/male.svg')">
      <div class = "publicationAuthorInfo">
        <p>{{ authorInfo.name }}</p>
        <p>Rating: {{ authorInfo.rating }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import { GetQuery } from '../host_query'

export default {
  created: async function () {
    let result = await GetQuery(localStorage.hostname, 'publication/' + this.$route.params.id.toString(), [])
    this.publication = result.publication
    result = await GetQuery(localStorage.hostname, 'user/', { id: this.publication.creator_id.toString() })
    this.authorInfo = result.user
  },
  data: function () {
    return {
      publicationId: this.$route.params.id,
      publication: undefined,
      authorInfo: undefined
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
  @import '../sass/publication'
</style>
