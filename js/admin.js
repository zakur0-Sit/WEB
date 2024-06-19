document.getElementById('add-button').addEventListener('click', function() {
    hideAllContent();
    document.getElementById('add').style.display = 'block';
});

document.getElementById('delete-button').addEventListener('click', function() {
    hideAllContent();
    document.getElementById('delete').style.display = 'block';
});

document.getElementById('import-button').addEventListener('click', function() {
    hideAllContent();
    document.getElementById('import').style.display = 'block';
});

document.getElementById('export-button').addEventListener('click', function() {
    hideAllContent();
    document.getElementById('export').style.display = 'block';
});

function hideAllContent() {
    let contentDivs = document.getElementsByClassName('content');
    for (let i = 0; i < contentDivs.length; i++) {
        contentDivs[i].style.display = 'none';
    }
}