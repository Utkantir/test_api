<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
        {
            return Employee::all();
        }

    public function store(EmployeeRequest $request)
        {
            $validated = $request->validated();
            return Employee::create($validated);
        }

    public function show($id)
        {
          return Employee::findOrFail($id);
        }

}
