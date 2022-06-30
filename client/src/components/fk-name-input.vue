<template lang="pug">
.fk-name-input
  input(v-model="name")
  router-link(:to="`/quiz/${cate}/1`") 
    button(@click="$store.dispatch('setCategory', cate);") next
</template>

<script>
export default {
  name: 'FkNameInput',
  props: {
    cate: {
      type: String,
      required: true,
    },
  },
  data: () => ({
    name: '',
  }),
  watch: {
    name(val) {
      this.$store.dispatch('setUser', val);
    },
  },
};
</script>
