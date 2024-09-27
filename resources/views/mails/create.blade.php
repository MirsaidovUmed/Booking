<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Update</title>
</head>
<body>
    <h1>Ваш отель успешно забронирован</h1>
    
    <p>Уважаемый {{ $booking->user->name }},</p>

    <p>Вот информация о вашем бронировании:</p>

    <ul>
        <li>Комната: {{ $booking->room->name }}</li>
        <li>Дата начала: {{ $booking->started_at }}</li>
        <li>Дата завершения: {{ $booking->finished_at }}</li>
        <li>Количество дней: {{ $booking->days }}</li>
        <li>Цена: {{ $booking->price }} сомони.</li>
    </ul>

    <p>Спасибо за использование нашего сервиса!</p>

    <p>С наилучшими пожеланиями,<br>
    Команда HotelBooking</p>
</body>
</html>
