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

  &__floor,
  &__front {
    position: absolute;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    background-repeat: no-repeat;
  }

  &__front {
    bottom: 0;
    background-position: center bottom;
    background-size: contain;

    &--dog {
      background-image: url('~@/assets/img/common/bg_front_dog_small.png');
    }

    &--cat {
      background-image: url('~@/assets/img/common/bg_front_cat_small.png');
    }

    @include rwd-min(sm) {
      &--dog {
        background-image: url('~@/assets/img/common/bg_front_dog.png');
      }

      &--cat {
        background-image: url('~@/assets/img/common/bg_front_cat.png');
      }
    }
  }

  &__floor {
    top: 0;
    background-image: url('~@/assets/img/common/bg_small.png');
    background-size: cover;
    background-position: center bottom;

    &--quiz {
      background-image: url('~@/assets/img/common/bg_quiz_small.png');
    }

    @include rwd-min(sm) {
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
