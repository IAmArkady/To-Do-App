# To-Do API

**Описание:**  
Проект реализует простое REST API для управления задачами (To-Do List) с использованием Laravel и SQLite. Все методы требуют передачи API key для авторизации.

---

## 📌 Функциональность

API поддерживает стандартные CRUD-операции для задач:

| Метод | URL | Описание | Параметры |
|-------|-----|----------|-----------|
| POST | `/tasks` | Создать новую задачу | `title` (обяз.), `description` (опц.), `status` (опц., PENDING по умолчанию) |
| GET  | `/tasks` | Получить список всех задач | — |
| GET  | `/tasks/{id}` | Получить одну задачу по ID | — |
| PUT  | `/tasks/{id}` | Обновить задачу | `title`, `description`, `status` |
| DELETE | `/tasks/{id}` | Удалить задачу | — |

**Валидация данных:**  
- `title` — обязательное поле, не пустое  
- `status` — одно из допустимых значений: `PENDING`, `RECEIVED`, `STARTED`, `SUCCESS`, `FAILURE`, `RETRY`  

**Авторизация:**  
- Все методы требуют API key в заголовке запроса:  
- Для получения API key необходимо зарегистрироваться или войти через следующие эндпоинты:

| Метод | URL | Описание |
|-------|-----|----------|
| POST  | `/api/register` | Регистрация нового пользователя (возвращает API key) |
| POST  | `/api/login` | Авторизация существующего пользователя (возвращает API key) |
| POST  | `/api/logout` | Выход пользователя (инвалидирует API key) |

---

## 🛠 Стек технологий

- PHP 8+  
- Laravel Framework  
- Laravel Sanctum (для аутентификации через API токены)  
- SQLite (встроенная база данных)  
- jQuery + Bootstrap 5 (для фронтенда тестового интерфейса, если есть)

---

## ⚡ Запуск

1. Команда для запуска:  
 ```bash
 php artisan serve
```
2. Адрес:
```bash
http://127.0.0.1:8000/
```
---

## 💻 Пример работы
Все операции с задачами выполняются через API с использованием AJAX-запросов.
1. Регистрация для получения API key
<img width="1010" height="616" alt="Регистрация" src="https://github.com/user-attachments/assets/29512c2f-7ceb-454b-91be-c3ef2578fbd6" />
2. Список задач
<img width="1006" height="229" alt="Список задач" src="https://github.com/user-attachments/assets/014c8d73-100e-4b31-be40-a21eef07dff0" />
3. Создание новой задачи
<img width="1009" height="492" alt="Создание задачи" src="https://github.com/user-attachments/assets/52d39446-25d8-43b4-8a2f-d03df7e811af" />
4. Список созданных задач
<img width="1009" height="618" alt="Список созданных задач" src="https://github.com/user-attachments/assets/c6c270f9-f1bd-47e1-a915-96d1ce0921b1" />
