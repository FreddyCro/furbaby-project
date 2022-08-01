<template lang="pug">
.fk-result.fk-page
  fk-bg
  .fk-container
    .fk-result__header
      .fk-result__header-line
      .fk-result__header-crown
        img(src='assets/img/common/crown.png')
    .fk-result__content
      .pure-g.autopad-6
        .pure-u-1-1.pure-u-sm-2-5.pure-u-md-1-2.align-middle
          .fk-result__illus-wrapper
            .fk-result__starts
              img(
                v-for="item, index in result.level"
                :key="`star-${index}`"
                src="assets/img/quiz/star.png",
                alt="star",
              )
              img(
                v-for="item, index in 4 - result.level"
                :key="`empty-${index}`"
                src="assets/img/quiz/star_empty.png",
                alt="star",
              )
            .fk-result__illus
              img(:src="finalImg", alt="final score")

        .pure-u-1-1.pure-u-sm-3-5.pure-u-md-1-2
          .fk-result__standing
            h2.fk-result__standing-title
              span.user-name
                fk-footprint
                span {{ $store.state.user }}
              br
              span(v-if="rankingStr") 你是{{ rankingStr.title }}
              
            h3.fk-result__standing-desc(v-if="rankingStr") {{ rankingStr.desc }}
            p.fk-result__standing-score(v-if="$store.state.cate")
              span 答對 {{ $store.state[$store.state.cate].score }} 題 / 答錯 {{ 7 - $store.state[$store.state.cate].score }} 題
              span 你現在排 {{ result.ranking }} 名

            .fk-result__share
              .fk-result__share-btn-wrapper
                router-link(to="/")
                  .fk-result__share-btn(@click="$store.dispatch('resetState')") {{ str.tryAgain }}
                    span.fk-result__share-btn-arrow

              .fk-result__share-btn-wrapper
                share-network(
                  network="line"
                  :title="meta.title"
                  :url="sharingLineUrl"
                  :description="shareDescription"
                )
                  .fk-result__share-btn {{ str.lineToFriend }}
                    span.fk-result__share-btn-arrow
                    
              .fk-result__share-btn-wrapper
                share-network(
                  network="facebook"
                  :url="sharingUrl"
                  :title="shareTitle"
                  :description="shareDescription"
                  :hashtags="str.hashtags"
                )
                  .fk-result__share-btn
                    img(src="assets/img/common/fb.png" alt="fb icon")
                    span {{ str.shareResult }}
                      span.fk-result__share-btn-arrow

          .fk-result__banner
            img(@click="toggleDialog(true)" src="assets/img/quiz/share_banner.gif" alt="share and recive reward")
  
  .fk-credit
    .fk-credit__content
      .fk-credit__row
        .fk-credit__title {{ credit.org }}
        .fk-credit__name
      .fk-credit__row
        .fk-credit__title {{ credit.design }}
        .fk-credit__name {{ credit.designer }}
      .fk-credit__row
        .fk-credit__title {{ credit.source }}
        .fk-credit__name {{ credit.sourcer }}
      .fk-credit__row
        .fk-credit__title {{ credit.mk }}
        .fk-credit__name {{ credit.mker }}
      .fk-credit__row
        .fk-credit__title {{ credit.direct }}
        .fk-credit__name {{ credit.directer }}
      .fk-credit__row
        .fk-credit__title
        .fk-credit__name {{ credit.release }}
    
  fk-share-dialog(
    v-if="toggleDialog && shareTitle && shareDescription && sharingUrl && str.hashtags"
    :is-dialog-open="isDialogOpen"
    :toggle="toggleDialog"
    :share-title="shareTitle"
    :share-url="sharingUrl"
    :share-description="shareDescription"
    :share-tags="str.hashtags"
  )

</template>

<script>
import { submitResult, getRankingByScore } from '@/api/quiz';
import str from '@/assets/json/quiz.json';
import meta from '@/assets/json/meta.json';
import credit from '@/assets/json/credit.json';
import rankingDog from '@/assets/json/ranking-dog.json';
import rankingCat from '@/assets/json/ranking-cat.json';

import FkBg from '@/components/fk-bg.vue';
import FkFootprint from '@/components/fk-footprint.vue';
import FkShareDialog from '@/components/fk-share-dialog.vue';

