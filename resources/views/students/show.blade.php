@extends('layouts.app')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                <div>
                    <span class="hero-chip mb-3">Student Profile</span>
                    <h1 class="section-title mb-1">{{ $student->full_name }}</h1>
                    <p class="text-muted mb-0">Student details</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('students.edit', $student) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Back to List</a>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="record-card h-100">
                        <div class="record-label">Student ID</div>
                        <div class="record-value">{{ $student->student_id }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="record-card h-100">
                        <div class="record-label">Course</div>
                        <div class="record-value">{{ $student->course }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="record-card h-100">
                        <div class="record-label">Year Level</div>
                        <div class="record-value">{{ $student->year_level }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="record-card h-100">
                        <div class="record-label">Email Address</div>
                        <div class="record-value">{{ $student->email_address }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
