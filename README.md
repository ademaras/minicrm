# Mini CRM API Documentation

## Overview

This API allows users to manage employees and tasks within the system. We don't support pagination and filtering.

---

## Base URL

`http://localhost/api/v1`

---

# Employee Management

## Overview

This API allows users to manage employees within the system. The key functionalities include listing all employees, viewing a specific employee's tasks, and other potential CRUD operations.

## Endpoints

| **HTTP Method** | **URL**              | **Action** | **Description**               |
| --------------- | -------------------- | ---------- | ----------------------------- |
| GET             | /employees           | index      | Çalışanları listele           |
| GET             | /employees/create    | create     | Yeni çalışan formu görüntüle  |
| POST            | /employees           | store      | Yeni çalışan ekle             |
| GET             | /employees/{id}      | show       | Çalışan detaylarını görüntüle |
| GET             | /employees/{id}/edit | edit       | Çalışanı düzenleme formu      |
| PUT/PATCH       | /employees/{id}      | update     | Çalışanı güncelle             |
| DELETE          | /employees/{id}      | destroy    | Çalışanı sil                  |

### 1. **List All Employees**

**GET** `/employees`

Retrieves a list of all employees.

#### Response

```json
[
  {
    "id": 1,
    "name": "John Doe",
    "email": "john.doe@example.com",
    "created_at": "2024-11-23T10:00:00",
    "updated_at": "2024-11-23T12:00:00"
  },
  {
    "id": 2,
    "name": "Jane Smith",
    "email": "jane.smith@example.com",
    "created_at": "2024-11-22T14:00:00",
    "updated_at": "2024-11-23T15:00:00"
  }
]
```

---

### 2. **Get an Employee's Tasks**

**GET** `/employees/{id}/tasks`

Retrieves a list of tasks assigned to a specific employee.

#### Response

```json
[
  {
    "id": 1,
    "employee_id": 1,
    "title": "Task Title",
    "status": "pending",
    "created_at": "2024-11-23T10:00:00",
    "updated_at": "2024-11-23T12:00:00"
  },
  {
    "id": 2,
    "employee_id": 1,
    "title": "Another Task",
    "status": "in_progress",
    "created_at": "2024-11-22T14:00:00",
    "updated_at": "2024-11-23T15:00:00"
  }
]
```

#### Response (Error)

```json
{
  "message": "Employee not found."
}
```

---

## Notes

- Ensure `id` exists in the `employees` table when querying for tasks.
- Relationships between employees and tasks are enforced via foreign key constraints in the database.

Örnek API Çağrıları

1.Tüm çalışanları listele:

```bash
curl -X GET http://yourapp.test/api/employees
```

2.Yeni çalışan ekle:

```bash
curl -X POST http://yourapp.test/api/employees \
-H "Content-Type: application/json" \
-d '{"name": "John Doe", "email": "john@example.com"}'
```

3.Belirli bir çalışanı göster:

```bash
curl -X GET http://yourapp.test/api/employees/1
```

4.Çalışanı güncelle:

```bash
curl -X PUT http://yourapp.test/api/employees/1 \
-H "Content-Type: application/json" \
-d '{"name": "Jane Doe"}'
```

5.Çalışanı sil:

```bash
curl -X DELETE http://yourapp.test/api/employees/1
```

# Task Management

## Overview

This API allows users to manage tasks for employees. The key functionalities include listing tasks, creating new tasks, updating task details, marking tasks as completed, and deleting tasks.

## Endpoints

| **HTTP Method** | **URL**     | **Action** | **Description**              |
| --------------- | ----------- | ---------- | ---------------------------- |
| GET             | /tasks      | index      | Tüm görevleri listele        |
| GET             | /tasks/{id} | show       | Belirli bir görevi görüntüle |
| POST            | /tasks      | store      | Yeni görev oluştur           |
| PUT/PATCH       | /tasks/{id} | update     | Görevi güncelle              |
| DELETE          | /tasks/{id} | destroy    | Görevi sil                   |

### 1. **List All Tasks**

**GET** `/tasks`

Retrieves a list of all tasks.

#### Response

