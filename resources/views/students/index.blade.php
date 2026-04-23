@extends('layouts.app')

@section('content')
    <div class="hero-panel position-relative p-4 p-lg-5 mb-4">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-4">
            <div class="pe-lg-4">
                <span class="hero-chip mb-3">Student Dashboard</span>
                <h1 class="hero-title mb-2">Student Records</h1>
                <p class="hero-text mb-0">Manage student information in one polished workspace with quick access to every record.</p>
            </div>
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <div class="record-card">
                    <div class="record-label">Total Students</div>
                    <div class="record-value">{{ $students->total() }}</div>
                </div>
                <a href="{{ route('students.create') }}" class="btn btn-primary">Add New Student</a>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Student ID</th>
                            <th>Full Name</th>
                            <th>Course</th>
                            <th>Year Level</th>
                            <th>Email Address</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>{{ $student->student_id }}</td>
                                <td>{{ $student->full_name }}</td>
                                <td>{{ $student->course }}</td>
                                <td>{{ $student->year_level }}</td>
                                <td>{{ $student->email_address }}</td>
                                <td class="text-end">
                                    <div class="action-group">
                                        <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-outline-info">View</a>
                                        <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Delete this student record?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">No student records found yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $students->links() }}
    </div>
@endsection
