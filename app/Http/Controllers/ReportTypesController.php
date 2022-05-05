<?php

namespace App\Http\Controllers;

use App\Events\ReportTypes\ReportTypeCreatedEvent;
use App\Http\Requests\ReportType\CreateRequest;
use App\Http\Resources\ReportTypeResource;
use App\Models\ReportType;
use Illuminate\Http\Request;

class ReportTypesController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(CreateRequest $request, ReportType $reportType)
    {
        $reportType->name = $request->name;
        $reportType->save();

        ReportTypeCreatedEvent::dispatch($reportType);

        return new ReportTypeResource($reportType);
    }

    public function show(ReportType $reportType)
    {
        //
    }

    public function edit(ReportType $reportType)
    {
        //
    }

    public function update(Request $request, ReportType $reportType)
    {
        //
    }

    public function destroy(ReportType $reportType)
    {
        //
    }
}