<template lang="pug">
.fk-dialog(:class="{'fk-dialog--open': isDialogOpen}")

  .fk-dialog__content
    .fk-dialog__close(@click="toggle(false)")
      span
      span
      span

    .fk-dialog__body
      .fk-dialog__header
        .fk-dialog__logo
      .fk-dialog__title {{ str.title }}
      .fk-dialog__row
        .fk-dialog__row-title(v-html="str.row1Title")
        .fk-dialog__row-desc(v-html="str.row1Desc")

      .fk-dialog__row
        .fk-dialog__row-title(v-html="str.row2Title")
        .fk-dialog__row-desc(v-html="str.row2Desc")

      .fk-dialog__row
        .fk-dialog__row-title(v-html="str.row3Title")
        .fk-dialog__row-desc(v-html="str.row3Desc")

      .fk-dialog__row
        .fk-dialog__row-title(v-html="str.row4Title")
        .fk-dialog__row-desc(v-html="str.row4Desc")

    .fk-dialog__footer
      share-network(
        network="facebook"
        :url="sharingUrl"
        :title="sharingTitle"
        :description="shareDescription"
        :hashtags="sharingTags"
      )
        .fk-btn-prim
          img(src="assets/img/common/fb.png" alt="fb icon")
          span 立即分享
            span.fk-result__share-btn-arrow
</template>

<script>
import str from '@/assets/json/share-dialog.json';

export default {
  name: 'FkDialog',
  props: {
    isDialogOpen: {
      type: Boolean,
      default: false,
    },
    toggle: {
      type: Function,
    },
    shareTitle: {
      type: String,
      required: true,
    },
    shareUrl: {
      type: String,
      required: true,
    },
    shareDescription: {
      type: String,
      required: true,
    },
    shareTags: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      str,
    };
  },
};
</script>

<style lang="scss" scoped>
.fk-dialog {
  position: fixed;
  left: 0;
  top: 0;
  width: 100%;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: rgba(0, 0, 0, 0.7);
  opacity: 0;
  pointer-events: none;
  padding: $spacing-9 $spacing-5;
  transition: 0.25s ease-in-out;

  &--open {
    opacity: 1;
    pointer-events: all;
  }

  @include rwd-min(sm) {
    padding: $spacing-10 $spacing-8;
  }

  .fk-dialog__content {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: $spacing-6 $spacing-4;
    background-color: $white;
    border: solid 2px $color-primary;
    border-bottom-left-radius: 30px;
    border-bottom-right-radius: 30px;

    @include rwd-min(sm) {
      width: 80%;
      height: 80%;
      padding: $spacing-6 $spacing-8;
      border-bottom-left-radius: 50px;
      border-bottom-right-radius: 50px;
    }

    @include rwd-min(md) {
      width: 760px;
    }
  }

  .fk-dialog__close {
    @include reset-btn;

    position: absolute;
    right: 0;
    top: 0;
    width: 50px;
    height: 50px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-content: center;
    padding: $spacing-2;
    border-radius: 50%;
    background-color: $color-primary;
    transform: translate(25%, -25%);

    &:hover {
      opacity: 0.8;
    }

    span {
      display: inline-block;
      width: 100%;
      height: 1px;
      background-color: $white;
      transition: all 0.3s ease;
      &:nth-child(1) {
        transform: rotate(-45deg);
      }

      &:nth-child(2) {
        opacity: 0;
      }

      &:nth-child(3) {
        transform: rotate(45deg);
      }
    }

    @include rwd-min(sm) {
      transform: translate(50%, -50%);
    }
  }

  .fk-dialog__header {
  }

  .fk-dialog__body {
  }

  .fk-dialog__title {
    margin-bottom: $spacing-5;
    font-size: 24px;
    color: $color-primary;

    @include rwd-min(sm) {
      margin-bottom: $spacing-7;
      font-size: 32px;
    }
  }

  .fk-dialog__row {
    display: flex;
    flex-direction: column;
    margin-bottom: $spacing-5;

    @include rwd-min(sm) {
      flex-direction: row;
      margin-bottom: $spacing-7;
    }
  }

  .fk-dialog__row-title {
    color: $color-primary;
    margin-right: $spacing-3;
    margin-bottom: $spacing-2;

    @include rwd-min(sm) {
      margin-right: $spacing-5;
    }
  }
  .fk-dialog__row-desc {
  }

  .fk-dialog__footer {
  }
}
</style>
