<template lang="pug">
.fk-result.fk-page
  .fk-result__content.fk-container
    .fk-result__illus
      img(:src="finalImg", alt="final score")
    .fk-result__standing
      h2.fk-result__standing-title {{ $store.state.user }}
      h2.fk-result__standing-title(v-if="rankingStr") {{ rankingStr[result.level + 1].title }}
      h3.fk-result__standing-desc(v-if="rankingStr") {{ rankingStr[result.level + 1].desc }}
      p.fk-result__standing-score 答對 {{ $store.state[$store.state.cate].score }} 題 / 答錯 {{ 7 - $store.state[$store.state.cate].score }}
      p.fk-result__standing-score 你現在排 {{ result.ranking }} 名

      .fk-result__share
        router-link(to="/")
          .button.fk-result__share-btn(@click="$store.dispatch('resetState')") {{ str.tryAgain }}
        .button.fk-result__share-btn() {{ str.lineToFriend }}
        a(:href="sharingUrl" target="_blank" rel="noopener noreferrer")
          .button.fk-result__share-btn() {{ str.shareResult }}

      .fk-result__learn-more
        a(href="#", target="_blank", rel="noopener noreferrer") 
          button.fk-btn-prim {{ str.furkidNews }}
        a(href="#", target="_blank", rel="noopener noreferrer") 
          button.fk-btn-prim {{ str.furkidStrategy }}
</template>

<script>
import { submitResult, getRankingByScore } from '@/api/quiz';

import FkBtnPrimary from '@/components/fk-btn/fk-btn-primary';
import FkBtnSecondary from '@/components/fk-btn/fk-btn-secondary';

import str from '@/assets/json/result.json';
import rankingDog from '@/assets/json/ranking-dog.json';
import rankingCat from '@/assets/json/ranking-cat.json';

export default {
  name: 'Result',
  components: {
    FkBtnPrimary,
    FkBtnSecondary,
  },
  data: () => ({
    str,
    result: {
      level: 0,
      ranking: 1,
    },
  }),
  computed: {
    sharingUrl() {
      return `./sharing.php?n=${this.$store.state.user}&c=${this.$store.state.cate}&lv=${this.result.level}&sc=${this.$store.state[this.$store.state.cate].score}`;
    },
    finalImg() {
      if (!this.$store.state.cate) return undefined;
      return `/assets/img/quiz/${this.$store.state.cate}/level_${
        this.result.level + 1
      }.png`;
    },
    rankingStr() {
      if (this.$store.state.cate === 'dog') return rankingDog;
      if (this.$store.state.cate === 'cat') return rankingCat;
      return undefined;
    },
  },
  created() {
    if (this.$store.state.cate) {
      // submit result
      const score = this.$store.state[this.$store.state.cate].score;

      // db index 1 = score 0, index 8 = score 7, so score should +1
      submitResult(this.$store.state.cate, score + 1);

      // get ranking data
      getRankingByScore(this.$store.state.cate, score).then((res) => {
        if (+res.status === 200) {
          this.result = {
            level: Math.floor(score / 2) + 1,
            ranking: res.data,
          };
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
  &__content {
    display: flex;
  }

  &__standing-title {
    color: $color-primary;
  }
  &__standing-desc {

  }
  &__standing-text {

  }

  &__share {
    display: flex;
    align-items: center;
    margin: 2rem 0;
  }

  &__share-btn {
    @include reset-btn;
    border: solid 2px $color-primary;
    border-radius: 20px;
    padding: $spacing-2 $spacing-3;
    margin-right: 1rem;
  }
}
</style>
