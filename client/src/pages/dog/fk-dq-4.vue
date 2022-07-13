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
                component(:is="`Option-${index + 1}`")

              .fk-ans-opt__name {{ data.options[item] }}

    template(#correct-ans)
      fk-ans-correct(
        :question="data.title"
        :cate="cate"
        :illustration="`assets/img/quiz/${cate}/${data.idx}/ans_illus.png`"
      )
        template(#ans)
          .fk-ans-opt-container.fk-ans-opt-container--correct
            button.fk-ans-opt-small.fk-ans-opt-small--correct {{ data.options[data.ans] }}

        template(#suggest)
          p {{ data.explain }}

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
 */
import { singleStrategyMixins } from '@/assets/js/mixins';
import quiz from '@/assets/json/quiz-dog.json';
import FkAns from '@/components/fk-ans/fk-ans.vue';
import FkAnsCorrect from '@/components/fk-ans/fk-ans-correct.vue';
import FkAnsSuggest from '@/components/fk-ans/fk-ans-suggest.vue';
import Option1 from '@/assets/img/quiz/yes.svg';
import Option2 from '@/assets/img/quiz/no.svg';

export default {
  name: 'DogQ4',
  components: {
    FkAns,
    FkAnsCorrect,
    FkAnsSuggest,
    Option1,
    Option2,
  },
  data: () => ({
    data: quiz.dog4,
    cate: 'dog',
  }),
  mixins: [singleStrategyMixins],
};
</script>
