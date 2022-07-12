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
        .fk-cq7-ans__options
          .pure-g.autopad-2
            .pure-u-1-1(
              v-for="item, index in Object.keys(data.options)"
              :key="`${cate}q-${data.idx}-${item}`"
            )
              button.fk-ans-opt-small(
                :class="{'fk-ans-opt-small--selected': +myAns === +item}"
                :id="`${cate}q-input-${data.idx}-${item}`"
                :value="+item"
                @click="selectAnswer(singleStrategy(data.ans, item))"
              ) {{ data.options[item] }}

        .fk-cq7-ans__cup
          //- TODO: cup chart




    template(#correct-ans)
      fk-ans-correct(
        :question="data.title"
        :cate="cate"
        :illustration="`/assets/img/quiz/${cate}/${data.idx}/ans_illus.png`"
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
 * data: [hasSelect, hasSubmitted, isCorrect]
 * methods: [selectAnswer, submitAnswer]
 * components: [FkAnsCorrect, FkAnsSubmit, FkAnsDoctor, FkBtnPrimary]
 */
import { singleStrategyMixins } from '@/assets/js/mixins';
import quiz from '@/assets/json/quiz-cat.json';
import FkAns from '@/components/fk-ans/fk-ans.vue';
import FkAnsCorrect from '@/components/fk-ans/fk-ans-correct.vue';
import FkAnsSuggest from '@/components/fk-ans/fk-ans-suggest.vue';

export default {
  name: 'CatQ7',
  components: {
    FkAns,
    FkAnsCorrect,
    FkAnsSuggest,
  },
  data: () => ({
    data: quiz.cat7,
    cate: 'cat',
  }),
  mixins: [singleStrategyMixins],
};
</script>
