function bdchange() {
  a = document.getElementById("listdiv").offsetWidth;
  b = document.getElementById("listdiv").offsetHeight;
  console.log(a);
  console.log(b);
  document
    .getElementById("bgdiv")
    .setAttribute(
      "style",
      "position:absolute;background:black;opacity:0.3;height:" +
        b +
        "px;width:" +
        a +
        "px;z-index:-200"
    );
}

function htmlload() {
  // fi="/?/wl/bg.jpg";
  // document.getElementById("mainbody").setAttribute("style","background-image:url("+fi+")");
}
