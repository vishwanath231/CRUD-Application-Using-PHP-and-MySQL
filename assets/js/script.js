
// when you click close icon and hidden msg

document.addEventListener("click",function(){
    document.getElementById("closeMsg").style.display = "none";
})

function showTime(){
    setTimeout(() => {
        document.getElementById("closeMsg").style.display = "none";
    }, 15000);
}
showTime();




