let container = document.getElementById("container"); // the screen borders
let redball = document.getElementById("ball"); // main ball
let containerWidth = container.clientWidth; //width of the container
let containerHeight = container.clientHeight; //height of container
let y = containerHeight / 2; //Y starting position of main ball
let x = containerWidth / 2; //X starting position of small balls
let redballHeight = redball.clientHeight; //the main ball height
let redballWidth = redball.clientWidth; //main ball width
let boundriesY = containerHeight - redballHeight; //the Y boundries
let boundriesX = containerWidth - redballWidth; // the X boundries
let score = 50;
//html
document.write(`
<div id="allbtn">
<P id="p">YOU WERE EATEN!</P>
<button id="btn">RETRY</button>
</div>
<audio id="kill" src="pop-39222_mp3cut.net.mp3"></audio>
<audio id="over" src="mixkit-fairytale-game-over-1945.wav"></audio>
<audio id="swish" src="whoosh-6316.mp3"></audio>
`)
//Element html
let p = document.getElementById("p")

//CSS
allbtn.setAttribute("style", " width: 700px;height: 500px;background: rgba(255, 0, 255, 0.385);position: absolute;z-index:20;display: flex;justify-content: center;flex-direction: column;align-items: center;border-radius: 2%;display: none;animation: moveover 2s ;")
btn.setAttribute("style"," color: aliceblue; font-size: 22px; width: 200px; height: 100px; background: red; border: none; border-radius: 2% ; box-shadow: 0px 0px 2px 2px red;")

//paragraph
p.setAttribute("style","text-shadow: 1px 1px 2px black;color: aliceblue;font-size: 50px;margin-bottom: 122px;")

//hover
btn.addEventListener("mouseover", function() {
  btn.style.width = "205px";
  btn.style.height = "105px";
  btn.style.boxShadow = "1px 1px 12px red";
});

btn.addEventListener("mouseout", function() {
  btn.style.width = "200px"; 
  btn.style.height = "100px";
  btn.style.boxShadow = "0px 0px 2px 2px red"
});



//generating blue balls in screen
for (let i = 0; i < 40; i++) {
  let pos = 80;
  let postwo = 10;
  let x = 10;
  let v = 15;
  if (i > 30) {
    x = 100;
    v = 50;
    pos = 55;
    postwo = 20;
  }

  let r = Math.floor(Math.random() * 255) + 1;
  let g = Math.floor(Math.random() * 255) + 1;
  let b = Math.floor(Math.random() * 255) + 1;

  let randomposition = Math.floor(Math.random() * pos) + postwo;
  let randomposition2 = Math.floor(Math.random() * pos) + postwo;

  let randomsize = Math.floor(Math.random() * x) + v;

  let blueball = document.createElement("div");
  blueball.classList = "balls";
  blueball.id = "balls" + i;
  container.appendChild(blueball);
  blueball.style.left = randomposition + "%";
  blueball.style.top = randomposition2 + "%";
  blueball.style.width = randomsize + "px";
  blueball.style.height = randomsize + "px";
  blueball.style.backgroundColor = `rgb(${r},${g},${b})`;
}

let blueball = document.querySelectorAll(".balls");

//function for moving the redball
let swish=document.getElementById("swish")
window.addEventListener("keydown", (ev) => {
  if (ev.key == "ArrowUp" && y > 0) {
    y -= 5;
    

 
    redball.style.top = y + "px";
  }
  
  
  else if (ev.key == "ArrowDown" && y < boundriesY) {
    y += 5;
    redball.style.top = y + "px";
  }

  if (ev.key == "ArrowRight" && x < boundriesX) {
    x += 5;
    redball.style.left = x + "px";
  }
  
  else if (ev.key == "ArrowLeft" && x > 0) {
    x -= 5;
    redball.style.left = x + "px";
  }
   else if (ev.key == " ") {
    redball.style.width = redballWidth / 2 + "px";
    redball.style.height = redballWidth / 2 + "px";
    let half = document.createElement("div");
    half.style.width = redballWidth / 2 + "px";
    half.style.height = redballWidth / 2 + "px";
    half.classList = "ball1";
    container.appendChild(half);
  }

  blueball.forEach((el) => {
    let blueballWidth = el.clientWidth;

    if (blueballWidth > redballWidth) {
      el.style.zIndex = "15";
    } else {
      el.style.zIndex = "1";
    }

    //what happens when the balls collide with eachother
    let kill = document.getElementById("kill");
    if (checkCollision(redball, el) && blueballWidth < redballWidth) {
      redball.style.boxShadow = "1px 1px 22px red";
      kill.play()
      setTimeout(function () {
        redball.style.boxShadow = "none";
      }, 100);
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
    } else if (checkCollision(redball, el) && blueballWidth > redballWidth) {
      redball.style.display = "none";
      let over = document.getElementById("over");

      over.play();
      let allbtn = document.getElementById("allbtn");
      allbtn.style.display = "flex";
      let btn = document.getElementById("btn");
      btn.addEventListener("click", function () {
        swish.play()
         setTimeout(() => {
          location.reload();
        }, 500);
       
      });
    }
  });
});

//function to check when collision happens

function checkCollision(ball1, ball2) {
  const rect1 = ball1.getBoundingClientRect();
  const rect2 = ball2.getBoundingClientRect();

  // Adjusting values to exclude borders and padding
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



//  samir

