<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Furkid Admin</title>
</head>

<body>
  <h1>Furkid Admin</h1>
  <h2>Quiz-Dog</h2>

  <div class="scroe">
    <p>
      <span>question-1</span>
      <span id="dq-1">-</span>
    </p>
    <button class="vote-btn" id="dq1-vote-btn" value="1" table="dog">click</button>
    <p>
      <span>question-2</span>
      <span id="dq-2">-</span>
    </p>
    <button class="vote-btn" id="dq2-vote-btn" value="2" table="dog">click</button>
    <p>
      <span>question-3</span>
      <span id="dq-3">-</span>
    </p>
    <button class="vote-btn" id="dq3-vote-btn" value="3" table="dog">click</button>

    <h2>Quiz-Cat</h2>
    <p>
      <span>question-1</span>
      <span id="cq-1">-</span>
    </p>
    <button class="vote-btn" id="cq1-vote-btn" value="1" table="cat">click</button>
    <p>
      <span>question-2</span>
      <span id="cq-2">-</span>
    </p>
    <button class="vote-btn" id="cq2-vote-btn" value="2" table="cat">click</button>
    <p>
      <span>question-3</span>
      <span id="cq-3">-</span>
    </p>
    <button class="vote-btn" id="cq3-vote-btn" value="3" table="cat">click</button>
  </div>
  <div class="rank">
    <h2>Rank-Dog</h2>
    <p>
      <span>question-1</span>
      <span id="dq-1-rank">-</span>
    </p>
    <button class="rank-btn" id="dq1-rank-btn" value="1" table="dog">click</button>
    <p>
      <span>question-2</span>
      <span id="dq-2-rank">-</span>
    </p>
    <button class="rank-btn" id="dq2-rank-btn" value="2" table="dog">click</button>
    <p>
      <span>question-3</span>
      <span id="dq-3-rank">-</span>
    </p>
    <button class="rank-btn" id="dq3-rank-btn" value="3" table="dog">click</button>

    <h2>Rank-Cat</h2>
    <p>
      <span>question-1</span>
      <span id="cq-1-rank">-</span>
    </p>
    <button class="rank-btn" id="cq1-rank-btn" value="1" table="cat">click</button>

    <p>
      <span>question-2</span>
      <span id="cq-2-rank">-</span>
    </p>
    <button class="rank-btn" id="cq2-rank-btn" value="2" table="cat">click</button>

    <p>
      <span>question-3</span>
      <span id="cq-3-rank">-</span>
    </p>
    <button class="rank-btn" id="cq3-rank-btn" value="3" table="cat">click</button>
  </div>
</body>

<?php
include_once './config/database.php';

$database = new Database();
$HOST = $database->host;
?>

<script>
  const HOST = `http://${'<?php echo $HOST; ?>'}:8088`;

  // fetch data from api
  function getQuizData() {
    fetch(`${HOST}/api/furkid/read-quiz.php?table=dog`)
      .then(res => res.json())
      .then(data => {
        console.log(data);
        for (let i = 0; i < 3; i++) {
          document.getElementById(`dq-${i+1}`).innerHTML = data.body[i].participants;
        };
      });

    fetch(`${HOST}/api/furkid/read-quiz.php?table=cat`)
      .then(res => res.json())
      .then(data => {
        console.log(data);
        for (let i = 0; i < 3; i++) {
          document.getElementById(`cq-${i+1}`).innerHTML = data.body[i].participants;
        };
      });
  }

  // vote quiz
  function voteQuiz(id, table) {
    fetch(`${HOST}/api/furkid/update-quiz.php?id=${id}&table=${table}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
      })
      .then(res => {
        if (res.status === 200) {
          const el = table === 'dog' ? 'dq' : 'cq';

          const currentValue = document.getElementById(`${el}-${id}`).innerHTML
          document.getElementById(`${el}-${id}`).innerHTML = +currentValue + 1;
        }
      });
  }

  function assignVoteBtnEvent() {
    const btns = document.querySelectorAll('.vote-btn');

    [...btns].forEach(btn => {
      btn.addEventListener('click', function(e) {
        const btn = e.target;
        const table = btn.getAttribute('table');
        const value = btn.getAttribute('value');

        voteQuiz(value, table);
      });
    });
  }

  function assignRankBtnEvent() {
    const btns = document.querySelectorAll('.rank-btn');

    [...btns].forEach(btn => {
      btn.addEventListener('click', function(e) {
        const btn = e.target;
        const table = btn.getAttribute('table');
        const value = btn.getAttribute('value');

        fetch(`${HOST}/api/furkid/update-rank.php?id=${value}&table=${table}`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            }
          })
          .then(res => res.json())
          .then(data => {
            const el = table === 'dog' ? 'dq' : 'cq';
            const currentValue = document.getElementById(`${el}-${value}-rank`).innerHTML
            document.getElementById(`${el}-${value}-rank`).innerHTML = +currentValue + 1;
          });
      });
    });
  }

  function getRankData() {
    fetch(`${HOST}/api/furkid/read-rank.php?table=dog`)
      .then(res => res.json())
      .then(data => {
        console.log(data);
        for (let i = 0; i < 3; i++) {
          document.getElementById(`dq-${i+1}-rank`).innerHTML = data.body[i].score;
        };
      });

    fetch(`${HOST}/api/furkid/read-rank.php?table=cat`)
      .then(res => res.json())
      .then(data => {
        console.log(data);
        for (let i = 0; i < 3; i++) {
          document.getElementById(`cq-${i+1}-rank`).innerHTML = data.body[i].score;
        };
      });
  }

  function initTable() {
    fetch(`${HOST}/init-table.php`)
      .then((res) => {
        if (res.status === 200) {
          console.log('Inititalize table success.');
        } else {
          console.log('Inititalize table failed.');
        }
      });
  }

  initTable();
  getQuizData();
  getRankData();
  assignVoteBtnEvent();
  assignRankBtnEvent();
</script>

</html>