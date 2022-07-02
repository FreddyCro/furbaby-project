<template lang="pug">
.fk-start.fk-page
  .fk-container
    .fk-start__title
      h1 {{ str.title }}

    .fk-start__desc
      p {{ str.desc }}

    .fk-start__input
      .fk-start__input-label {{ str.input }}
      fk-name-input(cate="cat")
</template>

<script>
import FkNameInput from '@/components/fk-name-input.vue';

const str = {
  title: 'Hello 貓主人',
  desc: '想將幼貓健健康康地飼養到大不容易，不同成長階段的營養與健康需求、轉糧成功的關鍵，你都知道了嗎？專業飼主不可不知的寵養知識，快來挑戰一下你的級數吧！',
  input: '請輸入你的名字',
};

export default {
  name: 'CqStart',
  components: {
    FkNameInput,
  },
  data: () => ({
    str,
  }),
};
</script>

<style lang="scss" scoped></style>
