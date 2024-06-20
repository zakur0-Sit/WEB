document.querySelectorAll('.heart').forEach(function(heart) {
    heart.addEventListener('click', function() {
        var shoeId = this.dataset.shoeId;
        var userId = this.dataset.userId;
        var love = this.src.endsWith('empty_heart.png') ? 1 : 0;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_rating.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('shoe_id=' + shoeId + '&user_id=' + userId + '&love=' + love);

        if (this.src.endsWith('empty_heart.png')) {
            this.src = 'img/ico/full_heart.png';
        } else {
            this.src = 'img/ico/empty_heart.png';
        }
    });
});