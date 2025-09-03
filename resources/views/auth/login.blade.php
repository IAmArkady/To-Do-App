@extends('app')

@section('title', 'Вход')

@section('content')
    <div class="auth-card">
        <h2 class="mb-4 text-center text-primary">Вход</h2>
        <form id="loginForm">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-modern btn-primary w-100">Войти</button>
            <a href="/register" class="d-block mt-3 text-center">Нет аккаунта? Зарегистрироваться</a>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#loginForm').submit(function(e){
                e.preventDefault();

                apiRequest({
                    url: '/api/auth/login',
                    method: 'POST',
                    data: {
                        email: $('#email').val(),
                        password: $('#password').val()
                    },
                    success: function(data){
                        localStorage.setItem('user', data.user.name);
                        localStorage.setItem('token', data.token);
                        window.location.href = '/';
                    },
                    error: function(xhr){
                        alert(xhr.responseJSON?.message || 'Ошибка входа');
                    }
                });
            });
        });
    </script>
@endsection
