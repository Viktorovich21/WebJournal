<template>
  <div v-if="$root.username !== 'undefined'">
    <form @submit.prevent="createArticle" class = "newArticleForm">
      <input type="text" v-model = "articleTitle" placeholder="Article title" required>
      <input type="text" v-model = "articleDescription" multiline placeholder="Article description" required>
      <div class = "textStyleBar">
        <li v-on:click="toBoldText"><b>B</b></li>
        <li v-on:click="toItalicText"><i>I</i></li>
        <li v-on:click="toInsertText"><ins>A</ins></li>
        <li v-on:click="insertImg">Image</li>
        <li v-on:click="toQuoteText">Quote</li>
        <li v-on:click="toCodeText">Code</li>
      </div>
      <textarea v-model = "articleText" id = "textEl" style="resize: none" required></textarea>
      <button type="submit">Create</button>
      <span v-if = "articleText !== ''" class = "articlePreview" v-html = "articleText"></span>
    </form>
    <div id = "imageSetup" v-if = "isImageSetupShow">
      <input type="text" v-model = "userImage.url" placeholder="Image url">
      <div id = "imageSize">
        <input type="text" placeholder="width" v-model = "userImage.width">
        x
        <input type="text" placeholder="height" v-model = "userImage.height">
      </div>
      <button v-on:click="addImageToText">Ok</button>
    </div>
  </div>
</template>

<script>
import { PostQuery } from '../../host_query'

export default {
  data: function () {
    return {
      articleTitle: '',
      articleDescription: '',
      articleText: '',
      isImageSetupShow: false,
      userImage: {
        url: '',
        width: 0,
        height: 0
      }
    }
  },
  methods: {
    createArticle: async function () {
      const queryArr = {
        title: this.articleTitle,
        description: this.articleDescription,
        text: this.articleText,
        token: this.$cookies.get('user_token')
      }
      const result = await PostQuery(localStorage.hostname, 'publication/', queryArr)
      if (result) {
        window.location.replace('/')
      }
    },
    toBoldText () {
      const textEl = document.getElementById('textEl')
      this.putTagToText('<b>', '</b>', textEl.selectionStart, textEl.selectionEnd)
    },
    toItalicText () {
      const textEl = document.getElementById('textEl')
      this.putTagToText('<i>', '</i>', textEl.selectionStart, textEl.selectionEnd)
    },
    toInsertText () {
      const textEl = document.getElementById('textEl')
      this.putTagToText('<ins>', '</ins>', textEl.selectionStart, textEl.selectionEnd)
    },
    toQuoteText () {
      const textEl = document.getElementById('textEl')
      this.putTagToText('<blockquote>', '</blockquote>', textEl.selectionStart, textEl.selectionEnd)
    },
    toCodeText () {
      const textEl = document.getElementById('textEl')
      this.putTagToText('<code>', '</code>', textEl.selectionStart, textEl.selectionEnd)
    },
    insertImg () {
      this.isImageSetupShow = !this.isImageSetupShow
    },
    addImageToText () {
      this.isImageSetupShow = false
      const textEl = document.getElementById('textEl')
      const position = textEl.selectionStart !== 0 ? textEl.selectionStart : this.articleText.length
      this.putTagToText(`<img src=" ${this.userImage.url} " style="width: ${this.userImage.width}px; height: ${this.userImage.height}px"/>`, '', position, -1)
      this.userImage.url = ''
      this.userImage.width = 0
      this.userImage.height = 0
    },
    putTagToText (tagStart, tagFinish, tagStartNumIdx, tagFinishNumIdx) {
      let newText = ''
      let finishTagIsPut = false
      for (let i = 0; i < this.articleText.length; i++) {
        if (i === tagStartNumIdx) {
          newText += tagStart
        }
        if (i === tagFinishNumIdx) {
          newText += tagFinish
          finishTagIsPut = true
        }
        newText += this.articleText[i]
      }
      if (tagFinish !== '' && !finishTagIsPut) {
        newText += tagFinish
      }
      if (tagFinish === '') {
        newText += tagStart
      }
      this.articleText = newText
    }
  }
}
</script>

<style lang="sass">
  @import "../../sass/user_styles"
</style>
