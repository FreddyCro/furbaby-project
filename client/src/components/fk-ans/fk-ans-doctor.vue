<template lang="pug">
.fk-ans-doc
  fk-doctor

  .fk-ans-doc__say
    h3(v-html="sayTitle")
    p(v-html="sayContent")

  .fk-anc-doc__source-container(v-if="source")
    a.fk-ans-doc__source(
      v-for="item in source"
      :key="item.id"
      :href="item.url"
    ) {{ item.text }}
</template>

<script>
import FkDoctor from '@/components/fk-doctor.vue';

export default {
  name: 'FkAnsDoctor',
  components: {
    FkDoctor,
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
      type: Array,
    },
  },
};
</script>

<style lang="scss">
.fk-suggestion {
  &__doc {

  }

  &__name {
  }

  &__title {
  }
}
</style>
