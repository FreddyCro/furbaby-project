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
      .fk-db
        draggable(
          class="fk-db__drag-container pure-g autopad-2"
          :list="list1"
          :group="{ name: 'dq2', pull: 'clone', put: false }"
          :sort="false"
          @change="handleChange"
        )
          .pure-u-1-3(
            v-for="item, index in list1"
            :key="`${cate}q-${data.idx}-${item.id}`"
            :id="`js-dragger-wrapper-${index}`"
          )
            .fk-ans-opt.fk-db__drag(:class="{'fk-db__drag--selected': myAns.includes(item.id)}")
              .fk-ans-opt__img-wrapper.fk-db__drag-img(:class="{'fk-db__drag-img--selected': myAns.includes(item.id)}")
                img(
                  v-show="!myAns.includes(item.id)"
                  :src="`assets/img/quiz/${cate}/${data.idx}/option${item.id}.png`"
                  :alt="item.value"
                )
              .fk-ans-opt__name {{ item.value }}

      .fk-db__bowl-item-container
        .fk-db__bowl-back
          img(src="assets/img/quiz/dog/2/bowl_01.png", alt="bowl")
        .fk-db__bowl-item-seat(
          v-for="(element, index) in shuffleOptions"
          :key="`db-bowl-${index + 1}-wrapper`"
          :style="{ transform: bowlItemTransform[index] }"
        )
        draggable(
          class="fk-db__bowl-item-group"
          :list="list2"
          group="dq2"
          :sort="false"
          @choose="handleRemove"
          @change="handleChange"
        )
          .fk-db__bowl-item(
            v-for="(element, index) in list2"
            :key="`bowl-item-${index}`"
            :style="{ transform: bowlItemTransform[index] }"
          ) 
            img(
              :src="`assets/img/quiz/${cate}/${data.idx}/option${element.id}.png`"
            )
        .fk-db__bowl-front
          img(src="assets/img/quiz/dog/2/bowl_02_nobone.png", alt="bowl")

        .fk-db__bowl-hint
          span.print
            footprint-dog
          span {{ data.hint }}

    template(#correct-ans)
      fk-ans-correct(
        :question="data.title"
        :cate="cate"
        :is-my-ans-correct="multiStrategy(data.ans)"
        :illustration="`assets/img/quiz/${cate}/${data.idx}/ans_illus.png`"
      )
        template(#ans)
          .fk-ans-opt-container--correct.pure-g.autopad-1
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
import { shuffle } from '@/assets/js/utils';

import quiz from '@/assets/json/quiz-dog.json';
import FootprintDog from '@/assets/img/quiz/dog/footprint_dog_red.svg';
import FkAns from '@/components/fk-ans/fk-ans.vue';
import FkAnsCorrect from '@/components/fk-ans/fk-ans-correct.vue';
import FkAnsSuggest from '@/components/fk-ans/fk-ans-suggest.vue';
import draggable from 'vuedraggable';

let idGlobal = 8;
const transformSaltX = Array(10)
  .fill(0)
  .map(() => Math.random() * (Math.round(Math.random()) * 2 - 1));
const transformSaltY = Array(10)
  .fill(0)
  .map(() => Math.random() * (Math.round(Math.random()) * 2 - 1));

export default {
  name: 'DogQ2',
  display: 'Custom Clone',
  order: 3,
  components: {
    FootprintDog,
    FkAns,
    FkAnsCorrect,
    FkAnsSuggest,
    draggable,
  },
  mixins: [multiStrategyMixins],
  data: () => ({
    data: quiz.dog2,
    cate: 'dog',
    listRaw: [],
    list1: [],
    list2: [],
  }),
  computed: {
    bowlItemTransform() {
      return Object.keys(this.data.options).map((el, index) => {
        return `translate(${Math.min(index * 50 * 0.5 * transformSaltX[index] - 25, 50)}px, ${
          index * 50 * 0.1 * transformSaltY[index]
        }px)`;
      });
    },
  },
  created() {
    // clone options and assign id
    this.listRaw = shuffle(Object.keys(this.data.options)).map((el) => {
      return { id: el, value: this.data.options[el] };
    });
    this.list1 = [...this.listRaw];
  },
  methods: {
    handleRemove(e) {
      this.list2.splice(e.oldIndex, 1);
      this.myAns = this.list2.map((el) => el.id);
    },
    handleChange() {
      // prevent duplicated answer
      this.list2 = this.list2.filter(
        (item, index) => this.list2.indexOf(item) === index
      );

      this.myAns = this.list2.map((el) => el.id);
      this.selectAnswer(this.multiStrategy(this.data.ans));
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
  &__drag-container {
    justify-content: center;
  }
  
  &__drag {
    &--selected {
      background-color: transparent;
      pointer-events: none;
    }
  }

  &__drag-img {
    border: dashed 2px transparent;

    &--selected {
      border-color: $color-primary;
      background-color: transparent;
    }
  }

  &__bowl-item-container {
    position: relative;
    width: 255px;
    height: 120px;
    margin: $spacing-8 auto $spacing-6 auto;
    text-align: center;
  }

  &__bowl-hint {
    position: absolute;
    bottom: 0;
    left: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: $color-primary;
    font-size: $p-2;
    font-weight: bolder;
    margin-top: $spacing-4;
    transform: translate(-50%, 100%);

    .print {
      margin-right: $spacing-1;
      transform: scale(0.5);
      transform-origin: right;
    }

    span {
      flex-shrink: 0;
    }
  }

  &__bowl-item-seat {
    position: absolute;
    left: 50%;
    top: 0%;
    width: 70px;
    height: 70px;
    border-radius: 50%;
    transition: 0.25s ease-in-out;
    pointer-events: none;
  }

  &__bowl-item {
    position: absolute;
    left: 50%;
    top: 0%;
    width: 70px;
    height: 70px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    background-color: $color-primary;
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
    bottom: 0;
    width: 100%;
    pointer-events: none;
  }
}
</style>
