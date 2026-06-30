/******/ (() => { // webpackBootstrap
/*!***********************************!*\
  !*** ./src/js/material-single.js ***!
  \***********************************/
const $thumbnails = document.querySelectorAll('.c-image-list__image img');
const $eyecatch = document.getElementById('material-eyecatch');
const $caption = document.getElementById('material-caption');
$thumbnails.forEach(item => {
  const url = item.dataset.url;
  const label = item.getAttribute('alt');
  item.onclick = () => {
    $eyecatch.src = url;
    $caption.innerHTML = label;
  };
});
/******/ })()
;
//# sourceMappingURL=material-single.js.map