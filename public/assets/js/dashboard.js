const myOffcanvas = document.getElementById('sideBar');
const bsOffcanvas = new bootstrap.Offcanvas('#sideBar');

var page = document.querySelector(".main-page");
var topbar = document.querySelector(".top-menubar");
if (window.innerWidth > 600) {
    bsOffcanvas.show();
    myOffcanvas.addEventListener('hide.bs.offcanvas', event => {
        page.style.width = "100%";
        topbar.style.width = "100%";
        page.style.marginLeft = "0";
    });

    myOffcanvas.addEventListener('show.bs.offcanvas', event => {
        page.style.width = "calc(100% - 250px)";
        topbar.style.width = "calc(100% - 250px)";
        page.style.marginLeft = "250px";
    });

} else {
    bsOffcanvas.hide();
    page.style.width = "100%";
    topbar.style.width = "100%";
    page.style.marginLeft = "0";
}

window.onresize = function (event) {
    let width = event.currentTarget.innerWidth;
    if (width <= 600) {
        page.style.width = "100%";
        topbar.style.width = "100%";
        page.style.marginLeft = "0";
        bsOffcanvas.hide();
    } else if (width >= 600) {
        bsOffcanvas.show();
    }
}