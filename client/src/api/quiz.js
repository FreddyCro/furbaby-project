import axios from 'axios';

const root = process.env.VUE_APP_API_ROOT || '';

// answer a quiz
const answerQuiz = (table, qId, correct) => {
  return axios
    .post(
      `${window.location.protocol}//${root}/api/furkid/update-quiz.php?id=${qId}&table=${table}&correct=${correct}`
    )
    .then((res) => {
      // if (process.env.NODE_ENV === 'production') return;
      if (+res.status === 200)
        console.log(`submit ${table} ${qId} successfully.`);
      else console.log(table, qId, 'fail');
    });
};

// submit result
const submitResult = (table, score) => {
  return axios
    .post(
      `${window.location.protocol}//${root}/api/furkid/update-rank.php?table=${table}&id=${score}`
    )
    .then((res) => {
      // if (process.env.NODE_ENV === 'production') return;

      if (+res.status === 200) console.log(`submit ${table} result successfully.`);
      else console.log(table, score, 'fail');
    });
};

// get ranking of all users
const getRanking = (table) => {
  return axios.get(
    `${window.location.protocol}//${root}/api/furkid/read-rank.php?table=${table}`
  );
};

// get ranking of by score
const getRankingByScore = (table, score) => {
  return axios.get(
    `${window.location.protocol}//${root}/api/furkid/read-rank-by-score.php?table=${table}&score=${score}`
  );
};

export { answerQuiz, submitResult, getRanking, getRankingByScore };
