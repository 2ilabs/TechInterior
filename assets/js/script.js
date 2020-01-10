var gradient = document.querySelector(".fullbanner");

function onMouseMove(event) {
    gradient.style.backgroundImage = 'radial-gradient(at ' + event.clientX + 'px ' + event.clientY + 'px, rgba(0, 18, 78, 0.4) 0, rgb(0, 0, 0, 0.6) 70%), url("assets/img/banner.jpg")';
}
document.addEventListener("mousemove", onMouseMove);