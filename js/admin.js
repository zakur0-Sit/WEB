document.getElementById('add-button').addEventListener('click', function() {
    hideAllContent();
    document.getElementById('add').style.display = 'block';
    document.getElementById('hide').style.height = '650px';
});

document.getElementById('delete-button').addEventListener('click', function() {
    hideAllContent();
    document.getElementById('delete').style.display = 'block';
    document.getElementById('hide').style.height = '300px';
});

document.getElementById('import-button').addEventListener('click', function() {
    hideAllContent();
    document.getElementById('import').style.display = 'block';
    document.getElementById('hide').style.height = '300px';
});

document.getElementById('export-button').addEventListener('click', function() {
    hideAllContent();
    document.getElementById('export').style.display = 'block';
    document.getElementById('hide').style.height = '300px';
});

function hideAllContent() {
    let contentDivs = document.getElementsByClassName('content');
    for (let i = 0; i < contentDivs.length; i++) {
        contentDivs[i].style.display = 'none';
    }
}