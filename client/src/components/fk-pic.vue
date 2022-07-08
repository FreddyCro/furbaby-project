<template lang="pug">
picture
  source(
    v-if="useWebp"
    :srcset="img.webpSrcset"
  )
  img.fk-pic(
    :class="{ [className]: className }"
    :src="img.src"
    :srcset="img.srcset"
    :alt="alt"
  )
</template>

<script>
const parsePath = (str) => {
  const g = /\.([0-9a-z]+)$/i;
  const ext = str.match(g)[0];
  return {
    src: str.replace(ext, ''),
    ext,
  };
};

export default {
  name: 'fk-pic',
  props: {
    className: {
      type: String,
      default: '',
    },
    src: {
      type: String,
      required: true,
    },
    useWebp: {
      type: Boolean,
      default: false,
    },
    no2x: {
      type: Boolean,
      default: false,
    },
    alt: {
      type: String,
      default: 'Furkid Master',
    },
  },
  computed: {
    img() {
      const { src, ext } = parsePath(this.src);

      let img = {
        src: `${src}${ext}`,
        srcset: this.no2x ? '' : `${src}@2x${ext} 2x`,
      };

      if (this.useWebp) {
        img.webpSrcset =
          `${src}${ext}.webp` +
          (this.no2x ? '' : `, ${src}@2x.webp 2x`);
      }

      return img;
    },
  },
};
</script>

<style lang="scss">
.fk-pic {
  max-width: 100%;
}
</style>
