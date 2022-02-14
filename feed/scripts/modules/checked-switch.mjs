function checkboxSwitch(e) {
    if (e.target.tagName == 'INPUT') {
        let parent = e.target.parentNode.parentNode;
        let checkbox = parent.querySelectorAll('input');
        for (let i = 0; i < checkbox.length; i++) {
            let box = checkbox[i];
            if (box !== e.target && box.checked) {  
                box.checked = (box.checked) ? false : true;
            }
        }
    }
}

export {checkboxSwitch};