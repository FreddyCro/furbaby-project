<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <?php
  $link = $_SERVER['PHP_SELF'];
  $link_array = explode('/',$link);
  ?>

  <title><?php echo end($link_array) ?> | Furkid Admin</title>
</head>

<body>
  <h1>Furkid Admin</h1>

  <div class="scroe">
    <h2>Quiz-Dog</h2>
    <?php
    for ($x = 1; $x <= 7; $x++) {
      echo '<p>';
      echo '  <span>question-' . $x . '</span>';
      echo '  <span id="dq-' . $x . '">-</span>';
      echo '</p>';
      echo '<button class="vote-btn" id="dq' . $x . '-vote-btn" value="' . $x . '" table="dog">click</button>';
    }
    ?>

    <h2>Quiz-Cat</h2>
    <?php
    for ($x = 1; $x <= 7; $x++) {
      echo '<p>';
      echo '  <span>question-' . $x . '</span>';
      echo '  <span id="cq-' . $x . '">-</span>';
      echo '</p>';
      echo '<button class="vote-btn" id="cq' . $x . '-vote-btn" value="' . $x . '" table="cat">click</button>';
    }
    ?>
  </div>
  <div class="rank">
    <h2>Rank-Dog</h2>
    <?php
    for ($x = 0; $x <= 7; $x++) {
      echo '<p>';
      echo '  <span>question-' . $x . '</span>';
      echo '  <span id="dq-' . $x . '-rank">-</span>';
      echo '</p>';
      echo '<button class="rank-btn" id="dq' . $x . '-rank-btn" value="' . $x . '" table="dog">click</button>';
    }
    ?>

    <h2>Rank-Cat</h2>
    <?php
    for ($x = 0; $x <= 7; $x++) {
      echo '<p>';
      echo '  <span>question-' . $x . '</span>';
      echo '  <span id="cq-' . $x . '-rank">-</span>';
      echo '</p>';
      echo '<button class="rank-btn" id="cq' . $x . '-rank-btn" value="' . $x . '" table="cat">click</button>';
    }
    ?>
  </div>
</body>

<script>
  const HOST = `http://192.168.1.100:8080`;

  // fetch data from api
  function getQuizData() {
    fetch(`${HOST}/api/furkid/read-quiz.php?table=dog`)
      .then(res => res.json())
      .then(data => {
        console.log('dog', 'quiz', data);
        for (let i = 0; i < 7; i++) {
          document.getElementById(`dq-${i+1}`).innerHTML = data.body[i].participants;
        };
      });

    fetch(`${HOST}/api/furkid/read-quiz.php?table=cat`)
      .then(res => res.json())
      .then(data => {
        console.log('cat', 'quiz', data);
        for (let i = 0; i < 7; i++) {
          document.getElementById(`cq-${i+1}`).innerHTML = data.body[i].participants;
        };
      });
  }

  // vote quiz
  function voteQuiz(id, table) {
    fetch(`${HOST}/api/furkid/update-quiz.php?id=${id}&table=${table}&correct=1`, {
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
        console.log('dog', 'rank', data);
        for (let i = 0; i <= 7; i++) {
          document.getElementById(`dq-${i}-rank`).innerHTML = data.body[i].score;
        };
      });

    fetch(`${HOST}/api/furkid/read-rank.php?table=cat`)
      .then(res => res.json())
      .then(data => {
        console.log('cat', 'rank', data);
        for (let i = 0; i <= 7; i++) {
          document.getElementById(`cq-${i}-rank`).innerHTML = data.body[i].score;
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