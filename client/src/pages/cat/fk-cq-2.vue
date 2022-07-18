<template lang="pug">
.fk-cq2
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
          //- 不能用 shuffle 會亂掉
          .pure-u-1-1(
            v-for="item, index in Object.keys(data.options)"
            :key="`${cate}q-${data.idx}-${item}`"
          )
            button.fk-ans-opt-large(
              :class="{'fk-ans-opt-large--selected': +myAns === +item}"
              :id="`${cate}q-input-${data.idx}-${item}`"
              :value="+item"
              @click="selectAnswer(singleStrategy(data.ans, index + 1))"
            )
              .fk-ans-opt-large__idx-label {{ index + 1}}
              .fk-ans-opt-large__text {{ data.options[index + 1] }}

    template(#correct-ans)
      fk-ans-correct(
        :question="data.title"
        :cate="cate"
        :illustration="`assets/img/quiz/${cate}/${data.idx}/ans_illus.png`"
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
        .fk-cq2__vid-wrapper
          video.fk-cq2__vid(
            autoplay
            loop
            type="video/mp4"
            muted
          )
            source(src="assets/vid/cat2.mp4")
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
  name: 'CatQ2',
  components: {
    FkAns,
    FkAnsCorrect,
    FkAnsSuggest,
  },
  data: () => ({
    data: quiz.cat2,
    cate: 'cat',
  }),
  mixins: [singleStrategyMixins],
};
</script>

<style lang="scss" scoped>
.fk-cq2{
  &__vid-wrapper {
    text-align: center;
  }

  &__vid{
    max-width: 50%;
  }
}
</style>