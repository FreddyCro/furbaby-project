<template lang="pug">
.fk-ans-suggest
  .fk-ans-suggest__content
    .fk-ans-suggest__doc
      fk-doctor

    .fk-ans-suggest__info
      .fk-ans-suggest__say-wrapper
        .fk-ans-suggest__say
          h4.fk-ans-suggest__say-title “ {{ sayTitle }} ”
          p.fk-ans-suggest__say-desc(v-html="sayContent")

      .fk-ans-suggest__source-container(v-if="source")
        .fk-ans-suggest__source-label-wrapper
          span.fk-ans-suggest__source-label 資料來源
        .fk-ans-suggest__source-wrapper
          a.fk-ans-suggest__source(
            v-for="item in source"
            :key="item.id"
            :href="item.url"
          ) {{ item.text }}

  slot
</template>

<script>
import FkDoctor from '@/components/fk-doctor.vue';

export default {
  name: 'FkAnsSuggest',
  components: {
    FkDoctor,
  },
  props: {
    avator: {
      type: String,
    },
    name: {
      type: String,
    },
    title: {
      type: String,
    },
    sayTitle: {
      type: String,
    },
    sayContent: {
      type: String,
    },
    source: {
      type: Array,
    },
  },
};
</script>

<style lang="scss">
.fk-ans-suggest {
  .fk-ans-suggest__content {
    display: flex;
  }

  &__doc {
    width: 35%;
  }

  &__info {
    width: 100%;
  }

  &__say-wrapper {
    padding: $spacing-6 $spacing-5;
    border-radius: 20px;
    border: solid 1px $color-primary;
  }

  &__say-title {
    color: $color-primary;
  }

  &__say-desc {
    color: rgb(130, 130, 130);
  }

  &__source-container {
    display: flex;
    margin-top: $spacing-5;
  }

  &__source-label-wrapper {
    min-width: 5rem;
    margin-right: $spacing-2;
  }

  &__source-label {
    padding: $spacing-1 $spacing-2;
    color: $text-color-white;
    background-color: rgb(130, 130, 130);
    border-radius: $border-radius-3;
  }
}
</style>
