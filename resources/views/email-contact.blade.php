<!DOCTYPE html>
<html>
<head>
    <title>Nouveau message de contact</title>
</head>
<body>
    <h1>Nouveau message de contact</h1>
    <p><strong>Email :</strong> {{ $details['email'] }}</p>
    <p><strong>Objet :</strong> {{ $details['subject'] }}</p>
    <p><strong>Message :</strong></p>
    <p>{{ $details['message'] }}</p>
</body>
</html>
