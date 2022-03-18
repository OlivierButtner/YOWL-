<template>
  <div class="Article">
    <div class="HeaderOfArticle">
      <div class="CategoryOfArticle" v-if="this.article.categoryname">{{this.article.categoryname}}</div>
      <div class="CategoryOfArticle" v-if="this.article.category.name">{{this.article.category.name}}</div>
    </div>
<div class="BodyOfArticle">
      <div class="ImageOfArticle" ><img :src="image"  :alt="alt"></div>
      <div class="TitleOfArticle">{{this.article.description}}</div>
      <div class="ArticleContent">{{desc}}</div>
</div>
<div class="FooterOfArticle">
        <div class="DateOfArticle">Since {{currentDateTime()}}</div>
        <div class="UsersOfArticle" v-if="this.article.user.username">By {{this.article.user.username}}</div>
</div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "ArticleDetails.vue",

  props: {
    article: Object,
  },
  data() {
    return {
      completeArticle: null,
      image: require("../assets/newspaper.png"),
      alt: this.article.description,
      desc: "article Description",
    };
  },
  mounted() {
    axios
      .get(
        "http://api.linkpreview.net/?key=117095764a45bf530483b94e67661ba4&q=" +
          this.article.url
      )
      .then((response) => {
        this.completeArticle = response.data;
        this.image = response.data.image;
        this.alt = response.data.title;
        this.desc = response.data.description;
      });
  },

  methods: {
    currentDateTime() {
      function msToTime(ms) {
        let seconds = (ms / 1000).toFixed(1);
        let minutes = (ms / (1000 * 60)).toFixed(1);
        let hours = (ms / (1000 * 60 * 60)).toFixed(1);
        let days = (ms / (1000 * 60 * 60 * 24)).toFixed(1);
        if (seconds < 60) return seconds + " Sec";
        else if (minutes < 60) return minutes + " Min";
        else if (hours < 24) return hours + " Hrs";
        else return days + " Days";
      }

      const current = new Date();
      const time = Date.parse(current) - Date.parse(this.article.created_at);
      return msToTime(time);
    },
  },
};
</script>

<style>
.Article {
  transition: 1s;

  width: 300px;
  height: 375px;
  border-radius: 33px;

  box-shadow: 1px 1px 1px 1px rgb(184, 200, 217);
background-color: rgb(246, 249, 250);

}
.Article:hover {
  box-shadow: 0 6px 6px 0 rgb(175, 196, 221);
}
.HeaderOfArticle {
  padding: 2px 16px;
  background-color: #4fa9fd;
  border-radius: 33px 33px 0 0;
  border: #2c3e50;
  color: #FFFFFF;
}
.CategoryOfArticle {
  font-size: 24px;
}
.ImageOfArticle{
  min-height: 10px;
  padding: 5px;
}

      .TitleOfArticle{
        font-size: 16px;
        color: #2c3e50;
        text-align: center;
        height: 40px;
        overflow: hidden;

}
      .ArticleContent{
        font-size: 12px;
        color: #2c3e50;
        text-align: left;
        height: 50px;
        overflow: hidden;
        padding: 5px;

}

.FooterOfArticle {
  padding: 2px 16px;
  background-color: #4fa9fd;
  border-radius: 0 0 33px 33px;
  border: #2c3e50;
  color: #FFFFFF;
}
.DateOfArticle {
  font-size: 14px;
}
.UsersOfArticle {
  font-size: 14px;
}
img {
  width: 200px;
  height: 200px;
}
</style>
