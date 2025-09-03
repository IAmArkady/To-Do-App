function apiRequest({ url, method = 'GET', data = null, success, error }) {
    $.ajax({
        url: url,
        method: method,
        headers: {
            'Authorization': 'Bearer ' + (localStorage.getItem('token') || ''),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        data: data ? JSON.stringify(data) : null,
        success: success,
        error: error || function(xhr){
            console.error('API error:', xhr);
            alert('Ошибка: ' + (xhr.responseJSON?.message || xhr.status));
        }
    });
}

function logout() {
    apiRequest({
        url: '/api/auth/logout',
        method: 'POST',
        success: function(){
            localStorage.removeItem('token');
            localStorage.removeItem('user');
            window.location.href = '/login';
        }
    });
}
