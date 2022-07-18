<template lang="pug">
.fk-ans-start.fk-page
  fk-bg
  .fk-ans-content
    .fk-ans-content__main
      .fk-ans__wizard-wrapper
        fk-wizard(:idx="1")

      .fk-container
        //- start page
        .fk-ans__start
          .fk-name-input
            .fk-name-input__title
              fk-footprint
              
              h2 {{ title }}

            .fk-name-input__desc
              p {{ desc }}

            .fk-name-input__text
              .fk-name-input__label 請輸入你的名字
              input(
                type="text"
                placeholder="請輸入你的名字"
                v-model="name"
                @keyup.enter="$router.push(`/quiz/${cate}/1`)"
                autofocus
              )

      //- pagination
    .fk-ans__pagination
      //- start page
      .fk-ans__pagination-start(v-show="name.length > 0")
        router-link(:to="`/quiz/${cate}/1`") 
          button.fk-btn-prim(
            @click="$store.dispatch('setCategory', cate)"
          ) 
            span START
            span.fk-ans__next-step-icon

</template>

<script>
import FkBg from '@/components/fk-bg.vue';
import FkWizard from '@/components/fk-wizard.vue';
import FkFootprint from '@/components/fk-footprint.vue';

export default {
  name: 'FkAns',
  props: {
    title: {
      type: String,
    },
    desc: {
      type: String,
    },
    cate: {
      type: String,
      required: true,
    },
  },
  components: {
    FkBg,
    FkWizard,
    FkFootprint,
  },
  data: () => ({
    name: '',
  }),
  watch: {
    name(val) {
      this.$store.dispatch('setUser', val);
    },
  },
  created() {
    this.$store.dispatch('setCategory', this.cate);
  },
};
</script>

<style lang="scss">
.fk-name-input {
  &__title {
    display: flex;
    align-items: center;

    h2 {
      margin-left: $spacing-2;
      color: $color-primary;
      font-weight: 400;
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

  &__text {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
  }

  &__label {
    margin: $spacing-3 $spacing-3 $spacing-3 0;
    color: $color-primary;
  }

  input[type='text'] {
    border: 2px solid $color-primary;
    padding: $spacing-2 $spacing-3;
  }
}
</style>
