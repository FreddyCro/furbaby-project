<template lang="pug">
.fk-result.fk-page
  .fk-container
    img(:src="finalImg", alt="final score")

    h1 {{ $store.state.user }}
    h2(v-if="rankingStr") {{ rankingStr[result.level + 1].title }}
    h3(v-if="rankingStr") {{ rankingStr[result.level + 1].desc }}
    p your level: {{ result.level }}
    p your ranking: {{ result.ranking }}

    .fk-result__share
      fk-btn-secondary(:text="str.tryAgain")
      fk-btn-secondary(:text="str.lineToFriend")
      a(:href="sharingUrl")
        fk-btn-secondary(:text="str.shareResult")

    .fk-result__learn-more
      button.fk-btn-prim {{ str.furkidNews }}
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
