<template lang="pug">
.fk-ans-doc
  .fk-ans-doc__people
    .fk-ans-doc__avator(v-if="avator")
      fk-pic(
        :src="avator"
        :alt="name"
      )
    .fk-ans-doc__name(v-if="name") {{ name }}
    .fk-ans-doc__title(v-if="title") {{ title }}

  .fk-ans-doc__say
    h3(v-html="sayTitle")
    p(v-html="sayContent")
  a.fk-ans-doc__source(v-if="source" :href="sourceUrl") {{ source }}
</template>

<script>
import FkPic from '@/components/fk-pic.vue';

export default {
  name: 'FkAnsDoctor',
  components: {
    FkPic,
  },
  props: {
    avator: {
      type: String,
    },
    name: {
      type: String,
    },
    title: {
      type: String,
    },
    sayTitle: {
      type: String,
    },
    sayContent: {
      type: String,
    },
    source: {
      type: String,
    },
    sourceUrl: {
      type: String,
    },
  },
};
</script>

<style lang="scss">
.fk-ans-doc {
  &__avator {
  }

  &__name {
  }

  &__title {
  }
}
</style>