```json
[
  {
    "id": 1,
    "employee_id": 1,
    "title": "Task Title",
    "status": "pending",
    "created_at": "2024-11-23T10:00:00",
    "updated_at": "2024-11-23T12:00:00"
  },
  {
    "id": 2,
    "employee_id": 2,
    "title": "Another Task",
    "status": "in_progress",
    "created_at": "2024-11-22T14:00:00",
    "updated_at": "2024-11-23T15:00:00"
  }
]
```

---

### 2. **Create a New Task**

**POST** `/tasks`

Creates a new task associated with an employee.

#### Request Body

```json
{
  "employee_id": 1,
  "title": "New Task Title",
  "status": "pending"
}
```

#### Validation Rules

- `employee_id` (required): Must exist in the `employees` table.
- `title` (required): String, max length 255.
- `status` (required): Must be one of `pending`, `in_progress`, or `completed`.

#### Response (Success)

```json
{
  "id": 3,
  "employee_id": 1,
  "title": "New Task Title",
  "status": "pending",
  "created_at": "2024-11-23T16:00:00",
  "updated_at": "2024-11-23T16:00:00"
}
```

#### Response (Error)

```json
{
  "message": "Validation Error",
  "errors": {
    "employee_id": ["The selected employee_id is invalid."],
    "title": ["The title field is required."]
  }
}
```

---

### 3. **Get a Specific Task**

**GET** `/tasks/{id}`

Retrieves details of a specific task by its ID.

#### Response

```json
{
  "id": 1,
  "employee_id": 1,
  "title": "Task Title",
  "status": "pending",
  "created_at": "2024-11-23T10:00:00",
  "updated_at": "2024-11-23T12:00:00"
}
```

#### Response (Error)

```json
{
  "message": "Task not found."
}
```

---

### 4. **Update a Task**

**PUT** `/tasks/{id}`

Updates the title or status of an existing task.

#### Request Body

```json
{
  "title": "Updated Task Title",
  "status": "in_progress"
}
```

#### Validation Rules

- `title` (optional): String, max length 255.
- `status` (optional): Must be one of `pending`, `in_progress`, or `completed`.

#### Response

```json
{
  "id": 1,
  "employee_id": 1,
  "title": "Updated Task Title",
  "status": "in_progress",
  "created_at": "2024-11-23T10:00:00",
  "updated_at": "2024-11-23T13:00:00"
}
```

---

### 5. **Mark a Task as Completed**

**PATCH** `/tasks/{id}/complete`

Updates the status of a task to `completed`.

#### Response

```json
{
  "id": 1,
  "employee_id": 1,
  "title": "Task Title",
  "status": "completed",
  "created_at": "2024-11-23T10:00:00",
  "updated_at": "2024-11-23T14:00:00"
}
```

#### Response (Error)

```json
{
  "message": "Task not found."
}
```

---

### 6. **Delete a Task**

**DELETE** `/tasks/{id}`

Deletes a task by its ID.

#### Response

```json
{
  "message": "Task deleted successfully."
}
```

#### Response (Error)

```json
{
  "message": "Task not found."
}
```

---

## Notes

- Ensure `employee_id` exists in the database when creating or updating tasks.
- Enum type for `status` ensures strict data validation in PostgreSQL.
- Foreign key constraints ensure referential integrity for `employee_id` in the `tasks` table.

**Örnek API Çağrıları**

1.**Tüm görevleri listele**:

```bash
curl -X GET http://yourapp.test/api/tasks
```

2.**Yeni görev ekle**:

```bash
curl -X POST http://yourapp.test/api/tasks \
-H "Content-Type: application/json" \
-d '{"employee_id": 1, "title": "New Task", "status": "pending"}'
```

3.**Belirli bir görevi göster**:

```bash
curl -X GET http://yourapp.test/api/tasks/1
```

4.**Görevi güncelle**:

```bash
curl -X PUT http://yourapp.test/api/tasks/1 \
-H "Content-Type: application/json" \
-d '{"title": "Updated Task", "status": "in_progress"}'
```

5.**Görevi tamamla**:

```bash
curl -X PATCH http://yourapp.test/api/tasks/1/complete
```

6.**Görevi sil**:

```bash
curl -X DELETE http://yourapp.test/api/tasks/1
```
