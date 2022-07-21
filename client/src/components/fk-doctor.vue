<template lang="pug">
.fk-doc
  .fk-doc__avator
    img(src="assets/img/quiz/doc_wang.png", alt="doctor wang")
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

  &__avator {
    margin-bottom: -1.5rem;
    margin-left: -20px;
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
