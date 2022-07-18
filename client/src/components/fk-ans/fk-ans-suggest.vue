<template lang="pug">
.fk-ans-suggest
  .fk-ans-suggest__content
    .pure-g.autopad-4
      .pure-u-1-1.pure-u-sm-1-3.pure-u-lg-1-4.center
        .fk-ans-suggest__doc
          fk-doctor

      .pure-u-1-1.pure-u-sm-2-3.pure-u-lg-3-4.center
        .fk-ans-suggest__info
          .fk-ans-suggest__say-wrapper
            .fk-ans-suggest__say-quote-arrow-wrapper
              .fk-ans-suggest__say-quote-arrow
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
  &__doc {
    text-align: center;
  }

  &__content {
    display: flex;
  }

  &__info {
    @include rwd-max(xs) {
      padding: $spacing-5;
    }
  }

  &__say-wrapper {
    position: relative;
    padding: $spacing-4;
    border-radius: 20px;
    border: solid 1px $color-primary;
    background-color: $white;

    @include rwd-min(sm) {
      padding: $spacing-5;
    }
  }

  &__say-quote-arrow-wrapper {
    position: absolute;
    z-index: 0;
    left: 50%;
    top: 0;
    display: inline-block;
    transform: scale(0.25, 1) translate(-100%, -50%);

    &::before {
      content: '';
      position: absolute;
      z-index: 1;
      right: 0;
      top: 0;
      width: 300%;
      height: 100%;
      background-color: $white;
      transform: translate(30%, 50%);
    }

    @include rwd-min(sm) {
      left: 0;
      top: $spacing-6;
      transform: scale(1, 0.25) translateX(-50%);

      &::before {
        right: 0;
        top: 0;
        width: 100%;
        height: 300%;
        transform: translate(50%, -30%);
      }
    }
  }

  &__say-quote-arrow {
    width: 30px;
    height: 30px;
    border: solid 1px $color-primary;
    background-color: $white;
    transform: rotate(45deg);
  }

  &__say {
    position: relative;
  }

  &__say-title {
    margin-top: 0;
    margin-bottom: 1rem;
    font-size: larger;
    color: $color-primary;
  }

  &__say-desc {
    color: rgb(130, 130, 130);
    margin-bottom: 0;
  }

  &__source-container {
    display: flex;
    margin-top: $spacing-5;
  }

  &__source-wrapper,
  a {
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
