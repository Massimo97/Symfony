function swapClass(elem, class1, class2) {
    if(elem.classList.contains(class1)){
        elem.classList.replace(class1,class2);
    }else if(elem.classList.contains(class2)){
        elem.classList.replace(class2,class1);
    }
}