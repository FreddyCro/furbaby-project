<template lang="pug">
.fk-dq2.fk-page
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
      .fk-ans-opt-5-container
        .fk-ans-opt.fk-ans-opt-5(
          v-for="item, index in Object.keys(data.options)"
          :key="`${cate}q-${data.idx}-${item}`"
          :class="{'fk-ans-opt--selected': myAns.includes(+item)}"
        )
          .fk-ans-opt__img-wrapper
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
        illustration="/assets/img/quiz/cat/1/ans_illus.png"
      )
        template(#ans)
          .fk-ans-opt-container
            .fk-ans-opt.fk-ans-opt--correct(
              v-for="item, index in data.ans"
              :key="`${cate}q-correct-${data.idx}-${item}`"
            )
              .fk-ans-opt__img-wrapper
                component(:is="`Option-${index + 1}`")
              .fk-ans-opt__name {{ data.options[item] }}

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
import { submitAnswer, multiStrategy } from '@/assets/js/mixins';
import quiz from '@/assets/json/quiz-dog.json';
import FkWizard from '@/components/fk-wizard.vue';

export default {
  name: 'DogQ2',
  components: {
    FkWizard,
  },
  data: () => ({
    data: quiz.dog2,
    cate: 'dog',
    myAns: [],
  }),
  mixins: [submitAnswer, multiStrategy],
  methods: {},
  created() {
    console.log(process.env.VUE_APP_API_ROOT);
  },
};
</script>
