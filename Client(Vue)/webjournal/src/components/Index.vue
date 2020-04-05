<template>
  <ul class = "publicationList">
    <li class = "publication" @mouseover="isPublHover(publication.id)" @mouseleave="isPublLeave" v-on:click="goToFulltext(publication.id)" v-for = "publication in publications" v-bind:key="publication.id">
      <div class = "simple" v-if="hoveredId != publication.id">
        <h3> {{ publication.title }} </h3>
      </div>
      <div class = "hovered" v-if="hoveredId == publication.id">
        <span > {{ publication.description }} </span>
      </div>
    </li>
  </ul>

</template>

<script>
import { GetQuery } from '../host_query'

export default {
  created: async function () {
    const result = await GetQuery(localStorage.hostname, 'publication', [])
    this.publications = result.publications
  },
  data: function () {
    return {
      publications: [],
      hoveredId: -1
    }
  },
  methods: {
    isPublHover: function (publicationId) {
      this.hoveredId = publicationId
    },
    isPublLeave: function () {
      this.hoveredId = -1
    },
    goToFulltext: function (paperId) {
      window.location.replace('/publication/' + paperId.toString())
    }
  }
}

</script>

<style lang="sass">
  @import "../sass/publication"
</style>
