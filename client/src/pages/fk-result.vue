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
              span
                fk-footprint
              span {{ $store.state.user }}
              br
              span(v-if="rankingStr") {{ rankingStr.title }}
              
            h3.fk-result__standing-desc(v-if="rankingStr") {{ rankingStr.desc }}
            p.fk-result__standing-score 答對 {{ $store.state[$store.state.cate].score }} 題 / 答錯 {{ 7 - $store.state[$store.state.cate].score }}
            p.fk-result__standing-score 你現在排 {{ result.ranking }} 名

            .fk-result__share
              .fk-result__share-btn-wrapper
                router-link(to="/")
                  .fk-result__share-btn(@click="$store.dispatch('resetState')") {{ str.tryAgain }}
                    span.fk-result__share-btn-arrow

              .fk-result__share-btn-wrapper
                share-network(
                  network="line"
                  :url="sharingUrl"
                  :title="meta.title"
                  :description="shareDescription"
                  hashtags="營養成就健康基礎"
                )
                  .fk-result__share-btn {{ str.lineToFriend }}
                    span.fk-result__share-btn-arrow
                    
              .fk-result__share-btn-wrapper
                share-network(
                  network="facebook"
                  :url="sharingUrl"
                  :title="meta.title"
                  :description="shareDescription"
                  :hashtags="str.hashtags"
                )
                  .fk-result__share-btn
                    img(src="assets/img/common/fb.png" alt="fb icon")
                    span {{ str.shareResult }}
                      span.fk-result__share-btn-arrow
                    
      .fk-result__banner
        img(@click="toggleDialog(true)" src="assets/img/quiz/share_banner.gif" alt="share and recive reward")

  fk-share-dialog(
    :is-dialog-open="isDialogOpen"
    :toggle="toggleDialog"
    :share-title="meta.title"
    :share-url="sharingUrl"
    :share-description="shareDescription"
    :share-tags="str.hashtags"
  )

</template>

<script>
import { submitResult, getRankingByScore } from '@/api/quiz';
import str from '@/assets/json/quiz.json';
import meta from '@/assets/json/meta.json';
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
    result: {
      level: 0,
      ranking: 1,
    },
    isDialogOpen: false,
  }),
  computed: {
    sharingUrl() {
      return `${window.location.protocol}//${
        process.env.VUE_APP_API_ROOT
      }/sharing.php?c=${this.$store.state.cate}&sc=${
        this.$store.state[this.$store.state.cate].score
      }&lv=${this.result.level}`;
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
      return `${this.$store.state.user} 剛剛測驗了自己的毛寵達人級數，答對${
        this.$store.state[this.$store.state.cate].score
      }題，答錯${7 - this.$store.state[this.$store.state.cate].score}題${
        this.rankingStr ? '，你是' + this.rankingStr.title : ''
      }，排名為${this.result.ranking}`;
    },
  },
  created() {
    if (this.$store.state.cate) {
      // submit result
      const score = this.$store.state[this.$store.state.cate].score;
      this.result.level = Math.floor(score / 2) + 1;

      // db index 1 = score 0, index 8 = score 7, so score should +1
      submitResult(this.$store.state.cate, score + 1);

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
      console.log(bool);
      this.isDialogOpen = bool;

      document.querySelector('body').style.overflow = bool ? 'hidden' : 'auto';
    },
  },
};
</script>

<style lang="scss" scoped>
.fk-page {
  margin: 5rem 0;
}

.fk-result {
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
    @include rwd-max(xs) {
      text-align: center;
    }
  }

  &__standing-title {
    color: $color-primary;
    line-height: 1.5;
    font-weight: 500;
    margin-bottom: $spacing-2;

    .fk-footprint {
      margin-right: $spacing-2;
    }
  }

  &__standing-desc {
    padding-bottom: $spacing-2;
    border-bottom: solid 1px $gray-4;
    margin-top: $spacing-2;
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
    margin: $spacing-8 auto 0 auto;
    cursor: pointer;
  }
}
</style>