export default {
  name: 'Result',
  components: {
    FkBg,
    FkFootprint,
    FkShareDialog,
  },
  data: () => ({
    str,
    meta,
    credit,
    result: {
      level: 0,
      ranking: 1,
    },
    isDialogOpen: false,
    shareTitle: '你有自信成為皇家級飼主嗎？',
  }),
  computed: {
    sharingUrl() {
      if (!this.$store.state.cate) return meta.metaUrl;

      return `${window.location.protocol}//${
        process.env.VUE_APP_API_ROOT
      }/sharing.php?n=${this.$store.state.user}&c=${
        this.$store.state.cate
      }&sc=${this.$store.state[this.$store.state.cate].score}&lv=${
        this.result.level
      }`;
    },
    sharingLineUrl() {
      return `${window.location.protocol}//${
        process.env.VUE_APP_API_ROOT
      }/sharing-line.html?v=${(Math.random() * 100) | 0}`;
    },
    finalImg() {
      if (!this.$store.state.cate) return undefined;
      return `assets/img/quiz/${this.$store.state.cate}/level_${this.result.level}.png`;
    },
    rankingStr() {
      if (this.$store.state.cate === 'dog')
        return rankingDog[this.result.level];

      if (this.$store.state.cate === 'cat')
        return rankingCat[this.result.level];

      return undefined;
    },
    shareDescription() {
      if (!this.$store.state.cate)
        return '參加活動就有機會拿3個月份寵物飼料。你也一起來挑戰看看吧！';

      const wording = [
        `${this.$store.state.user} 剛剛測驗了自己的毛寵達人級數`,
        `，答對${this.$store.state[this.$store.state.cate].score}題`,
        `${this.rankingStr ? '，是' + this.rankingStr.title : ''}`,
        `，排名為${this.result.ranking}。
`,
        '參加活動就有機會拿3個月份寵物飼料。你也一起來挑戰看看吧！',
      ];

      return wording.join('');
    },
  },
  created() {
    if (this.$store.state.cate) {
      // submit result
      const score = this.$store.state[this.$store.state.cate].score;

      if (!score || score === 0 || score === 1) this.result.level = 1;
      if (score === 2 || score === 3 || score === 4) this.result.level = 2;
      if (score === 5 || score === 6) this.result.level = 3;
      if (score === 7) this.result.level = 4;
      // this.result.level = Math.floor(score / 2) + 1;

      // db index 1 = score 0, index 8 = score 7, so score should +1
      window.grecaptcha.ready(() => {
        window.grecaptcha
          .execute('6Ld7IxohAAAAAIYW6BpJCeUIUL4MMf0BQkbq_uto', {
            action: 'submit',
          })
          .then((token) => {
            if (token) console.log('client recaptcha success');
            submitResult(this.$store.state.cate, score + 1, token);
          });
      });

      // get ranking data
      getRankingByScore(this.$store.state.cate, score).then((res) => {
        if (+res.status === 200) {
          this.result.ranking = res.data;
        } else console.log(res, 'fail');
      });
    }
  },
  methods: {
    toggleDialog(bool) {
      this.isDialogOpen = bool;

      document.querySelector('body').style.overflow = bool ? 'hidden' : 'auto';
    },
  },
};
</script>

<style lang="scss">
.fk-result {
  &.fk-page {
    margin: 5rem 0;
  }

  .fk-bg {
    opacity: 0.5;

    @include rwd-max(xs) {
      .fk-bg__floor,
      .fk-bg__front {
        background-position: center top;
      }
    }
  }

  &__header {
    position: relative;
    width: 80%;
    height: 50px;
    margin: 0 auto;
    text-align: center;
  }

  &__header-crown {
    position: relative;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    padding: 0 $spacing-5;
    background-color: $white;
  }

  &__header-line {
    position: absolute;
    left: 0;
    top: 50%;
    width: 100%;
    height: 1px;
    border-bottom: solid 1px rgb(229, 194, 94);
  }

  &__content {
    position: relative;
    margin-top: $spacing-7;
    overflow: hidden;
  }

  &__starts {
    text-align: center;
    margin-bottom: $spacing-2;

    img {
      margin: $spacing-2;
    }
  }

  &__illus {
    text-align: center;
  }

  &__standing {
    line-height: 1.5;

    @include rwd-max(xs) {
      text-align: center;
    }
  }

  &__standing-title {
    color: $color-primary;
    font-weight: 500;
    margin-bottom: $spacing-2;
    .user-name {
      display: inline-flex;
      align-items: center;
    }

    .fk-footprint {
      margin-right: $spacing-2;
      height: 2rem;
    }
  }

  &__standing-desc {
    padding-bottom: $spacing-2;
    border-bottom: solid 1px $gray-5;
    margin-top: $spacing-2;
    font-weight: 500;

    @include rwd-max(xs) {
      margin-left: $spacing-5;
      margin-right: $spacing-5;
    }
  }

  &__standing-score {
    span {
      margin: 0 $spacing-3;
    }
  }

  &__share {
    display: flex;
    align-items: center;
    margin: 2rem 0;

    a {
      color: $color-primary;
      text-decoration: none;
    }

    @include rwd-max(xs) {
      justify-content: space-evenly;
    }
  }

  &__share-btn-wrapper {
    margin-right: $spacing-1;

    @include rwd-min(sm) {
      margin-right: 1rem;
    }

    &:last-child {
      margin-right: 0;
    }
  }

  &__share-btn {
    @include reset-btn;

    min-height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: $spacing-1 $spacing-2;
    border: solid 2px $color-primary;
    border-radius: 20px;
    color: $color-primary;
    font-size: $p-2;

    @include rwd-min(sm) {
      padding: $spacing-1 $spacing-3;
    }

    img {
      width: 1rem;
      margin-right: $spacing-1;
    }
  }

  &__share-btn-arrow {
    display: inline-block;
    border-style: solid;
    border-width: 2px;
    border-color: $color-primary $color-primary transparent transparent;
    width: 0.5rem;
    height: 0.5rem;
    margin-left: $spacing-1;
    transform: rotate(45deg);
  }

  &__banner {
    max-width: 480px;
    margin: $spacing-8 auto 0 auto;
    cursor: pointer;

    @include rwd-min(sm) {
      max-width: 500px;
      margin: $spacing-7 auto 0 auto;
    }
  }
}

.fk-credit {
  position: relative;
  max-width: 880px;
  display: flex;
  margin: 0 auto;
  margin-top: $spacing-8;
  text-align: left;
  color: $gray-6;

  @include rwd-min(sm) {
    margin-top: 120px;
  }

  &__content {
    display: inline-flex;
    flex-direction: column;
    margin: 0 auto;
  }

  &__row {
    display: flex;
    line-height: 1.5;
  }

  &__title {
    min-width: 80px;
  }
}
</style>
