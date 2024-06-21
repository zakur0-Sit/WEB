document.addEventListener('DOMContentLoaded', function() {
    const ratingButtons = document.querySelectorAll('.rating-button');
    const popup = document.getElementById('rating-popup');
    const closeButton = document.querySelector('.close-button');
    const rateButtons = document.querySelectorAll('.rate-button');
    const ratingForm = document.getElementById('rating-form');
    const shoeIdInput = document.getElementById('shoe_id');
    const userIdInput = document.getElementById('user_id');
    const ratingInput = document.getElementById('rating');

    ratingButtons.forEach(button => {
        button.addEventListener('click', function() {
            const shoeId = this.getAttribute('data-shoe-id');
            const userId = this.getAttribute('data-user-id');
            shoeIdInput.value = shoeId;
            userIdInput.value = userId;
            popup.style.display = 'flex';
        });
    });

    closeButton.addEventListener('click', function() {
        popup.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === popup) {
            popup.style.display = 'none';
        }
    });

    rateButtons.forEach(button => {
        button.addEventListener('click', function() {
            const rating = this.getAttribute('data-rating');
            ratingInput.value = rating;

            const formData = new FormData(ratingForm);
            console.log([...formData]); // Log form data for debugging

            fetch('rate_product.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text()) // Use text() to see raw response
            .then(text => {
                console.log('Raw response:', text); // Log the raw response
                let data;
                try {
                    data = JSON.parse(text); // Parse the response as JSON
                } catch (e) {
                    console.error('Invalid JSON response:', text);
                    return;
                }
                if (data.success) {
                    const averageRating = data.averageRating;
                    const shoeId = shoeIdInput.value;
                    const ratingContainer = document.querySelector(`.rating-button[data-shoe-id="${shoeId}"]`).closest('.rating-container');
                    const scoreElement = ratingContainer.querySelector('.score');
                    scoreElement.textContent = `${averageRating}/10`;

                    popup.style.display = 'none';
                } else {
                    console.error('Error:', data.message);
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });
        });
    });
});
