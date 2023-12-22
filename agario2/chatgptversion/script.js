let canvas = document.getElementById("gameCanvas");
let ctx = canvas.getContext("2d");

let containerWidth = canvas.width;
let containerHeight = canvas.height;
let y = containerHeight / 2;
let x = containerWidth / 2;
let redballRadius = 25;
let boundriesY = containerHeight - redballRadius;
let boundriesX = containerWidth - redballRadius;
let score = 50;
let blueballs = [];

// Generate blue balls on the canvas
for (let i = 0; i < 20; i++) {
  let randomX = Math.floor(Math.random() * (containerWidth - 30)) + 15;
  let randomY = Math.floor(Math.random() * (containerHeight - 30)) + 15;
  let randomSize = Math.floor(Math.random() * 15) + 15;

  blueballs.push({ x: randomX, y: randomY, size: randomSize });
}

// Function for moving the redball
window.addEventListener("keydown", (ev) => {
  if (ev.key == "ArrowUp" && y > 0) {
    y -= 5;
  } else if (ev.key == "ArrowDown" ) {
    y += 5;
  }

  if (ev.key == "ArrowRight") {
    x += 5;
  } else if (ev.key == "ArrowLeft" && x > 0) {
    x -= 5;
  }

  // What happens when the balls collide with each other
  for (let i = 0; i < blueballs.length; i++) {
    let blueball = blueballs[i];
    let distance = Math.sqrt((x - blueball.x) ** 2 + (y - blueball.y) ** 2);
    let combinedRadius = redballRadius + blueball.size;

    // Check if the red ball completely covers the blue ball
    if (distance < Math.abs(redballRadius - blueball.size)) {
      if (blueball.size < redballRadius) {
        // Collision with smaller blue balls
        score += blueball.size;
        redballRadius += blueball.size / 2;
        boundriesY = containerHeight - redballRadius;
        boundriesX = containerWidth - redballRadius;
        blueballs.splice(i, 1);
        i--;
      } else {
        // Collision with larger blue balls
        alert("you lost!");
        document.location.reload();
      }
    }
  }

  ctx.clearRect(0, 0, containerWidth, containerHeight);
  drawBlueBalls(blueballs);
  drawRedBall(x, y, redballRadius, score);
});

// Function to draw the red ball on the canvas
function drawRedBall(x, y, radius, score) {
  ctx.beginPath();
  ctx.arc(x, y, radius, 0, 2 * Math.PI);
  ctx.fillStyle = "red";
  ctx.fill();
  ctx.strokeStyle = "white";
  ctx.lineWidth = 2;
  ctx.strokeText(score.toString(), x - 10, y + 5);
  ctx.closePath();
}

// Function to draw the blue balls on the canvas
function drawBlueBalls(blueballs) {
  for (let i = 0; i < blueballs.length; i++) {
    let blueball = blueballs[i];
    ctx.beginPath();
    ctx.arc(blueball.x, blueball.y, blueball.size, 0, 2 * Math.PI);
    ctx.fillStyle = "blue";
    ctx.fill();
    ctx.strokeStyle = "white";
    ctx.lineWidth = 2;
    ctx.strokeText(blueball.size.toString(), blueball.x - 5, blueball.y + 5);
    ctx.closePath();
  }
}

// Initial rendering of the red ball and blue balls
drawBlueBalls(blueballs);
drawRedBall(x, y, redballRadius, score);
