<template lang="pug">
.fk-cqd3
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
        .pure-g.autopad-2
          .pure-u-1-3(
            v-for="item, index in shuffleOptions"
            :key="`${cate}q-${data.idx}-${item}`"
          )
            button.fk-ans-opt(
              :class="{'fk-ans-opt--selected': +myAns === +item}"
              :id="`${cate}q-input-${data.idx}-${item}`"
              :value="+item"
              @click="selectAnswer(singleStrategy(data.ans, item))"
            )
              .fk-ans-opt__img-wrapper
                img(
                  :src="`assets/img/quiz/${cate}/${data.idx}/option${item}.png`"
                  :alt="data.options[item]"
                )
              .fk-ans-opt__name {{ data.options[item] }}

    template(#correct-ans)
      fk-ans-correct(
        :question="data.title"
        :cate="cate"
        :is-my-ans-correct="singleStrategy(data.ans, myAns)"
        :illustration="`assets/img/quiz/${cate}/${data.idx}/ans_illus.png`"
      )
        template(#ans)
          .fk-ans-opt-container.fk-ans-opt-container--correct
            button.fk-ans-opt.fk-ans-opt--correct
              .fk-ans-opt__img-wrapper
                img(
                  :src="`assets/img/quiz/${cate}/${data.idx}/option${data.ans}.png`"
                  :alt="data.options[data.ans]"
                )
              .fk-ans-opt__name {{ data.options[data.ans] }}

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

export default {
  name: 'CatQ3',
  components: {
    FkAns,
    FkAnsCorrect,
    FkAnsSuggest,
  },
  data: () => ({
    data: quiz.cat3,
    cate: 'cat',
  }),
  mixins: [singleStrategyMixins],
};
</script>
