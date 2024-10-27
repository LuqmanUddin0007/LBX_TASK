# Custom API - For Assessment

This application provides a REST API for batch importing and managing employees.

## Requirements
- PHP 8.0+
- MySQL/MariaDB
- Laravel 9.x

## Setup Instructions
1. Clone this repository.
2. Install dependencies: Composer Install
3. Set up your `.env` file with the database credentials.
4. Run migrations: php artisan migrate
5. Start the server:

### Import Employees
To import employees from provided CSV, make a `POST` request to: /api/employee

### Employee Endpoints
- `GET /api/employee` - Retrieve all employees with pagination.
- `GET /api/employee/{id}` - Retrieve a specific employee by ID.
- `DELETE /api/employee/{id}` - Delete an employee.
