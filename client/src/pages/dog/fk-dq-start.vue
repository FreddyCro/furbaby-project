<template lang="pug">
.fk-start.fk-page
  .fk-container
    fk-ans-start(
      :title="str.title"
      :desc="str.desc"
      cate="dog"
    )
</template>

<script>
import FkAnsStart from '@/components/fk-ans/fk-ans-start.vue';
import str from '@/assets/json/quiz-dog.json';

export default {
  name: 'DgStart',
  components: {
    FkAnsStart,
  },
  data: ()=>({
    str: str.start,
  }),
};
</script>

<style lang="scss" scoped>
.fk-start {
  &__title {
    display: flex;
    align-items: center;

    h1 {
      color: $color-primary;
    }

    img {
      width: 32px;
      height: 32px;
      margin-right: $spacing-3;
    }
  }

  &__desc {
    margin-bottom: $spacing-7;
  }

  &__input {
    display: flex;
    align-items: center;
  }

  &__input-label {
    margin-right: $spacing-3;
  }
}
</style>
