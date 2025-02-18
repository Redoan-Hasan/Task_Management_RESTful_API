# Task Management RESTful API

## Overview
This Task Management RESTful API is built using the Laravel framework. It allows users to register, log in, manage their tasks, and perform CRUD (Create, Read, Update, Delete) operations on tasks. The API is designed to be simple, efficient, and secure, utilizing Laravel Sanctum for authentication.

## Features
- User registration and authentication
- Task management (CRUD operations)
- Secure API endpoints
- Token-based authentication using Laravel Sanctum

## Technologies Used
- **PHP**: The programming language used for backend development.
- **Laravel**: A PHP framework for building web applications.
- **MySQL**: The database used for storing user and task data.
- **Laravel Sanctum**: For API token authentication.
- **Composer**: Dependency management for PHP.


## API Endpoints
### Authentication

#### Register User
- **Endpoint:** `POST /api/register`
- **Request Body:**
```json
{
  "name": "string",
  "email": "string",
  "password": "string",
  "password_confirmation": "string"
}
```

#### Login User
- **Endpoint:** `POST /api/login`
- **Request Body:**
```json
{
  "email": "string",
  "password": "string"
}
```

#### Logout User
- **Endpoint:** `POST /api/logout`
- **Authentication:** Bearer Token required

### Task Management

#### Get All Tasks
- **Endpoint:** `GET /api/tasks`
- **Authentication:** Bearer Token required

#### Create Task
- **Endpoint:** `POST /api/tasks`
- **Request Body:**
```json
{
  "body": "string"
}
```
- **Authentication:** Bearer Token required

#### Get Task by ID
- **Endpoint:** `GET /api/tasks/{id}`
- **Authentication:** Bearer Token required

#### Update Task
- **Endpoint:** `PUT /api/tasks/{id}`
- **Request Body:**
```json
{
  "body": "string",
  "is_finished": "boolean"
}
```
- **Authentication:** Bearer Token required

#### Delete Task
- **Endpoint:** `DELETE /api/tasks/{id}`
- **Authentication:** Bearer Token required


## Acknowledgments
- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Sanctum Documentation](https://laravel.com/docs/sanctum)
---

