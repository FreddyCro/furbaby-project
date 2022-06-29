import axios from 'axios';

const root = process.env.VUE_APP_API_URL || '';

// answer a question
const answerQuestion = (questionId, answerId) => {
  return axios.post(`${root}/api/furkid/qestion/${questionId}`, { answerId });
};

// get ranking of all users
const getRanking = () => {
  return axios.get(`${root}/api/furkid/ranking`);
};

export { answerQuestion, getRanking };
