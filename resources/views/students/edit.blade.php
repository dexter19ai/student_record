@extends('layouts.app')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <div class="mb-4">
                <span class="hero-chip mb-3">Update Record</span>
                <h1 class="section-title mb-2">Edit Student</h1>
                <p class="text-muted mb-0">Update the details for {{ $student->full_name }} and keep the record current.</p>
            </div>

            <form action="{{ route('students.update', $student) }}" method="POST">
                @csrf
                @method('PUT')
                @include('students._form', ['submitLabel' => 'Update Student'])
            </form>
        </div>
    </div>
@endsection
