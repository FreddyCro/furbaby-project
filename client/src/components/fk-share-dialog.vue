<template lang="pug">
.fk-dialog(:class="{'fk-dialog--open': isDialogOpen}" @click.self="toggle(false)")

  .fk-dialog__content
    .fk-dialog__close(@click="toggle(false)")
      span
      span
      span

    .fk-dialog__header
      .fk-dialog__logo
        img(src="assets/img/footer/royal_logo.png" alt="logo")

    .fk-dialog__body
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

    .fk-dialog__footer(v-if="shareTitle !== '' && shareUrl !== '' && shareDescription !== '' && shareTags !== ''")
      share-network(
        network="facebook"
        :url="sharingUrl"
        :title="sharingTitle"
        :description="shareDescription"
        :hashtags="sharingTags"
      )
        .fk-btn-prim
          img(src="assets/img/common/fb.png" alt="fb icon")
          span {{ str.shareBtn }}
          span.btn-arrow
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
      default: '',
    },
    shareUrl: {
      type: String,
      default: '',
    },
    shareDescription: {
      type: String,
      default: '',
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
  z-index: 250;
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
  transition: 0.25s ease-in-out;

  &--open {
    opacity: 1;
    pointer-events: all;
  }

  @include rwd-min(sm) {
    padding: $spacing-10 $spacing-8;
  }

  &__header {
    position: relative;
    text-align: center;
    margin-bottom: $spacing-5;
    margin-top: $spacing-4;

    &::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 5%;
      width: 90%;
      height: 1px;
      background-color: $color-primary;
      opacity: 0.5;
    }
  }

  &__logo {
    position: relative;
    display: inline-block;
    padding: 0 $spacing-3;
    background-color: $white;
    max-width: 120px;
  }

  &__content {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: $spacing-7 $spacing-4;
    background-color: $white;

    @include rwd-min(sm) {
      width: 90%;
      height: 90%;
      padding: $spacing-6 0;
      border: solid 2px $color-primary;
      border-bottom-left-radius: 50px;
      border-bottom-right-radius: 50px;
    }

    @include rwd-min(md) {
      width: 936px;
      height: 676px;
    }
  }

  &__close {
    @include reset-btn;

    position: absolute;
    right: $spacing-3;
    top: $spacing-3;
    width: 50px;
    height: 50px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-content: center;
    padding: $spacing-2;
    border-radius: 50%;
    background-color: $color-primary;

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
      right: 0;
      top: 0;
      transform: translate(50%, -50%);
    }
  }

  &__body {
    height: 100%;
    overflow: auto;
    padding: 0 $spacing-6;

    @include rwd-min(sm) {
      padding: 0 $spacing-9;
    }
  }

  &__title {
    margin-bottom: $spacing-5;
    font-size: 24px;
    text-align: center;
    line-height: 1.5;
    color: $color-primary;

    @include rwd-min(sm) {
      margin-bottom: $spacing-7;
      font-size: 32px;
    }
  }

  &__row {
    display: flex;
    flex-direction: column;
    margin-bottom: $spacing-5;
    font-size: 20px;

    &:last-child {
      margin-bottom: 0;
    }

    @include rwd-min(sm) {
      flex-direction: row;
      margin-bottom: $spacing-7;
    }
  }

  &__row-title {
    margin-right: $spacing-3;
    margin-bottom: $spacing-2;
    color: $color-primary;
    font-weight: bolder;

    @include rwd-min(sm) {
      margin-right: $spacing-5;
      min-width: 88px;
    }
  }

  &__footer {
    padding: $spacing-5 20% 0 20%;
    text-align: center;

    .fk-btn-prim {
      display: inline-block;
      text-align: center;
      width: 100%;

      @include rwd-min(sm) {
        max-width: 136px;
      }

      img {
        height: 1rem;
        margin-right: $spacing-2;
      }
    }
  }
  .btn-arrow {
    display: inline-block;
    border-style: solid;
    border-width: 2px;
    border-color: $white $white transparent transparent;
    width: 0.75rem;
    height: 0.75rem;
    margin-left: $spacing-2;
    transform: rotate(45deg);
  }
}
</style>
