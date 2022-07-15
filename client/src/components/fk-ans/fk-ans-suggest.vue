<template lang="pug">
.fk-ans-suggest
  .fk-ans-suggest__content
    .pure-g.autopad-2
      .pure-u-1-3
        .fk-ans-suggest__doc
          fk-doctor

      .pure-u-2-3
        .fk-ans-suggest__info
          .fk-ans-suggest__say-wrapper
            .fk-ans-suggest__say
              h4.fk-ans-suggest__say-title “ {{ sayTitle }} ”
              p.fk-ans-suggest__say-desc(v-html="sayContent")

          .fk-ans-suggest__source-container(v-if="source")
            .fk-ans-suggest__source-label-wrapper
              span.fk-ans-suggest__source-label 資料來源
            ol.fk-ans-suggest__source-wrapper
              li(
                v-for="item in source"
                :key="item.id"
              )
                a.fk-ans-suggest__source(:href="item.url" target="_blank" rel="noopener norefer") {{ item.text }}

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

  &__source-wrapper, a {
    color: $gray-5;

    li {
      margin-bottom: $spacing-3;
    }
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
