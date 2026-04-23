@extends('layouts.app')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <div class="mb-4">
                <span class="hero-chip mb-3">Create Record</span>
                <h1 class="section-title mb-2">Add Student</h1>
                <p class="text-muted mb-0">Fill out the form below to create a polished student record.</p>
            </div>

            <form action="{{ route('students.store') }}" method="POST">
                @csrf
                @include('students._form', ['submitLabel' => 'Save Student'])
            </form>
        </div>
    </div>
@endsection
