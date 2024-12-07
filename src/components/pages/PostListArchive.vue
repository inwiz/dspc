<template>


      <PostTimer v-for="post in posts" :key="post.id" :post="post" />

  </template>
  
  <script>
  import PostTimer from '../items/PostTimer.vue';
  import axios from 'axios';

export default {
  components: {
    PostTimer
  },
  data() {
    return {
      posts: []
    };
  },
  created() {
    this.fetchPosts();
  },
  methods: {
    async fetchPosts() {
      try {
       const response = await axios.get(`${window.config.apiBaseUrl}/lgn/public-posts.php/archive`);
        console.log(response);
        this.posts = response.data.map(post => ({
          title: post.title,
          textDate: post.textDate,
          accuracy: post.accuracy,
          event_date: new Date(post.event_date)
        }));
      } catch (error) {
        console.error('Ошибка при получении данных:', error);
      }
    }
  }
};
  </script>