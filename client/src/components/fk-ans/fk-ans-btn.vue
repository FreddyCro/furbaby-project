<template lang="pug">
button.fk-ans-btn(
  :class="{ [className]: className, 'fk-ans-opt--selected': isActive }"
)






  //- .fk-ans-opt.fk-ans-opt-5(
  //-   :class="{'fk-ans-opt--selected': myAns.includes(+item)}"
  //- )
  //-   .fk-ans-opt__img-wrapper
  //-     component(:is="`Option-${index + 1}`")

  //-   .fk-ans-opt__name {{ data.options[item] }}
  //-   input.fk-ans-opt__input(
  //-     :id="`${cate}q-input-${data.idx}-${item}`"
  //-     type="checkbox"
  //-     :value="+item"
  //-     v-model="myAns"
  //-     @change="selectAnswer(multiStrategy(data.ans))"
  //-   )

  //- input slot
  //- slot


</template>

<script>
export default {
  name: 'FkAnsBtn',
  props: {
    isActive: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
