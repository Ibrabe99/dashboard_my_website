<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>رسالة من نموذج الاتصال</title>
</head>
<body>
<h2>رسالة جديدة من {{ $contactMessage->name }}</h2>
<p><strong>البريد الإلكتروني:</strong> {{ $contactMessage->email }}</p>
<p><strong>العنوان:</strong> {{ $contactMessage->address ?? 'لا يوجد' }}</p>
<p><strong>الرسالة:</strong></p>
<p>{{ $contactMessage->message }}</p>

</body>
</html>
