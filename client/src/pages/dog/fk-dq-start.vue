<template lang="pug">
.fk-start.fk-page
  .fk-container
    .fk-quiz-progress-wrapper
      fk-progress(:idx="1")

    .fk-start__title
      img(
        src="/assets/img/common/footprint_icon.png"
        alt="footprint"
      )

      h1 {{ str.title }}

    .fk-start__desc
      p {{ str.desc }}

    .fk-start__input
      fk-name-input(cate="dog")
      
</template>

<script>
import FkNameInput from '@/components/fk-name-input.vue';
import FkProgress from '@/components/fk-progress.vue';

const str = {
  title: 'Hello 狗主人',
  desc: '想將幼犬健健康康地飼養到大不容易，不同成長階段的營養與健康需求、轉糧成功的關鍵，你都知道了嗎？專業飼主不可不知的寵養知識，快來挑戰一下你的級數吧！',
}

export default {
  name: 'DgStart',
  components: {
    FkNameInput,
    FkProgress,
  },
  data: ()=>({
    str,
  }),
};
</script>

<style lang="scss" scoped>
.fk-start {
  &__title {
    display: flex;
    align-items: center;

    h1 {
      color: $color-primary;
    }

    img {
      width: 32px;
      height: 32px;
      margin-right: $spacing-3;
    }
  }

  &__desc {
    margin-bottom: $spacing-7;
  }

  &__input {
    display: flex;
    align-items: center;
  }

  &__input-label {
    margin-right: $spacing-3;
  }
}
</style>
