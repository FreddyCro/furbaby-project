<template lang="pug">
.fk-footer
  .fk-u-container
    a(:href="str.dotcom.url")
      span {{ str.dotcom.name }}
      fk-pic(
        src="/img/faker_icon.jpg"
        :alt="str.dotcom.name"
      )
    
    a(:href="str.orange.url")
      span {{ str.orange.name }}
      fk-pic(
        src="/img/faker_icon.jpg"
        :alt="str.orange.name"
      )
      
    a(:href="str.royal.url")
      span {{ str.royal.name }}
      fk-pic(
        src="/img/faker_icon.jpg"
        :alt="str.royal.name"
      )
</template>

<script>
import FkPic from '@/components/fk-pic.vue';

const str = {
  dotcom: { name: 'udn.com', url: '#' },
  orange: { name: 'Orange', url: '#' },
  royal: { name: 'Royal', url: '#' },
};

export default {
  name: 'FkFooter',
  components: {
    FkPic,
  },
  data() {
    return {
      str,
    };
  },
};
</script>

<style lang="scss">
.fk-footer {
  display: flex;
  justify-content: center;
  background-color: $gray-1;
}
</style>
