<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identifiants de Connexion</title>
</head>
<body>
    <h2>Bonjour {{ $user->name }},</h2>
    <p>Votre compte a été créé avec succès.</p>
    <p>Voici vos identifiants de connexion :</p>
    <ul>
        <li><strong>Email :</strong> {{ $user->email }}</li>
        <li><strong>Mot de passe :</strong> {{ $password }}</li>
    </ul>
    <p>Veuillez vous connecter et modifier votre mot de passe dès que possible.</p>
    <p><a href="{{ route('/login') }}">Se connecter</a></p>
    <p>Merci,</p>
    <p>L'équipe HRMS</p>
</body>
</html>
