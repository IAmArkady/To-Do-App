<?php $__env->startSection('title', 'Регистрация'); ?>

<?php $__env->startSection('content'); ?>
    <div class="auth-card">
        <h2 class="mb-4 text-center text-success">Регистрация</h2>
        <form id="registerForm">
            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input type="text" id="name" name="name" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-modern btn-success w-100">Зарегистрироваться</button>
            <a href="/login" class="d-block mt-3 text-center">Уже зарегистрированы? Войти</a>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(function () {
            $('#registerForm').submit(function(e){
                e.preventDefault();

                apiRequest({
                    url: '/api/auth/register',
                    method: 'POST',
                    data: {
                        name: $('#name').val(),
                        email: $('#email').val(),
                        password: $('#password').val()
                    },
                    success: function(data){
                        localStorage.setItem('token', data.token);
                        window.location.href = '/tasks';
                    },
                    error: function(xhr){
                        alert(xhr.responseJSON?.message || 'Ошибка регистрации');
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Projects\todo\resources\views/auth/register.blade.php ENDPATH**/ ?>