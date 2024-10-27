# Custom API - For Assessment

# I have used Postman for testing as my local machine was having some issue running CURL, following screenshot shows my requests from postman:

![image](https://github.com/user-attachments/assets/acd93297-adb2-40eb-9d2b-d17a3c391e5c)


This application provides a REST API for batch importing and managing employees.

## Requirements
- PHP 8.0+
- MySQL/MariaDB, I have used MySQL
- Laravel 10.x

## Setup Instructions
1. Clone this repository.
2. Install dependencies: 
   ```bash
    composer Install
   ```
3. Set up your `.env` file with the database credentials.
4. Run migrations:
   ```bash
   php artisan migrate
   ```
5. Start the server:
   ```bash 
   php artisan serve
   ```

### Import Employees
To import employees from provided CSV, make a `POST` request to: `/api/employee`

### Employee Endpoints
- `POST /api/employee` - POST request with form-data key = file and attachment.
- `GET /api/employee` - Retrieve all employees with pagination.
- `GET /api/employee/{id}` - Retrieve a specific employee by id.
- `DELETE /api/employee/{id}` - Delete an employee by id.
