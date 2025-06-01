<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CollegeResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\DepartmentResource;
use App\Models\College;
use App\Models\Country;
use App\Models\Department;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReferenceDataController extends Controller
{
    public function getCountries(): AnonymousResourceCollection
    {
        $countries = Country::orderBy('name')->get();
        return CountryResource::collection($countries);
    }

    public function getColleges(): AnonymousResourceCollection
    {
        $colleges = College::with('country')->orderBy('name')->get();
        return CollegeResource::collection($colleges);
    }

    public function getDepartments(): AnonymousResourceCollection
    {
        $departments = Department::orderBy('name')->get();
        return DepartmentResource::collection($departments);
    }
}
