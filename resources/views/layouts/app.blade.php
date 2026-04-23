<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand-navy: #153b50;
            --brand-teal: #1f7a8c;
            --brand-mint: #b8f2e6;
            --brand-cream: #f7f4ea;
            --brand-ink: #10212b;
            --brand-muted: #6a7a84;
            --surface: rgba(255, 255, 255, 0.88);
            --surface-strong: #ffffff;
            --border-soft: rgba(21, 59, 80, 0.12);
            --shadow-soft: 0 20px 45px rgba(16, 33, 43, 0.08);
            --shadow-hover: 0 26px 55px rgba(16, 33, 43, 0.12);
        }

        body {
            min-height: 100vh;
            font-family: "Plus Jakarta Sans", "Trebuchet MS", sans-serif;
            color: var(--brand-ink);
            background:
                radial-gradient(circle at top left, rgba(184, 242, 230, 0.9), transparent 32%),
                radial-gradient(circle at top right, rgba(31, 122, 140, 0.14), transparent 28%),
                linear-gradient(180deg, #f9fbfd 0%, var(--brand-cream) 100%);
        }

        .page-shell {
            position: relative;
        }

        .page-shell::before {
            content: "";
            position: fixed;
            inset: 0;
            background:
                linear-gradient(135deg, rgba(255, 255, 255, 0.52), transparent 42%),
                repeating-linear-gradient(135deg, rgba(21, 59, 80, 0.025) 0, rgba(21, 59, 80, 0.025) 1px, transparent 1px, transparent 18px);
            pointer-events: none;
            z-index: 0;
        }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 10;
            backdrop-filter: blur(16px);
            background: rgba(21, 59, 80, 0.86);
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
        }

        .navbar-brand {
            letter-spacing: -0.03em;
        }

        .app-main,
        .container {
            position: relative;
            z-index: 1;
        }

        .hero-panel,
        .card {
            border: 1px solid var(--border-soft) !important;
            border-radius: 24px;
            background: var(--surface);
            box-shadow: var(--shadow-soft);
        }

        .hero-panel {
            overflow: hidden;
        }

        .hero-panel::after {
            content: "";
            position: absolute;
            inset: auto -10% -35% auto;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(184, 242, 230, 0.95) 0%, rgba(184, 242, 230, 0) 70%);
            pointer-events: none;
        }

        .hero-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.45rem 0.85rem;
            border-radius: 999px;
            background: rgba(184, 242, 230, 0.65);
            color: var(--brand-navy);
            font-size: 0.84rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .hero-title {
            font-size: clamp(2rem, 3vw, 3rem);
            font-weight: 800;
            letter-spacing: -0.05em;
            color: var(--brand-navy);
        }

        .hero-text,
        .text-muted {
            color: var(--brand-muted) !important;
        }

        .btn {
            border-radius: 14px;
            font-weight: 700;
            padding: 0.72rem 1.15rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease, border-color 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            border: none;
            background: linear-gradient(135deg, var(--brand-teal), var(--brand-navy));
            box-shadow: 0 14px 30px rgba(21, 59, 80, 0.22);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background: linear-gradient(135deg, #226f7d, #133042);
            box-shadow: 0 18px 32px rgba(21, 59, 80, 0.26);
        }

        .btn-outline-secondary,
        .btn-outline-primary,
        .btn-outline-info,
        .btn-outline-danger {
            border-width: 1px;
            background: rgba(255, 255, 255, 0.7);
        }

        .btn-outline-primary {
            color: var(--brand-teal);
            border-color: rgba(31, 122, 140, 0.32);
        }

        .btn-outline-info {
            color: #0d7490;
            border-color: rgba(13, 116, 144, 0.24);
        }

        .btn-outline-danger {
            border-color: rgba(172, 54, 72, 0.24);
        }

        .card-body {
            padding: 2rem !important;
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 800;
            letter-spacing: -0.04em;
            color: var(--brand-navy);
        }

        .form-label {
            margin-bottom: 0.55rem;
            font-weight: 700;
            color: var(--brand-navy);
        }

        .form-control,
        .form-select {
            min-height: 3.25rem;
            border: 1px solid rgba(21, 59, 80, 0.14);
            border-radius: 16px;
            padding: 0.85rem 1rem;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: inset 0 1px 2px rgba(16, 33, 43, 0.03);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: rgba(31, 122, 140, 0.5);
            box-shadow: 0 0 0 0.25rem rgba(31, 122, 140, 0.12);
        }

        .table {
            --bs-table-bg: transparent;
            margin-bottom: 0;
        }

        .table thead th {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid rgba(21, 59, 80, 0.08);
            color: var(--brand-muted);
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            background: rgba(247, 250, 252, 0.95);
        }

        .table tbody td {
            padding: 1.1rem 1.25rem;
            border-color: rgba(21, 59, 80, 0.06);
            vertical-align: middle;
        }

        .table tbody tr {
            transition: transform 0.18s ease, background-color 0.18s ease;
        }

        .table tbody tr:hover {
            background: rgba(184, 242, 230, 0.18);
        }

        .record-card {
            border: 1px solid rgba(21, 59, 80, 0.1);
            border-radius: 20px;
            padding: 1.15rem 1.2rem;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.95), rgba(248, 252, 252, 0.88));
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.55);
        }

        .record-label {
            margin-bottom: 0.4rem;
            color: var(--brand-muted);
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .record-value {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--brand-navy);
        }

        .action-group {
            display: flex;
            justify-content: flex-end;
            gap: 0.55rem;
            flex-wrap: wrap;
        }

        .alert-success {
            border: 1px solid rgba(25, 135, 84, 0.18);
            border-radius: 18px;
            background: rgba(230, 247, 238, 0.95);
            color: #155239;
            box-shadow: var(--shadow-soft);
        }

        .pagination {
            gap: 0.4rem;
        }

        .page-link {
            border: none;
            border-radius: 12px !important;
            color: var(--brand-navy);
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 8px 18px rgba(16, 33, 43, 0.06);
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, var(--brand-teal), var(--brand-navy));
        }

        @media (max-width: 767.98px) {
            .card-body {
                padding: 1.4rem !important;
            }

            .hero-title {
                font-size: 2rem;
            }

            .action-group {
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="page-shell">
    <nav class="navbar navbar-expand-lg navbar-dark topbar shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="{{ route('students.index') }}">{{ config('app.name') }}</a>
        </div>
    </nav>

    <main class="app-main py-4 py-md-5">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
