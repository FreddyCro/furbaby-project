<template lang="pug">
.fk-landing
  h1 Welcome to the furkid.
  
  div
    router-link(to="/quiz/cat") start cat
  div
    router-link(to="/quiz/dog") start dog
</template>