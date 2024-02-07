<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Welcome</title>
    <!-- Ссылки на CSS, JavaScript и другие ресурсы -->
</head>
<body>
    <header>
        <h1>Welcome to our application!</h1>
    </header>

    <main class="py-4">
        @yield('content') {{-- Сюда будет вставлено содержимое из дочерних шаблонов --}}
    </main>

    <footer>
        <!-- Футер сайта -->
    </footer>
</body>
</html>