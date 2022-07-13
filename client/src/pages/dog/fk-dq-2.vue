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
      .fk-ans-opt-container
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
                img(
                  :src="`assets/img/quiz/${cate}/${data.idx}/option${index + 1}.png`"
                  :alt="data.options[item]"
                )
              .fk-ans-opt__name {{ data.options[item] }}
              input.fk-ans-opt__input(
                :id="`${cate}q-input-${data.idx}-${item}`"
                type="checkbox"
                :value="+item"
                v-model="myAns"
                @change="selectAnswer(multiStrategy(data.ans))"
              )

      //- .fk-dq2-bowl(ref="bowl")

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
import { ErikoDragger } from '@/assets/js/dragger/dragger';

import quiz from '@/assets/json/quiz-dog.json';
import FkAns from '@/components/fk-ans/fk-ans.vue';
import FkAnsCorrect from '@/components/fk-ans/fk-ans-correct.vue';
import FkAnsSuggest from '@/components/fk-ans/fk-ans-suggest.vue';

export default {
  name: 'DogQ2',
  components: {
    FkAns,
    FkAnsCorrect,
    FkAnsSuggest,
  },
  mixins: [multiStrategyMixins],
  data: () => ({
    data: quiz.dog2,
    cate: 'dog',
    draggerList: [],
  }),
  mounted() {
    if (this.cate === 'dog') return;

    this.$nextTick(() => {
      Object.keys(this.data.options).forEach((item, index) => {
        const ed = new ErikoDragger();

        ed.setContainer(`#js-dragger-wrapper-${index}`);
        ed.setTarget(`#js-dragger-${index}`);
        ed.setStartEvent(this.handleDragStart);
        ed.setMoveEvent(this.handleDragMove);
        ed.setEndEvent(this.handleDragEnd);
        ed.setDebounce(500);

        ed.launch();

        this.draggerList.push(ed);
      });
    });

    const { x, y } = this.$refs.bowl.getBoundingClientRect();
    console.log(x, y);
  },
  destroyed() {
    // TODO: remove eventListener
    this.draggerList.forEach((item) => {
      item.removeDragger();
    });
  },
  methods: {
    handleDragStart(e) {
      console.log(e, e.dragDistance);
      // console.log(e, e.currentTarget.getAttribute('data-option-index'));
    },
    handleDragMove(e) {
      console.log(e, e.dragDistance);
      // const { x, y } = e.currentTarget.getBoundingClientRect();
      // console.log(e.currentTarget.getBoundingClientRect());
    },
    handleDragEnd(e) {
      console.log(e.dragDistance);
    },
    checkIsItemEnterBowl(from, to) {
      console.log(from, to);
      return false;
    },
  },
};
</script>

<style lang="scss" scoped>
.fk-dq2-dragger {
}
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
</style>
