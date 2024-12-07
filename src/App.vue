<script setup>
import {ref,computed } from 'vue'

import Menus from './components/Menus.vue';
// import PageNotFound from './components/PageNotFound.vue';
// import Front from './components/Front.vue';
// import PageChat from './components/PageChat.vue';
// import PagePredictions from './components/PagePredictions.vue';



</script>

<template>
  <header>
 
  </header>

  <main>

    <video autoplay muted loop id="myVideo">
  <source src="/video/0001-0150.mp4" type="video/mp4">
</video>
  <router-view></router-view>
    <Menus />
  
  </main>
</template>

<style scoped>
header {
  line-height: 1.5;
}

.logo {
  display: block;
  margin: 0 auto;
}

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }

  .logo {
    margin: 0 2rem 0 0;
  }

  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }
}
</style>
