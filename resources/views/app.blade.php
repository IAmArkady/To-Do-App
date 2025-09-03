<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'ToDo App')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { font-family: 'Inter', system-ui, sans-serif; margin:0; padding:0; background:#f5f6fa; }
        header, footer { background:#222; color:#fff; }
        header a, footer a { color:#fff; margin-right:1rem; text-decoration:none; }
        .navbar-brand { font-weight:700; letter-spacing:1px; }
        main { padding:2rem; max-width:800px; margin:auto; }
        .task-card { background:#fff; border-radius:1rem; box-shadow: 0 2px 8px rgba(0,0,0,.07); margin-bottom:1rem; padding:1.5rem; transition:.2s; }
        .task-card:hover { box-shadow: 0 4px 18px rgba(0,0,0,.13); }
        .btn-modern { border-radius:.7rem; font-weight:500; }
        .form-control:focus { border-color: #1abc9c; box-shadow: 0 0 0 .15rem rgba(26,188,156,.18);}
        .bg-gradient {
            background: linear-gradient(90deg, #1abc9c 0%, #3498db 100%);
        }
        .auth-card { background:#fff; border-radius:1rem; box-shadow: 0 2px 14px rgba(46,204,113,.09); padding:2rem; margin:auto; margin-top:3rem; max-width:400px;}
    </style>
    @yield('styles')
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-gradient px-4">
        <a class="navbar-brand" href="/">ToDo App</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto"></ul>
            <ul class="navbar-nav" id="authMenu"></ul>
        </div>
    </nav>
</header>

<main>
    @yield('content')
</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    $(function(){
        const $menu = $('#authMenu');
        const token = localStorage.getItem('token');
        const user_name = localStorage.getItem('user');

        if(token) {
            $menu.html(`
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="logout(); return false;">
                    <i class="fa fa-sign-out-alt"></i> Выход (${user_name})
                </a>
            </li>
        `);
        } else {
            $menu.html(`
            <li class="nav-item">
                <a class="nav-link" href="/login">
                    <i class="fa fa-sign-in-alt"></i> Войти
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/register">
                    <i class="fa fa-user-plus"></i> Регистрация
                </a>
            </li>
        `);
        }
    });
</script>
@yield('scripts')

</body>
</html>
