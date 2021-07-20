// Da wir sowieso nur mit globalen Variablen arbeiten, habe ich diese nicht extra noch als Parameter übergeben.
// 🐍
// HIGHSCORE: 70 Punkte

var canvas = /** @type {HTMLCanvasElement} */ (
  document.querySelector("#canvas")
);
var ctx = canvas.getContext("2d");

// Koordinaten
var snake = [
  { x: 3, y: 2 },
  { x: 4, y: 2 },
  { x: 5, y: 2 },
];
var fruit = { x: 5, y: 5 };
var currentDirection = { x: -1, y: 0 };

var points = 0;

// Richtungen
const left = { x: -1, y: 0 };
const right = { x: 1, y: 0 };
const up = { x: 0, y: -1 };
const down = { x: 0, y: 1 };

// Zeichenfunktionen
function drawFruit() {
  ctx.lineWidth = 2;
  ctx.strokeStyle = "#D3D3D3";
  ctx.fillStyle = "#538700";
  ctx.fillRect(20 * fruit.x, 20 * fruit.y, 20, 20);
  ctx.strokeRect(20 * fruit.x, 20 * fruit.y, 20, 20);
}

function drawSnake() {
  ctx.lineWidth = 2;
  ctx.strokeStyle = "#D3D3D3";
  ctx.fillStyle = "#000000";
  snake.map((it) => {
    ctx.fillRect(20 * it.x, 20 * it.y, 20, 20);
    ctx.strokeRect(20 * it.x, 20 * it.y, 20, 20);
    ctx.fillStyle = "#00538E";
  });
}

function drawGameOver() {
  ctx.font = "50px Arial";
  ctx.fillStyle = "white";
  ctx.textAlign = "center";
  ctx.fillText("Game over!", canvas.width / 2, canvas.height / 2 - 15);
  ctx.font = "25px Arial";
  ctx.fillText(`${points} Punkte`, canvas.width / 2, canvas.height / 2 + 15);
}

// Logik
function fruitCollidesWithSnake() {
  // Nur der Schlangenkopf kann mit der Frucht kollidieren
  return snake[0].x == fruit.x && snake[0].y == fruit.y;
}

function randomCoordinatesOutsideSnake() {
  var randomX;
  var randomY;
  do {
    randomX = Math.floor(Math.random() * 20);
    randomY = Math.floor(Math.random() * 20);
  } while (snake.some((it) => it.x == randomX && it.y == randomY));
  return { x: randomX, y: randomY };
}

function snakeHeadCollidesWithSnake() {
  return snake.slice(1).some((it) => it.x == snake[0].x && it.y == snake[0].y);
}

function moveSnake() {
  var newHead = {
    x: mod(snake[0].x + currentDirection.x, 20),
    y: mod(snake[0].y + currentDirection.y, 20),
  };
  snake.unshift(newHead);

  return snake.pop();
}

function mod(n, m) {
  return ((n % m) + m) % m;
}

// 🐍
var intervalID = setInterval(function () {
  var tail = moveSnake();
  if (fruitCollidesWithSnake()) {
    snake.push(tail);
    fruit = randomCoordinatesOutsideSnake();
  }

  ctx.clearRect(0, 0, 400, 400);
  drawFruit();
  drawSnake();

  if (snakeHeadCollidesWithSnake()) {
    points = snake.length - 3;
    drawGameOver();
    clearInterval(intervalID);
  }
}, 150);

document.body.addEventListener("keydown", function (event) {
  switch (event.key) {
    case "ArrowLeft":
      if (currentDirection.x == 0) {
        currentDirection = left;
      }
      break;
    case "ArrowRight":
      if (currentDirection.x == 0) {
        currentDirection = right;
      }
      break;
    case "ArrowUp":
      if (currentDirection.y == 0) {
        currentDirection = up;
      }
      break;
    case "ArrowDown":
      if (currentDirection.y == 0) {
        currentDirection = down;
      }
      break;
    default:
      break;
  }
});
