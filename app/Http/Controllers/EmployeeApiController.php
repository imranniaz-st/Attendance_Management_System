<?php

namespace App\Http\Controllers;

use App\Models\EmployeApi;
use Illuminate\Http\Request;

class EmployeeApiController extends Controller
{
    public function index()
    {
        // Fetch all employees from the 'employees' table in the second database
        $employees = EmployeApi::get();

        // Return the employee data as a JSON response
        return response()->json(['data' => $employees]);

    }
}
