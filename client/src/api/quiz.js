import axios from 'axios';

const root = process.env.VUE_APP_API_ROOT || '';

// answer a quiz
const answerQuiz = (table, qId, correct) => {
  return axios
    .post(
      `${window.location.protocol}//${root}/api/furkid/update-quiz.php?id=${qId}&table=${table}&correct=${correct}`
    )
    .then((res) => {
      if (+res.status === 200) console.log(table, qId, 'success');
      else console.log(table, qId, 'fail');
    });
};

// get ranking of all users
const getRanking = () => {
  return axios.get(`${root}/api/furkid/ranking`);
};

export { answerQuiz, getRanking };
