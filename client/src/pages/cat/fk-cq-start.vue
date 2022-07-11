<template lang="pug">
.fk-start.fk-page
  .fk-container
    fk-ans-start(
      :title="str.title"
      :desc="str.desc"
      cate="cat"
    )
</template>

<script>
import FkAnsStart from '@/components/fk-ans/fk-ans-start.vue';

const str = {
  title: 'Hello 貓主人',
  desc: '想將幼貓健健康康地飼養到大不容易，不同成長階段的營養與健康需求、轉糧成功的關鍵，你都知道了嗎？專業飼主不可不知的寵養知識，快來挑戰一下你的級數吧！',
};

export default {
  name: 'CqStart',
  components: {
    FkAnsStart,
  },
  data: () => ({
    str,
  }),
};
</script>

<style lang="scss" scoped>
.fk-start {
}
</style>
