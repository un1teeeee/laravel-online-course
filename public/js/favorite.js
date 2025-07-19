document.addEventListener('DOMContentLoaded', function() {
    const favoriteButtons = document.querySelectorAll('.course__action-favorite');

    favoriteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            const courseId = this.dataset.courseId;
            let isFavorite = this.dataset.isFavorite === 'true';

            const form = event.target.closest('form');
            const url = form.action;

            const method = 'POST';

            fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    isFavorite: isFavorite
                })
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        isFavorite = !isFavorite;
                        this.dataset.isFavorite = isFavorite ? 'true' : 'false';

                        const heartPath = this.querySelector('.heart-path');
                        heartPath.setAttribute('stroke', isFavorite ? 'red' : '#acacac');
                        heartPath.setAttribute('fill', isFavorite ? 'red' : 'none');
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                    alert('Произошла ошибка. Пожалуйста, попробуйте позже.');
                });
        });
    });
});
