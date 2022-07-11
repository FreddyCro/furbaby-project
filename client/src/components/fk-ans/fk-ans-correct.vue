<template lang="pug">
.fk-ans-correct
  .fk-ans-correct__question
    .fk-ans-correct__question-title
      span.fk-ans-correct__question-title-footprint
        footprint-cat(v-if="cate === 'cat'")
        footprint-dog(v-if="cate === 'dog'")
      span {{ question }}

    .fk-ans-correct__question-ans
      slot(name="ans")
    
    .fk-ans-correct__suggest
      slot(name="suggest")

  .fk-ans-correct__illus
    img(
      :src="illustration"
      :alt="question"
    )
</template>

<script>
import FootprintCat from '@/assets/img/quiz/cat/footprint_cat_red.svg';
import FootprintDog from '@/assets/img/quiz/dog/footprint_dog_red.svg';

export default {
  name: 'FkAnsCorrect',
  components: {
    FootprintCat,
    FootprintDog,
  },
  props: {
    question: {
      type: String,
    },
    cate: {
      type: String,
      required: true,
    },
    illustration: {
      type: String,
    },
  },
};
</script>

<style lang="scss">
.fk-ans-correct {
  display: flex;
  width: 100%;
  margin-bottom: $spacing-7;

  &__question {
    width: 65%;
    display: flex;
    flex-direction: column;
  }

  &__question-title {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    border-bottom: solid 1px $gray-4;
    color: $color-primary;
  }

  &__question-title-footprint {
    width: 32px;
    height: 32px;
    margin-right: $spacing-3;
  }

  &__question-ans {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
  }

  &__illus {
    width: 35%;
    display: flex;
    justify-content: center;
    align-items: center;
  }
}
</style>
