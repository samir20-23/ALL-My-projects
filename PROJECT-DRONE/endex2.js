let allData={}
let simBtn=document.getElementById("sim-btn")
let btn1=document.getElementById("btn1")
let simulateur = document.getElementById("simulateur")
 btn1.addEventListener("click",function(){
    console.log(window.scroll(10,860))
 })


simBtn.addEventListener("click", () => {
    console.log(window.scroll(10,1150))
  const p=+document.getElementById("poind").value
  const x=+document.getElementById("x").value
  const y=+document.getElementById("y").value
  const z=+document.getElementById("z").value
  const d=+document.getElementById("d").value
  const sp=document.getElementById("s-p")
  const ep=document.getElementById("e-p")
  const vos=document.getElementById("vos")
  let re=[...calc(p, x, y, z, d)]
  sp.innerHTML=re[0]
  ep.innerHTML=re[1]
  console.log(calc(p, x, y, z, d))
  vos.style.display="block"


})


function calc(p, x,y,z,d) {
  let s=allData.standard.base+(allData.standard.poids*p)+(x+y+z)*allData.standard.dimension+d
  let e=allData.express.base+(allData.express.poids*p)+(x+y+z)*allData.express.dimension+d
  return [s,e]
}










async function fetchData() {
  const dataJson=await fetch("./dropdrone.json")
  const data=await dataJson.json() 
  allData={...data.tarifs}
  console.log(allData)
}

fetchData()