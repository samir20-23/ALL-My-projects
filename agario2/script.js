let container = document.getElementById("container"); // the screen borders
let redball = document.getElementById("ball"); // main ball
let points = document.getElementById("score");
let containerWidth = container.clientWidth; //width of the container
let containerHeight = container.clientHeight; //height of container
let y = containerHeight / 2; //Y starting position of main ball
let x = containerWidth / 2; //X starting position of small balls
let redballHeight = redball.clientHeight; //the main ball height
let redballWidth = redball.clientWidth; //main ball width
let boundriesY = containerHeight - redballHeight; //the Y boundries
let boundriesX = containerWidth - redballWidth; // the X boundries
let score = 50;

//generating blue balls in screen
let startingpoint = 30;
let numberofballs = 40;
for (let i = -startingpoint; i < numberofballs; i++) {
  let r = Math.floor(Math.random() * 255) + 1;
  let g = Math.floor(Math.random() * 255) + 1;
  let b = Math.floor(Math.random() * 255) + 1;

  let blueball = document.createElement("div");

  let pos = 85;
  let postwo = 5;
  let x = 10;
  let v = 15;

  if (i > 30) {
    x = 100;
    v = 50;
    pos = 55;
    postwo = 20;
    blueball.id = "bigCircles" + i;
  }

  let randomposition = Math.floor(Math.random() * pos) + postwo;
  let randomposition2 = Math.floor(Math.random() * pos) + postwo;

  let randomsize = Math.floor(Math.random() * x) + v;

  blueball.classList = "balls";
  // blueball.id = "balls" + i;
  container.appendChild(blueball);
  blueball.style.left = randomposition + "%";
  blueball.style.top = randomposition2 + "%";
  blueball.style.width = randomsize + "px";
  blueball.style.height = randomsize + "px";
  blueball.style.backgroundColor = `rgb(${r},${g},${b})`;
}

let blueball = document.querySelectorAll(".balls");

//function for moving the redball
window.addEventListener("keydown", (ev) => {
  if (ev.key == "z" && y > 0) {
    y -= 5;
    redball.style.top = y + "px";
  } else if (ev.key == "s" && y < boundriesY) {
    y += 5;
    redball.style.top = y + "px";
  }

  if (ev.key == "d" && x < boundriesX) {
    x += 5;
    redball.style.left = x + "px";
  } else if (ev.key == "q" && x > 0) {
    x -= 5;
    redball.style.left = x + "px";
    // } else if (ev.key == " ") {
    //   redball.style.width = redballWidth / 2 + "px";
    //   redball.style.height = redballWidth / 2 + "px";
    //   let half = document.createElement("div");
    //   half.style.width = redballWidth / 2 + "px";
    //   half.style.height = redballWidth / 2 + "px";
    //   half.classList = "ball1";
    //   container.appendChild(half);
  }
});

var interval = setInterval(() => {
  blueball.forEach((el) => {
    let blueballWidth = el.clientWidth;

    if (blueballWidth > redballWidth) {
      el.style.zIndex = "15";
    } else {
      el.style.zIndex = "1";
    }

    //what happens when you collide with a smaller ball;
    if (checkCollision(redball, el) && blueballWidth < redballWidth) {
      points.innerHTML = +points.innerHTML + 1;
      if (points.innerHTML == startingpoint + numberofballs) {
        alert("you win!");
      }

      let blueballHeight = el.clientHeight;
      let blueballWidth = el.clientWidth;
      redball.style.width = redballWidth + blueballWidth / 4 + "px";
      redball.style.height = redballHeight + blueballHeight / 4 + "px";
      score += blueballWidth / 5;
      redball.innerHTML = Math.floor(score);
      el.style.display = "none";
      redballHeight = redball.clientHeight;
      redballWidth = redball.clientWidth;
      boundriesY = containerHeight - redballHeight;
      boundriesX = containerWidth - redballWidth;

      //what happens when you collide with a bigger ball and lose
    } else if (checkCollision(redball, el) && blueballWidth > redballWidth) {
      alert("you lose");
      redball.style.display = "none";
    }
  });

  //function to check when collision happens
  function checkCollision(ball1, ball2) {
    const rect1 = ball1.getBoundingClientRect();
    const rect2 = ball2.getBoundingClientRect();
    const rect1Radius = rect1.width / 2;
    const rect2Radius = rect2.width / 2;

    const center1 = {
      x: rect1.left + rect1Radius,
      y: rect1.top + rect1Radius,
    };

    const center2 = {
      x: rect2.left + rect2Radius,
      y: rect2.top + rect2Radius,
    };

    const distance = Math.sqrt(
      (center1.x - center2.x) ** 2 + (center1.y - center2.y) ** 2
    );

    return distance <= Math.abs(rect1Radius - rect2Radius);
  }
}, 10);
