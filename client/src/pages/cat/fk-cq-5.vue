<template lang="pug">
.fk-cq5
  fk-ans(
    :idx="+data.idx"
    :title="data.title"
    questionType="single"
    :has-select="hasSelect"
    :has-submitted="hasSubmitted"
    :submit-answer="submitAnswer"
    :cate="cate"
  )
    template(#my-ans)
      .fk-ans-opt-container
        .pure-g.autopad-7
          .pure-u-1-12(
            v-for="item, index in Object.keys(data.options)"
            :key="`${cate}q-${data.idx}-${item}`"
          )
            button.fk-ans-opt.fk-ans-opt--binary(
              :class="{'fk-ans-opt--selected': +myAns === +item}"
              :id="`${cate}q-input-${data.idx}-${item}`"
              :value="+item"
              @click="selectAnswer(singleStrategy(data.ans, item))"
            )
              .fk-ans-opt__img-wrapper
                img(
                  :src="`/assets/img/quiz/${cate}/${data.idx}/option${index + 1}.png`"
                  :alt="data.options[item]"
                )
              .fk-ans-opt__name {{ data.options[item] }}

    template(#correct-ans)
      fk-ans-correct(
        :question="data.title"
        :cate="cate"
        :illustration="`/assets/img/quiz/${cate}/${data.idx}/ans_illus.png`"
      )
        template(#ans)
          .fk-ans-opt-container
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
  name: 'CatQ5',
  components: {
    FkAns,
    FkAnsCorrect,
    FkAnsSuggest,
  },
  data: () => ({
    data: quiz.cat5,
    cate: 'cat',
  }),
  mixins: [singleStrategyMixins],
};
</script>
