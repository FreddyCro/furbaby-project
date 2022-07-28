<template lang="pug">
.fk-doc
  .fk-doc__avator-wrapper
    .fk-doc__avator
      img(src="assets/img/quiz/doc_wang_full.png", alt="doctor wang")
  .fk-doc__name
    .fk-doc__name-text {{ name }}
    .fk-doc__name-listener
      img(src="assets/img/quiz/listener.png", alt="listener")

  .fk-doc__title 
    span {{ org }}
    span {{ title }}

</template>

<script>
export default {
  name: 'FkDoctor',
  data() {
    return {
      name: '王尚麟 獸醫師',
      org: '國立臺灣大學附設動物醫院',
      title: '內科主治醫師',
    };
  },
};
</script>

<style lang="scss">
.fk-doc {
  position: relative;
  display: inline-flex;
  flex-direction: column;
  align-items: center;
  min-width: 195px;
  padding-top: $spacing-8;

  @include rwd-min(sm) {
    padding-top: $spacing-7;
  }

  @include rwd-min(md) {
    padding-top: $spacing-6;
  }

  &__avator-wrapper {
    position: relative;
    width: 136px;
    height: 136px;
    margin-bottom: -$spacing-4;
    border-radius: 50%;
    border-style: solid;
    border-color: $color-primary;
    border-width: 6px;

    &::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: calc(100% + 3px);
      height: calc(100% + 3px);
      background: linear-gradient(135deg, $white, $gray-3);
      border-radius: 50%;
    }

    @include rwd-min(md) {
      width: 164px;
      height: 164px;
      border-width: 8px;

      &::before {
        width: calc(100% + 4px);
        height: calc(100% + 4px);
      }
    }
  }

  &__avator {
    position: absolute;
    left: 50%;
    bottom: 0;
    width: 156px;
    height: 156px;
    border-radius: 50%;
    overflow: hidden;
    transform: translate(-50%, 0);

    @include rwd-min(md) {
      width: 200px;
      height: 200px;
    }
  }

  &__name {
    position: relative;
    display: inline-block;
    padding: $spacing-1 $spacing-6;
    border-radius: 30px;
    text-align: center;
    font-size: $p-4;
    color: $white;
    background-color: $color-primary;
  }

  &__name-listener {
    position: absolute;
    left: 0;
    bottom: 0;
    transform: scale(0.9) translate(-35%, $spacing-3);
  }

  &__title {
    margin-top: $spacing-2;
    color: $color-primary;
    text-align: center;

    span {
      display: inline-block;
    }
  }
}
</style>
