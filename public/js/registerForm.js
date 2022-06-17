let agree = document.querySelector("#user_agreeTerms");
let parent = agree.parentElement;
agree.addEventListener('change', () =>{
    swapClass(parent, "nm-convex-gray-200", "nm-convex-green-400")
})

let inputs = document.querySelectorAll("#form>div:not(:last-child)>input");
console.log(inputs);