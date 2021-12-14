const filter = document.querySelector('.stat-filter i');
let state = 0;
filter.addEventListener('click', function() {
    if (state == 0) {
        filter.style.transform = 'rotate(180deg) translateZ(0)';
        state = 1;
    } else {
        filter.style.transform = 'rotate(0deg) translateZ(0)';
        state = 0;
    }
});
