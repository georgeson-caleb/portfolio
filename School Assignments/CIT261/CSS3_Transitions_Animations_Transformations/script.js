function startTransition1(element) {
   element.style.width  = "80px";
   element.style.height = "80px";
   element.style.backgroundColor = "#fec3a3"
}

function endTransition(element) {
   element.style.width = "40px";
   element.style.height = "40px";
   element.style.backgroundColor = "#e0ec6d"
}

function startAnimation(element, animation) {
   element.classList = animation;
}

function endAnimation(element) {
   element.classList = "";
}
