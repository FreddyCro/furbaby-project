<template lang="pug">
.fk-ans-start.fk-page
  fk-bg

  .fk-ans-content.fk-container
    .fk-ans__wizard-wrapper
      fk-wizard(:idx="1")

    //- start page
    .fk-ans__start
      .fk-name-input
        .fk-name-input__title
          img(
            src="/assets/img/common/footprint_icon.png"
            alt="footprint"
          )
          
          h2 {{ title }}

        .fk-name-input__desc
          p {{ desc }}

        .fk-name-input__text
          .fk-name-input__label 請輸入你的名字
          input(
            type="text"
            placeholder="請輸入你的名字"
            v-model="name"
            autofocus
          )

      //- pagination
    .fk-ans__pagination
      //- start page
      .fk-ans__pagination-start(v-show="name.length > 0")
        router-link(:to="`/quiz/${cate}/1`") 
          button.fk-btn-prim(
            @click="$store.dispatch('setCategory', cate)"
          ) START

</template>

<script>
import FkBg from '@/components/fk-bg.vue';
import FkWizard from '@/components/fk-wizard.vue';

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

  &__text {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
  }

  &__label {
    margin: $spacing-3 $spacing-3 $spacing-3 0;
  }

  input[type='text'] {
    border: 2px solid $color-primary;
    padding: $spacing-2 $spacing-3;
  }
}
</style>
