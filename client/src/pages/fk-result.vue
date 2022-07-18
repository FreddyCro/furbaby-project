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
        .pure-u-1-1.pure-u-sm-1-2.align-middle
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

        .pure-u-1-1.pure-u-sm-1-2
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

              .fk-result__share-btn-wrapper
                share-network(
                  network="line"
                  :url="`https://event.udn.com/royalcanin2022/sharing.php?c=${$store.state.cate}&sc=${$store.state[$store.state.cate].score}&lv=${result.level}`"
                  :title="meta.title"
                  :description="shareDescription"
                  hashtags="royalcanin"
                )
                  .fk-result__share-btn {{ str.lineToFriend }}
              .fk-result__share-btn-wrapper
                share-network(
                  network="facebook"
                  :url="`https://event.udn.com/royalcanin2022/sharing.php?c=${$store.state.cate}&sc=${$store.state[$store.state.cate].score}&lv=${result.level}`"
                  :title="meta.title"
                  :description="shareDescription"
                  hashtags="royalcanin"
                )
                  .fk-result__share-btn
                    span 
                      img(src="assets/img/common/fb.png")
                    span {{ str.shareResult }}
      .fk-result__banner
</template>

<script>
import { submitResult, getRankingByScore } from '@/api/quiz';
import str from '@/assets/json/quiz.json';
import meta from '@/assets/json/meta.json';
import rankingDog from '@/assets/json/ranking-dog.json';
import rankingCat from '@/assets/json/ranking-cat.json';

import FkBg from '@/components/fk-bg.vue';
import FkBtnPrimary from '@/components/fk-btn/fk-btn-primary';
import FkBtnSecondary from '@/components/fk-btn/fk-btn-secondary';
import FkFootprint from '@/components/fk-footprint.vue';

export default {
  name: 'Result',
  components: {
    FkBg,
    FkBtnPrimary,
    FkBtnSecondary,
    FkFootprint,
  },
  data: () => ({
    str,
    meta,
    result: {
      level: 0,
      ranking: 1,
    },
  }),
  computed: {
    sharingUrl() {
      return `./sharing.php?n=${this.$store.state.user}&c=${
        this.$store.state.cate
      }&lv=${this.result.level}&sc=${
        this.$store.state[this.$store.state.cate].score
      }`;
    },
    finalImg() {
      if (!this.$store.state.cate) return undefined;
      return `assets/img/quiz/${this.$store.state.cate}/level_${this.result.level}.png`;
    },
    rankingStr() {
      if (this.$store.state.cate === 'dog')
        return rankingDog[this.$store.state.cate];
      if (this.$store.state.cate === 'cat')
        return rankingCat[this.$store.state.cate];
      return undefined;
    },
    shareDescription() {
      return `${this.$store.state.user} 剛剛測驗了自己的毛寵達人級數，答對${this.$store.state[this.$store.state.cate].score}題{，答錯${7 - this.$store.state[this.$store.state.cate].score}題${this.rankingStr ? '，等級為' + this.rankingStr : ''}，排名為${this.result.ranking}`;
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

    img {
      margin: $spacing-2;
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

  &__standing-text {
  }

  &__share {
    display: flex;
    align-items: center;
    margin: 2rem 0;

    a {
      color: $color-primary;
      text-decoration: none;
    }
  }

  &__share-btn-wrapper {
    margin-right: 0.5rem;

    @include rwd-min(sm) {
      margin-right: 1rem;
    }

    &:last-child {
      margin-right: 0;
    }
  }

  &__share-btn {
    @include reset-btn;

    display: flex;
    align-items: center;
    justify-content: center;
    padding: $spacing-1 $spacing-3;
    border: solid 2px $color-primary;
    border-radius: 20px;
    color: $color-primary;

    img {
      margin-right: $spacing-1;
    }
  }

  &__banner {
    margin: 0 auto;
    width: 350px;
    height: 200px;
    background-color: lightcoral;
  }
}
</style>
