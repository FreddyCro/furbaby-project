<template lang="pug">
.fk-result.fk-page
  .fk-container
    img(:src="finalImg", alt="final score")

    h1 {{ $store.state.user }}
    h2(v-if="rankingStr") {{ rankingStr[result.level + 1].title }}
    h3(v-if="rankingStr") {{ rankingStr[result.level + 1].desc }}
    p your level: {{ getScore() + 1 }}
    p your ranking: {{ result.ranking }}

    .fk-result__share
      fk-btn-secondary(:text="str.tryAgain")
      fk-btn-secondary(:text="str.lineToFriend")
      fk-btn-secondary(:text="str.shareResult")

    .fk-result__learn-more
      button.fk-btn-prim {{ str.furkidNews }}
      button.fk-btn-prim {{ str.furkidStrategy }}
</template>

<script>
import { mapGetters } from 'vuex';
import { submitResult, getRanking } from '@/api/quiz';

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
    rankingData: undefined,
  }),
  computed: {
    finalImg() {
      if (!this.$store.state.cate) return undefined;
      return `/assets/img/quiz/${this.$store.state.cate}/level_${this.result.level + 1}.png`;
    },
    rankingStr() {
      if (this.$store.state.cate === 'dog') return rankingDog;
      if (this.$store.state.cate === 'cat') return rankingCat;
      return undefined;
    },
  },
  created() {
    // test calc ranking
    // const testCalcRanking = () => {
    //   const a = (Math.random() * 10) | 0;
    //   const b = (Math.random() * 10) | 0;
    //   const c = (Math.random() * 10) | 0;
    //   const d = (Math.random() * 10) | 0;
    //   const e = (Math.random() * 10) | 0;
    //   const f = (Math.random() * 10) | 0;
    //   const g = (Math.random() * 10) | 0;
    //   const h = (Math.random() * 10) | 0;
    //   const participants = a + b + c + d + e + f + g + h;
    //   const scoreBoard = [a, b, c, d, e, f, g, h];
    //   const level = (Math.random() * 8) | 0;
    //   const result = this.calcRanking(participants, scoreBoard, level);
    //   return {
    //     participants,
    //     scoreBoard,
    //     level,
    //     result,
    //   };
    // };
    // console.log(testCalcRanking());

    if (this.$store.state.cate) {
      // submit result
      const score = this.$store.state[this.$store.state.cate].score;
      submitResult(this.$store.state.cate, score);

      // get ranking data
      getRanking(this.$store.state.cate)
        .then((res) => {
          if (+res.status === 200) this.rankingData = res.data.body;
          else console.log(res, 'fail');
        })
        .then(() => {
          const participants = this.rankingData.reduce(
            (acc, cur) => +acc + +cur.score,
            0
          );
          const scoreBoard = this.rankingData.map((item) => +item.score);

          this.result = this.calcRanking(+participants, scoreBoard, +score);
          console.log(this.result);
        });
    }
  },
  methods: {
    ...mapGetters({
      getScore: 'getScore',
    }),
    calcRanking(participants, scoreBoard, point) {
      // get ranking
      let acc = 0;

      for (let i = 0; i <= point; i++) {
        acc += scoreBoard[i];
      }

      const ranking = participants - acc + 1;

      // get level
      const gap = Math.ceil(scoreBoard.length / 4);
      const level = Math.floor(point / gap) + 1;

      return {
        ranking,
        level,
      };
    },
  },
};
</script>
