<template lang="pug">
.fk-dq4
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
          .pure-u-1-2(
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
                .fk-ans-opt__circle(v-if="index === 0")
                .fk-ans-opt__cross(v-else)

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
            button.fk-ans-opt-small.fk-ans-opt-small--correct {{ data.options[data.ans] }}

        template(#suggest)
          p(v-html="data.explain")

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
  name: 'DogQ4',
  components: {
    FkAns,
    FkAnsCorrect,
    FkAnsSuggest,
  },
  data: () => ({
    data: quiz.dog4,
    cate: 'dog',
  }),
  mixins: [singleStrategyMixins],
};
</script>
