<template lang="pug">
.fk-dq5
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
          .pure-u-1-1(
            v-for="item, index in shuffleOptions"
            :key="`${cate}q-${data.idx}-${item}`"
          )
            button.fk-ans-opt-large(
              :class="{'fk-ans-opt-large--selected': +myAns === +item}"
              :id="`${cate}q-input-${data.idx}-${item}`"
              :value="+item"
              @click="selectAnswer(singleStrategy(data.ans, item))"
            )
              .fk-ans-opt-large__idx-label {{ index + 1}}
              .fk-ans-opt-large__text {{ data.options[item] }}

    template(#correct-ans)
      fk-ans-correct(
        :question="data.title"
        :cate="cate"
        :useVideo="true"
        illustration="assets/vid/dog5.mp4"
      )
        template(#ans)
          .fk-ans-opt-container.fk-ans-opt-container--correct
            .fk-ans-opt-large.fk-ans-opt-large--correct(:id="`${cate}q-correct-${data.idx}`")
              .fk-ans-opt-large__idx-label {{ data.ans }}
              .fk-ans-opt-large__text {{ data.options[data.ans] }}

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
import quiz from '@/assets/json/quiz-dog.json';
import FkAns from '@/components/fk-ans/fk-ans.vue';
import FkAnsCorrect from '@/components/fk-ans/fk-ans-correct.vue';
import FkAnsSuggest from '@/components/fk-ans/fk-ans-suggest.vue';

export default {
  name: 'DogQ5',
  components: {
    FkAns,
    FkAnsCorrect,
    FkAnsSuggest,
  },
  data: () => ({
    data: quiz.dog5,
    cate: 'dog',
  }),
  mixins: [singleStrategyMixins],
};
</script>
