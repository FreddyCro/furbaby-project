<template lang="pug">
.fk-dq2
  fk-ans(
    :idx="+data.idx"
    :title="data.title"
    questionType="drag"
    :has-select="hasSelect"
    :has-submitted="hasSubmitted"
    :submit-answer="submitAnswer"
    :cate="cate"
  )
    template(#my-ans)
      //- bowl options
      .fk-db.fk-ans-opt-container
        .pure-g.autopad-4
          .pure-u-1-5.align-center(
            v-for="item, index in Object.keys(data.options)"
            :key="`${cate}q-${data.idx}-${item}`"
            :class="{'fk-ans-opt--selected': myAns.includes(+item)}"
          )
            .fk-ans-opt(
              :id="`js-dragger-wrapper-${index}`"
            )
              .fk-ans-opt__img-wrapper(
                :id="`js-dragger-${index}`"
                :data-option-index="index"
              )
                draggable(
                  class="fk-db__drag-item"
                  :list="list1"
                  group="people"
                  @change="handleChange"
                )
                  img(
                    :src="`assets/img/quiz/${cate}/${data.idx}/option${index + 1}.png`"
                    :alt="data.options[item]"
                  )

              .fk-ans-opt__name {{ data.options[item] }}
              //- input.fk-ans-opt__input(
              //-   :id="`${cate}q-input-${data.idx}-${item}`"
              //-   type="checkbox"
              //-   :value="+item"
              //-   v-model="myAns"
              //-   @change="selectAnswer(multiStrategy(data.ans))"
              //- )

      .fk-db__bowl-item-container
        .fk-db__bowl-back
        .fk-db__bowl-item-site(
          v-for="(element, index) in Object.keys(data.options)"
          :key="`db-bowl-${index + 1}-wrapper`"
          :style="{ transform: bowlItemTransform[index] }"
        )
        draggable(
          class="fk-db__bowl-item-group"
          :list="list2"
          group="people"
          @change="handleChange"
        )
          .fk-db__bowl-item(
            v-for="(element, index) in list2"
            :key="element.id"
            :style="{ transform: bowlItemTransform[index] }"
          ) 
            img(
              :src="`assets/img/quiz/${cate}/${data.idx}/option${index + 1}.png`"
            )

        .fk-db__bowl-front

    template(#correct-ans)
      fk-ans-correct(
        :question="data.title"
        :cate="cate"
        :illustration="`assets/img/quiz/${cate}/${data.idx}/ans_illus.png`"
      )
        template(#ans)
          .fk-ans-opt-container.fk-ans-opt-container--correct.pure-g.autopad-1
            .pure-u-1-2.align-center(
              v-for="item, index in data.ans"
              :key="`${cate}q-correct-${data.idx}-${item}`"
            )
              .fk-ans-opt.fk-ans-opt--correct
                .fk-ans-opt__img-wrapper
                  img(
                    :src="`assets/img/quiz/dog/${data.idx}/option${index + 1}.png`"
                    :alt="data.options[item]"
                  )
                .fk-ans-opt__name {{ data.options[item] }}

      fk-ans-suggest(
        :say-title="data.doc.say.title"
        :say-content="data.doc.say.content"
        :source="data.doc.source"
      )

</template>

<script>
/**
 * @mixin multiStrategyMixins
 * data: [hasSelect, hasSubmitted, isCorrect, myAns]
 * methods: [selectAnswer, submitAnswer, multiStrategy]
 */
import { multiStrategyMixins } from '@/assets/js/mixins';

import quiz from '@/assets/json/quiz-dog.json';
import FkAns from '@/components/fk-ans/fk-ans.vue';
import FkAnsCorrect from '@/components/fk-ans/fk-ans-correct.vue';
import FkAnsSuggest from '@/components/fk-ans/fk-ans-suggest.vue';
import draggable from 'vuedraggable';

let idGlobal = 8;
const transformSaltX = Array(10)
  .fill(0)
  .map(() => Math.random() * (Math.round(Math.random()) * 2 - 1) * 1.2);
const transformSaltY = Array(10)
  .fill(0)
  .map(() => Math.random() * (Math.round(Math.random()) * 2 - 1) * 0.1);

export default {
  name: 'DogQ2',
  display: 'Custom Clone',
  order: 3,
  components: {
    FkAns,
    FkAnsCorrect,
    FkAnsSuggest,
    draggable,
  },
  mixins: [multiStrategyMixins],
  data: () => ({
    data: quiz.dog2,
    cate: 'dog',
    list1: [],
    list2: [],
  }),
  computed: {
    bowlItemTransform() {
      return Object.keys(this.data.options).map((el, index) => {
        return `translate(${index * 50 * transformSaltX[index]}px, ${
          index * 50 * transformSaltY[index]
        }px)`;
      });
    },
  },
  created() {
    this.list1 = Object.keys(this.data.options);
  },
  methods: {
    handleChange() {
      return;
    },
    cloneDog({ id }) {
      return {
        id: idGlobal++,
        name: `cat ${id}`,
      };
    },
  },
};
</script>

<style lang="scss" scoped>
.fk-dq2-bowl {
  position: relative;
  width: 500px;
  height: 500px;
  margin: 100px auto;
  background-color: lightblue;

  &--enter {
    background-color: lightcoral;
  }
}
.fk-db {
  &__drag-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }

  &__bowl-item-container {
    position: relative;
    width: 350px;
    height: 150px;
    margin: 0 auto;
    background-color: gray;
  }

  &__bowl-item-site {
    position: absolute;
    left: 40%;
    top: 10%;
    width: 70px;
    height: 70px;
    border-radius: 50%;
    transition: 0.25s ease-in-out;
  }

  &__bowl-item {
    position: absolute;
    left: 40%;
    top: 10%;
    width: 70px;
    height: 70px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    transition: 0.25s ease-in-out;
  }

  &__bowl-item-group {
    width: 100%;
    height: 100%;
  }

  &__bowl-front,
  &__bowl-back {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    pointer-events: none;
  }
}
</style>
