<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identifiants de Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Bonjour {{ $user->name }},</h2>
        
        <p class="text-lg text-gray-700 mb-4">Votre compte a été créé avec succès.</p>
        
        <p class="text-lg text-gray-700 mb-4">Voici vos identifiants de connexion :</p>
        
        <ul class="list-none space-y-2 mb-4">
            <li><strong class="text-gray-800">Email :</strong> <span class="text-blue-600">{{ $user->email }}</span></li>
            <li><strong class="text-gray-800">Mot de passe :</strong> <span class="text-blue-600">{{ $password }}</span></li>
        </ul>
        
        <p class="text-lg text-gray-700 mb-4">Veuillez vous connecter et modifier votre mot de passe dès que possible.</p>
        
        <p class="mb-4">
            <a href="{{ route('/login') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Se connecter</a>
        </p>
        
        <p class="text-gray-700 mb-4">Merci,</p>
        <p class="text-gray-700">L'équipe HRMS</p>
    </div>
</body>
</html>
