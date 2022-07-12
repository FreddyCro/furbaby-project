<template lang="pug">
.fk-dq6
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
      .fk-ans-pie-wrapper
        .fk-ans-pie
          .fk-ans-pie__option(
            v-for="item, index in Object.keys(data.options)"
            :key="`${cate}q-${data.idx}-${item}`"
            :class="{ \
              [`fk-ans-pie__option--${index + 1}`]: true, \
              'fk-ans-pie__option--selected': myAns.includes(+item) \
            }"
          )
            .fk-ans-pie__option-text {{ data.options[item] }}

            input.fk-ans-pie__option-input(
              :id="`${cate}q-input-${data.idx}-${item}`"
              type="checkbox"
              :value="+item"
              v-model="myAns"
              @change="selectAnswer(multiStrategy(data.ans))"
            )

        .fk-ans-pie-label(
          v-for="item, index in Object.keys(data.options)"
          :key="`${cate}q-label-${data.idx}-${item}`"
          :class="{ \
            [`fk-ans-pie-label--${index + 1}`]: true, \
            'fk-ans-pie-label--selected': myAns.includes(+item) \
          }"
        ) {{ index + 1 }}

    template(#correct-ans)
      fk-ans-correct(
        :question="data.title"
        :cate="cate"
        :illustration="`/assets/img/quiz/${cate}/${data.idx}/ans_illus.png`"
      )
        template(#ans)
          .fk-ans-opt-container.pure-g.autopad-4
            .pure-u-1-3.align-center(
              v-for="item, index in data.ans"
              :key="`${cate}q-correct-${data.idx}-${item}`"
            )
              .fk-ans-opt.fk-ans-opt--correct
                .fk-ans-opt__img-wrapper
                  //- component(:is="`Option-${index + 1}`")
                  img(
                    :src="`/assets/img/quiz/dog/${data.idx}/option${index + 1}.png`"
                    :alt="data.options[item]"
                  )
                .fk-ans-opt__name {{ data.options[item] }}

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
 * @mixin multiStrategyMixins
 * data: [hasSelect, hasSubmitted, isCorrect, myAns]
 * methods: [selectAnswer, submitAnswer, multiStrategy]
 */
import { multiStrategyMixins } from '@/assets/js/mixins';
import quiz from '@/assets/json/quiz-dog.json';
import FkAns from '@/components/fk-ans/fk-ans.vue';
import FkAnsCorrect from '@/components/fk-ans/fk-ans-correct.vue';
import FkAnsSuggest from '@/components/fk-ans/fk-ans-suggest.vue';

export default {
  name: 'DogQ6',
  components: {
    FkAns,
    FkAnsCorrect,
    FkAnsSuggest,
  },
  data: () => ({
    data: quiz.dog6,
    cate: 'dog',
  }),
  mixins: [multiStrategyMixins],
};
</script>
