const articles = document.getElementById('articles');

if (articles) {
    articles.addEventListener('click', (e) => {
        alert(2);
        if (e.target.className === 'btn btn-danger delete-article') {
            alert(2);
            if (confirm('es tu sure?')) {
                const id = e.target.getAttribute('data-id');
                alert('id');
                fetch('/article/delete/${id}', {
                    method: 'DELETE'
                }).then(res => window.location.reload())
            }
        }
        }
    )
}