<template lang="pug">
.fk-cq7
  fk-ans(
    :idx="+data.idx"
    :title="data.title"
    questionType="multi"
    :has-select="hasSelect"
    :has-submitted="hasSubmitted"
    :submit-answer="submitAnswer"
    :cate="cate"
  )
    template(#my-ans)
      .fk-cq7-ans
        .pure-g.autopad-10
          .fk-cq7-ans__options.pure-u-1-1.pure-u-sm-1-2
            .pure-g.autopad-2
              .pure-u-1-2.pure-u-sm-1-1(
                v-for="item, index in Object.keys(data.options)"
                :key="`${cate}q-${data.idx}-${item}`"
              )
                button.fk-ans-opt-small(
                  :class="{'fk-ans-opt-small--selected': +myAns === +index + 1}"
                  :id="`${cate}q-input-${data.idx}-${index + 1}`"
                  :value="+index + 1"
                  @click="selectAnswer(singleStrategy(data.ans, index + 1))"
                ) {{ data.options[index + 1] }}

          .fk-cq7-ans__cup.pure-u-1-1.pure-u-sm-1-2
            fk-cup(:data="+myAns")
            //- change image version
            //- img(
            //-   v-show="+(index + 1) === +myAns"
            //-   v-for="item, index in shuffleOptions" :key="item.id"
            //-   :src="`assets/img/quiz/cat/7/${index + 1}.png`"
            //-   alt="cup"
            //- )
            //- img(
            //-   v-show="!myAns"
            //-   src="assets/img/quiz/cat/7/0.png", alt="empty cup"
            //- )

    template(#correct-ans)
      fk-ans-correct(
        :question="data.title"
        :cate="cate"
        :is-my-ans-correct="singleStrategy(data.ans, myAns)"
        :illustration="`assets/img/quiz/${cate}/${data.idx}/ans_illus.png`"
      )
        template(#ans)
          .fk-ans-opt-container.fk-ans-opt-container--correct
            button.fk-ans-opt-small.fk-ans-opt-small--correct {{ data.options[data.ans] }}

      fk-ans-suggest(
        :say-title="data.doc.say.title"
        :say-content="data.doc.say.content"
        :source="data.doc.source"
      )

</template>

<script>
/**
 * @mixin submitAnswer
 * data: [hasSelect, hasSubmitted, isCorrect, myAns]
 * methods: [selectAnswer, submitAnswer, singleStrategy]
 */
import { singleStrategyMixins } from '@/assets/js/mixins';
import quiz from '@/assets/json/quiz-cat.json';
import FkAns from '@/components/fk-ans/fk-ans.vue';
import FkAnsCorrect from '@/components/fk-ans/fk-ans-correct.vue';
import FkAnsSuggest from '@/components/fk-ans/fk-ans-suggest.vue';
import FkCup from '@/components/fk-cup.vue';

export default {
  name: 'CatQ7',
  components: {
    FkAns,
    FkAnsCorrect,
    FkAnsSuggest,
    FkCup,
  },
  data: () => ({
    data: quiz.cat7,
    cate: 'cat',
  }),
  mixins: [singleStrategyMixins],
};
</script>

<style lang="scss" scoped>
.fk-cq7-ans {
  .fk-ans-opt-small {
    margin-left: auto;
  }
  .fk-wc {
    display: flex;
    justify-content: center;
  }

  svg {
    flex-shrink: 0;
  }
}
</style>
