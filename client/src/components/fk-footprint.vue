<template lang="pug">
span.fk-footprint(v-if="gray === true")
  dog(v-if="$store.state.cate === 'dog'")
  cat(v-else)
span.fk-footprint(v-else)
  dog-red(v-if="$store.state.cate === 'dog'")
  cat-red(v-else)
</template>

<script>
import DogRed from '@/assets/img/quiz/dog/footprint_dog_red.svg';
import CatRed from '@/assets/img/quiz/cat/footprint_cat_red.svg';
import Dog from '@/assets/img/quiz/dog/footprint_dog.svg';
import Cat from '@/assets/img/quiz/cat/footprint_cat.svg';

export default {
  name: 'FkFootprint',
  props: {
    gray: {
      type: Boolean,
      default: false,
    },
  },
  components: {
    DogRed,
    CatRed,
    Dog,
    Cat,
  },
};
</script>
