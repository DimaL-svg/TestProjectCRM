<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Тестова сторінка клієнта</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <header class="bg-dark text-white py-4 mb-4 shadow">
        <div class='container'>
          <h1 style="color: white; font-weight: bold; font-size: 1.5rem;">Test project</h1>
        </div>
    </header>

    <section class="container text-center py-5">
        <h1>Вітаємо</h1>
        <p class="lead text-muted">Ця сторінка демонструє, як мій віджет підтримки інтегрується в будь-який інтерфейс.</p>
        <div>
            Натисніть на синю кнопку в кутку, щоб відкрити форму підтримки.
        </div>
    </section>

    <button type="button" class="btn btn-primary position-fixed bottom-0 end-0 m-3 shadow-lg" 
            style="width:180px; height:50px; z-index: 9999;" 
            data-bs-toggle="modal" data-bs-target="#ticketModal">
        Потрібна допомога?
    </button>

    <div class="modal fade" id="ticketModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow border-0">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title">Служба підтримки</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0" style="height: 640px;">
                    <iframe src="{{ route('tickets.showWidget') }}" 
                            width="100%" height="100%" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>