<template lang="pug">
.fk-progress
  .fk-progress__circle(
    v-for="item in 7"
    :key="item.id"
    :class="{'fk-progress__circle--active': +item === +idx}"
  ) {{ item }}
    
</template>

<script>
export default {
  name: 'FkProgress',
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

.fk-progress {
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
    width: 36px;
    height: 36px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 $spacing-4;
    border-radius: 50%;
    border-block: solid 2px $progress-red;
    color: $progress-red;
    background-color: $white;

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