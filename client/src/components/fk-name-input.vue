<template lang="pug">
.fk-name-input
  input(
    v-model="name"
    type="text" 
  )

  router-link(:to="`/quiz/${cate}/1`") 
    button(
      v-if="name.length > 0"
      @click="$store.dispatch('setCategory', cate)"
    ) START
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
