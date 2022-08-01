<template lang="pug">
.fk-bg
  .fk-bg__floor(:class="{ \
    'fk-bg__floor--quiz': $store.state.cate !== undefined, \
    'fk-bg__floor--dog': $store.state.cate === 'dog', \
    'fk-bg__floor--cat': $store.state.cate === 'cat', \
  }")
  .fk-bg__front(:class="{ \
    'fk-bg__front--dog': $store.state.cate === 'dog', \
    'fk-bg__front--cat': $store.state.cate === 'cat', \
  }")
  .fk-bg__halo
    fk-halo
</template>

<script>
import FkHalo from '@/components/fk-halo.vue';

export default {
  name: 'FkBg',
  components: {
    FkHalo,
  },
};
</script>

<style lang="scss">
.fk-bg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  overflow: hidden;

  @include rwd-min(md) {
    position: fixed;
  }

  &__floor,
  &__front {
    position: absolute;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    background-position: center center;
    background-repeat: no-repeat;
  }

  &__front {
    z-index: 1;
    top: 30%;
    background-size: contain;

    &--dog {
      background-image: url('~@/assets/img/common/bg_front_dog_small.png');
    }

    &--cat {
      background-image: url('~@/assets/img/common/bg_front_cat_small.png');
    }

    @include rwd-min(sm) {
      background-size: auto;
      background-position: center bottom;
      bottom: 0;
      top: auto;
      width: 80%;
      left: 50%;
      transform: translateX(-50%);
    }

    @include rwd-min(md) {
      background-size: contain;
      background-position: center center;
      top: 30%;

      &--dog {
        background-image: url('~@/assets/img/common/bg_front_dog.png');
      }

      &--cat {
        background-image: url('~@/assets/img/common/bg_front_cat.png');
      }
    }

    @include rwd-min(lg) {
      width: 60%;
    }
  }

  &__floor {
    top: 0;
    background-image: url('~@/assets/img/common/bg_small.png');
    background-size: contain;

    &--quiz {
      background-image: url('~@/assets/img/common/bg_quiz_small.png');
    }

    @include rwd-min(sm) {
      background-size: auto;
      background-position: center bottom;
      bottom: 0;
      top: auto;
    }

    @include rwd-min(md) {
      background-size: contain;
      background-position: center center;
    }

    @include rwd-min(lg) {
      background-image: url('~@/assets/img/common/bg_merge.png');

      &--dog {
        background-image: url('~@/assets/img/common/99_bg_dog.png');
      }

      &--cat {
        background-image: url('~@/assets/img/common/99_bg_cat.png');
      }
    }
  }
}
</style>
