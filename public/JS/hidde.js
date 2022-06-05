let hiddenTexts = document.getElementsByClassName("ToHidde");

for(let description of hiddenTexts) {
    description.style.display="none";
}

function displayContent($id) {
    let content = document.getElementById($id);
    if (content.style.display==="none"){
        content.style.display="flex";
    }
    else {
        content.style.display="none";
    }
}