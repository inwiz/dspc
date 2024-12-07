<template>
<div class="center__content">
    <h1>Прогнозы</h1> 
    <div class="center__content-items">
  <PostList />
 </div>
</div>
        </template>
        
        
        <script>
import PostList from './PostList.vue';

export default {
  components: {
    PostList
  }
};
</script>
        <style scoped>
        
        
        </style>