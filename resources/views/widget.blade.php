<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Віджет підтримки</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        padding: 15px;
    }

    textarea {
        resize: none;
        height: 120px;
    }

    .form-label {
        margin-bottom: 0.2rem;
    }
    </style>
</head>

<body>
    <div id="success-msg" class="alert alert-success d-none shadow-sm fade-in">
        <strong>Готово!</strong> Заявку <span id="res-id"></span> створено.
    </div>
    <div id="error-msg" class="alert alert-danger d-none shadow-sm"></div>
    <form id="ticketForm" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Ім'я</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Ваше ім'я">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-bold">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="your@email.com">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label fw-bold">Телефон</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="+380XXXXXXXXX">
        </div>

        <div class="mb-3">
            <label for="subject" class="form-label fw-bold">Тема</label>
            <input type="text" class="form-control" id="subject" name="subject" placeholder="Коротко про ваше питання">
        </div>

        <div class="mb-3">
            <label for="message" class="form-label fw-bold">Повідомлення</label>
            <textarea class="form-control" id="message" name="message"
                placeholder="Опишіть ваше питання детальніше"></textarea>
        </div>

        <div class="mb-4">
            <label for="attachment" class="form-label fw-bold">Прикріпити файл (скріншот)</label>
            <input type="file" class="form-control" id="attachment" name="attachment">
            <div class="form-text text-muted">Макс. розмір: 2МБ (jpg, png, pdf)</div>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">Відправити заявку</button>
        </div>
    </form>

    <script>
    document.getElementById('ticketForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;
        const btn = document.getElementById('submitBtn');
        const successBox = document.getElementById('success-msg');
        const errorBox = document.getElementById('error-msg');

        btn.disabled = true;
        btn.innerText = 'Надсилаємо...';
        errorBox.classList.add('d-none');

        fetch('/api/tickets', {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) return response.json().then(err => {
                    throw err;
                });
                return response.json();
            })
            .then(result => {
                if (result.data) {
                    form.classList.add('d-none');
                    document.getElementById('res-id').innerText = '#' + result.data.id;
                    successBox.classList.remove('d-none');
                }
            })
            .catch(err => {
                console.error(err);
                errorBox.innerText = 'Помилка! Перевірте заповнення полів.';
                errorBox.classList.remove('d-none');
                btn.disabled = false;
                btn.innerText = 'Відправити заявку';
            });
    });
    </script>
</body>

</html>