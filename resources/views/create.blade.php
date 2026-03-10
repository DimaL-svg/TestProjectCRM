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
    </style>
</head>
<body>
     @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    <form action="{{ route('tickets.store') }}" id="ticketForm" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Ім'я</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Ваше ім'я">
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label fw-bold">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="your@email.com">
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
                <label for="phone" class="form-label fw-bold">Телефон</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="+380XXXXXXXXX">
            </div>
            @error('phone')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="subject" class="form-label fw-bold">Тема</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Коротко про що ваше питання">
            </div>
            @error('subject')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="message" class="form-label fw-bold">Повідомлення</label>
            <textarea class="form-control" id="message" name="message" placeholder="Опишіть ваше питання детальніше"></textarea>
        </div>
        @error('message')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror

        <div class="d-grid">
            <button type="submit" class="btn btn-outline-secondary btn-lg">Відправити заявку</button>
        </div>


    </form>
</body>
</html>