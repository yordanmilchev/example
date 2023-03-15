<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Контактна форма</title>
</head>
<body>
<h3>Имате ново запитване,</h3>

<br>
<p>От: {{ $inquiry->name }}</p>
<p>Email: {{ $inquiry->email }}</p>
<p>Мобилен телефон: {{ $inquiry->phone }}</p>
<p>Запитване: {{ $inquiry->inquiry }}</p>

<br><br>
<p><i>Моля не отговаряйте на този имейл. Той е
        генериран автоматично и се получава еднократно при запитване.</i></p>
</body>
</html>
