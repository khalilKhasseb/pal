import "./bootstrap";
function removeFrontEndAssets() {
    const assetsTags = document.querySelectorAll('[data-layout="front"]'); 
    console.log(assetsTags);
    assetsTags.forEach(tag => tag.remove());
}

removeFrontEndAssets();