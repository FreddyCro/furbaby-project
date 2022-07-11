<template lang="pug">
.fk-wizard
  .fk-wizard__circle(
    v-for="item in 7"
    :key="item.id"
    :class="{'fk-wizard__circle--active': +item === +idx}"
  ) {{ item }}
    
</template>

<script>
export default {
  name: 'FkWizard',
  props: {
    idx: {
      type: Number,
      required: true,
    },
  },
};
</script>

<style lang="scss">
$progress-red: rgb(235, 0, 26);

.fk-wizard {
  position: relative;
  display: inline-flex;
  align-items: center;
  overflow: hidden;

  &::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    width: 100%;
    height: 2px;
    background-color: $progress-red;
  }

  &__circle {
    position: relative;
    width: 24px;
    height: 24px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 $spacing-2;
    border-radius: 50%;
    border: solid 2px $progress-red;
    color: $progress-red;
    background-color: $white;

    @include rwd-min(sm) {
      width: 36px;
      height: 36px;
      margin: 0 $spacing-3;
    }

    @include rwd-min(lg) {
      margin: 0 $spacing-4;
    }

    &--active {
      color: $white;
      background-color: $progress-red;
    }

    &:first-child {
      margin-left: 0;
    }

    &:last-child {
      margin-right: 0;
    }
  }
}
</style>
