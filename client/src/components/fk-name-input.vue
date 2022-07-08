<template lang="pug">
.fk-name-input
  .fk-name-input__text
    .fk-name-input__label 請輸入你的名字

    input(
      type="text"
      placeholder="請輸入你的名字"
      v-model="name"
    )

  .fk-name-input__submit
    router-link(:to="`/quiz/${cate}/1`") 
      button.fk-btn-prim(
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

<style lang="scss">
.fk-name-input {
  &__text {
    display: flex;
    align-items: center;
  }

  &__label {
    margin-right: $spacing-3;
  }

  input[type='text'] {
    border: 2px solid $color-primary;
    padding: $spacing-2 $spacing-3;
  }

  &__submit {
    margin-top: $spacing-3;
    text-align: center;
  }
}
</style>
