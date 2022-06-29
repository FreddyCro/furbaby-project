<template lang="pug">
#app
  fk-header
  img(alt="Vue logo" src="./assets/logo.png")
  div
    router-link(to="/") back to home

  router-view
</template>

<script>
import FkHeader from '@/components/fk-header.vue';
import HelloWorld from './components/HelloWorld.vue';

export default {
  name: 'App',
  components: {
    FkHeader,
    HelloWorld,
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
