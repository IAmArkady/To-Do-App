@extends('app')
@section('title', 'Задачи')
@section('content')
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h2 class="text-dark">Ваши задачи</h2>
        <button class="btn btn-modern btn-primary" data-bs-toggle="modal" data-bs-target="#taskModal">
            <i class="fa fa-plus"></i> Создать задачу
        </button>
    </div>
    <div id="tasksList"></div>

    <!-- Modal создания/редактирования задачи -->
    <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" id="taskForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Задача</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="taskId">
                    <div class="mb-3">
                        <label for="title" class="form-label">Название</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Описание</label>
                        <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Статус</label>
                        <select class="form-select" id="status" name="status">
                            @foreach(\App\Models\Task::getStatuses() as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-modern" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-success btn-modern">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function renderTasks(tasks) {
            let html = '';
            if (!tasks.data.length) {
                html = '<div class="alert alert-info">Нет задач. Создайте первую задачу!</div>';
            } else {
                tasks.data.forEach(task => {
                    html += `
            <div class="task-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">${task.title}</h5>
                        <span class="badge ${task.status.state == 'SUCCESS' ? 'bg-success' : 'bg-primary'}">${task.status.label}</span>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-modern btn-outline-secondary me-2" onclick="editTask(${task.id})"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-sm btn-modern btn-outline-danger" onclick="deleteTask(${task.id})"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-muted">${task.description || ''}</p>
            </div>`;
                });
            }
            $('#tasksList').html(html);
        }

        function fetchTasks() {
            apiRequest({
                url: '/api/tasks',
                success: renderTasks,
                error: function(xhr){
                    if(xhr.status === 401){
                        alert('Не авторизован! Войдите заново.');
                        window.location.href = '/login';
                    }
                }
            });
        }

        // Создание / редактирование задачи
        $('#taskForm').submit(function(e){
            e.preventDefault();

            let id = $('#taskId').val();
            let url = id ? '/api/tasks/' + id : '/api/tasks';
            let method = id ? 'PUT' : 'POST';

            let data = {
                title: $('#title').val(),
                description: $('#description').val(),
                status: $('#status').val()
            };

            apiRequest({
                url: url,
                method: method,
                data: data,
                success: function(){
                    $('#taskModal').modal('hide');
                    fetchTasks();
                }
            });
        });

        window.editTask = function(id){
            apiRequest({
                url: '/api/tasks/' + id,
                success: function(res){
                    let task = res.data;
                    $('#taskId').val(task.id);
                    $('#title').val(task.title);
                    $('#description').val(task.description);
                    $('#status').val(task.status.state);
                    $('#taskModalLabel').text('Редактировать задачу');
                    $('#taskModal').modal('show');
                }
            });
        }

        window.deleteTask = function(id){
            if(!confirm('Удалить задачу?')) return;
            apiRequest({
                url: '/api/tasks/' + id,
                method: 'DELETE',
                success: fetchTasks
            });
        }

        $('#taskModal').on('hidden.bs.modal', function(){
            $('#taskForm')[0].reset();
            $('#taskId').val('');
            $('#taskModalLabel').text('Задача');
        });

        $(function(){
            fetchTasks();
        });
    </script>
@endsection
