<template lang="pug">
.fk-cq1
  fk-ans(
    :idx="+data.idx"
    :title="data.title"
    questionType="multi"
    :has-select="hasSelect"
    :has-submitted="hasSubmitted"
    :submit-answer="submitAnswer"
    :cate="cate"
  )
    //- custom: my answer
    template(#my-ans)
      .fk-ans-opt-container.pure-g.autopad-4
        .pure-u-1-3.align-center(
          v-for="item, index in Object.keys(data.options)"
          :key="`${cate}q-${data.idx}-${item}`"
        )
          .fk-ans-opt(
            :class="{'fk-ans-opt--selected': myAns.includes(+item)}"
          )
            .fk-ans-opt__img-wrapper
              //- component(:is="`Option-${index + 1}`")
              img(
                :src="`/assets/img/quiz/dog/${data.idx}/option${index + 1}.png`"
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

    //- custom: correct answer
    template(#correct-ans)
      fk-ans-correct(
        :question="data.title"
        :cate="cate"
        :illustration="`/assets/img/quiz/${cate}/${data.idx}/ans_illus.png`"
      )
        template(#ans)
          .fk-ans-opt-container.pure-g.autopad-4
            .pure-u-1-4.align-center(
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
// import Option1 from '@/assets/img/quiz/cat/1/option1.svg';
// import Option2 from '@/assets/img/quiz/cat/1/option2.svg';
// import Option3 from '@/assets/img/quiz/cat/1/option3.svg';
// import Option4 from '@/assets/img/quiz/cat/1/option4.svg';
// import Option5 from '@/assets/img/quiz/cat/1/option5.svg';

import quiz from '@/assets/json/quiz-cat.json';
import FkAns from '@/components/fk-ans/fk-ans.vue';
import FkAnsCorrect from '@/components/fk-ans/fk-ans-correct.vue';
import FkAnsSuggest from '@/components/fk-ans/fk-ans-suggest.vue';

export default {
  name: 'CatQ1',
  components: {
    // Option1,
    // Option2,
    // Option3,
    // Option4,
    // Option5,
    FkAns,
    FkAnsCorrect,
    FkAnsSuggest,
  },
  data: () => ({
    data: quiz.cat1,
    cate: 'cat',
  }),
  mixins: [multiStrategyMixins],
};
</script>
