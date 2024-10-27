<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Employee;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{

    public function import(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'File is required and must be a CSV'], 400);
        }

        Employee::returnCSVFiles($request);

        return response()->json(['message' => 'Employees imported successfully'], 200);
    }

    // Retrieve all employees
    public function index()
    {
        return response()->json(Employee::paginate(10));
    }

    // Retrieve a specific employee by ID
    public function show($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }
        return response()->json($employee);
    }

    // Delete an employee by ID
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }
        $employee->delete();
        return response()->json(['message' => 'Employee deleted successfully']);
    }
}
