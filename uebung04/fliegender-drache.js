const canvas = document.getElementById("canvas");
const ctx = canvas.getContext("2d");

const bg = document.getElementById("bg");
const dragon = document.getElementById("dragon");

const canvasWidth = canvas.clientWidth;
const canvasHeight = canvas.clientHeight;

let t = 0; // Animationszeit

mainDrawLoop();

function mainDrawLoop() {
  ctx.clearRect(0, 0, canvasWidth, canvasHeight);

  t++;
  drawBackground();
  drawDragon();

  requestAnimationFrame(mainDrawLoop);
}

function drawBackground() {
  let x = -t % canvasWidth;
  let xOffset = x + canvasWidth;

  ctx.drawImage(bg, x, 0, canvasWidth, canvasHeight);
  ctx.drawImage(bg, xOffset, 0, canvasWidth, canvasHeight);
}

function drawDragon() {
  let width = 169;
  let height = 200;

  let x = (canvasWidth - width) / 3;
  let y = (canvasHeight - height / 2) / 2 + 80 * Math.sin(t / 100);

  ctx.drawImage(dragon, x, y, width, height);
}
