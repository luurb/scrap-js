import * as Sort from './modules/sorting/sorting-init.mjs';
import { printNewTableBody } from './modules/fetch/print-games.mjs';

let carets = document.querySelectorAll('.filters__caret');
let select = document.querySelector('.filters__select');

carets.forEach((caret) => {
  caret.addEventListener('click', () => {
    let columnNum = Sort.getColumnNum();
    if (columnNum) {
      carets.forEach((clickedCaret) => {
        clickedCaret.classList.remove('sorted');
      });
      caret.classList.add('sorted');
      Sort.setSortDirection(caret);

      Sort.initSort().then((gamesArr) => printNewTableBody(gamesArr));
    }
  });
});

select.addEventListener('change', () => {
  carets.forEach((caret) => {
    if (caret.classList.contains('sorted')) {
      Sort.initSort().then((gamesArr) => printNewTableBody(gamesArr));
    }
  });
});
