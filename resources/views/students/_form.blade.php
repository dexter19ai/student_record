<div class="row g-3">
    <div class="col-md-6">
        <label for="student_id" class="form-label">Student ID</label>
        <input
            type="text"
            class="form-control @error('student_id') is-invalid @enderror"
            id="student_id"
            name="student_id"
            value="{{ old('student_id', $student->student_id ?? '') }}"
            required
        >
        @error('student_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="full_name" class="form-label">Full Name</label>
        <input
            type="text"
            class="form-control @error('full_name') is-invalid @enderror"
            id="full_name"
            name="full_name"
            value="{{ old('full_name', $student->full_name ?? '') }}"
            required
        >
        @error('full_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="course" class="form-label">Course</label>
        <input
            type="text"
            class="form-control @error('course') is-invalid @enderror"
            id="course"
            name="course"
            value="{{ old('course', $student->course ?? '') }}"
            required
        >
        @error('course')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="year_level" class="form-label">Year Level</label>
        <select
            class="form-select @error('year_level') is-invalid @enderror"
            id="year_level"
            name="year_level"
            required
        >
            <option value="">Select year level</option>
            @foreach (['1st Year', '2nd Year', '3rd Year', '4th Year', '5th Year'] as $level)
                <option value="{{ $level }}" @selected(old('year_level', $student->year_level ?? '') === $level)>{{ $level }}</option>
            @endforeach
        </select>
        @error('year_level')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label for="email_address" class="form-label">Email Address</label>
        <input
            type="email"
            class="form-control @error('email_address') is-invalid @enderror"
            id="email_address"
            name="email_address"
            value="{{ old('email_address', $student->email_address ?? '') }}"
            required
        >
        @error('email_address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="d-flex flex-column flex-sm-row gap-2 mt-4 pt-2">
    <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
