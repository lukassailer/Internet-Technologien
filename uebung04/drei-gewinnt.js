let board = document.getElementById("board");
let info = document.getElementById("info");

let currentPlayer = "x";
let round = 0;
let gameOver = false;

board.addEventListener("click", onBoardClick);

function onBoardClick(event) {
  var element = event.target;
  if (element.innerHTML == "") {
    element.innerHTML = currentPlayer;
    round++;

    evaluateWinner();
    if (!gameOver) switchPlayer();
  }
}

function switchPlayer() {
  currentPlayer == "x" ? (currentPlayer = "o") : (currentPlayer = "x");
  showInfo(currentPlayer + " ist am Zug");
}

function showInfo(text) {
  info.innerHTML = text;
}

function evaluateWinner() {
  // get current Board state
  var items = [
    ["", "", ""],
    ["", "", ""],
    ["", "", ""],
  ];

  row = board.rows;
  for (var i = 0; i < row.length; i++) {
    for (var j = 0; j < row[i].cells.length; j++) {
      items[i][j] = row[i].cells[j].innerHTML;
    }
  }

  // draw
  if (round >= 9) draw();

  // evaluate Board :(
  if (areEqual(items[0][0], items[0][1], items[0][2], currentPlayer)) win();
  if (areEqual(items[1][0], items[1][1], items[1][2], currentPlayer)) win();
  if (areEqual(items[2][0], items[2][1], items[2][2], currentPlayer)) win();

  if (areEqual(items[0][0], items[1][0], items[2][0], currentPlayer)) win();
  if (areEqual(items[0][1], items[1][1], items[2][1], currentPlayer)) win();
  if (areEqual(items[0][2], items[1][2], items[2][2], currentPlayer)) win();

  if (areEqual(items[0][0], items[1][1], items[2][2], currentPlayer)) win();
  if (areEqual(items[0][2], items[1][1], items[2][0], currentPlayer)) win();
}

function win() {
  showInfo(currentPlayer + " gewinnt");
  gameOver = true;
  board.removeEventListener("click", onBoardClick);
}

function draw() {
  showInfo("niemand gewinnt 😔");
  gameOver = true;
  board.removeEventListener("click", onBoardClick);
}

// compare more than 2 values https://stackoverflow.com/questions/9973323/javascript-compare-3-values
function areEqual() {
  var len = arguments.length;
  for (var i = 1; i < len; i++) {
    if (arguments[i] === null || arguments[i] !== arguments[i - 1])
      return false;
  }
  return true;
}
