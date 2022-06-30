<template lang="pug">
.fk-footer
  .fk-u-container
    a(:href="str.dotcom.url")
      fk-pic(
        src="/img/faker_icon.jpg"
        :alt="str.dotcom.title"
      )
    
    a(:href="str.orange.url")
      fk-pic(
        src="/img/faker_icon.jpg"
        :alt="str.orange.title"
      )
      
    a(:href="str.royal.url")
      fk-pic(
        src="/img/faker_icon.jpg"
        :alt="str.royal.title"
      )
</template>

<script>
import FkPic from '@/components/fk-pic.vue';

const str = {
  dotcom: {
    title: 'Dotcom',
    desc: 'Dotcom is a company that makes a lot of money.',
  },
  orange: {
    title: 'Orange',
    desc: 'Orange is a company that makes a lot of money.',
  },
  royal: {
    title: 'Royal',
    desc: 'Royal is a company that makes a lot of money.',
  },
}

export default {
  name: 'FkFooter',
  components: {
    FkPic,
  },
  data() {
    return {
      str,
    }
  },
};
</script>

<style lang="scss">
.fk-footer {
  display: flex;
  justify-content: center;
}
</style>
