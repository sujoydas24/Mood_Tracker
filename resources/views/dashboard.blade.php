<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Mood Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    {{-- Header --}}
    <header class="bg-primary text-white text-center py-3">
        <h1>Mood Tracker Dashboard</h1>
         {{-- <div class="d-flex align-items-center gap-3"> --}}
            <span class="fw-bold">Welcome, {{ Auth::user()->name }}</span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-light text-dark">Logout</button>
                </form>
            {{-- </div> --}}
        </div>
    </header>

    {{-- Main --}}
    <main class="container my-5">

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Mood Entry Form --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-success text-white">
                <strong>Log Today’s Mood</strong>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('moods.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="mood" class="form-label">Mood</label>
                        <select name="mood" id="mood" class="form-select" required>
                            <option value="">Select Mood</option>
                            @foreach(['Happy', 'Sad', 'Angry', 'Excited'] as $moodOption)
                                <option value="{{ $moodOption }}">{{ $moodOption }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="note" class="form-label">Optional Note</label>
                        <textarea name="note" id="note" class="form-control" placeholder="Write something..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Submit Mood</button>
                </form>
            </div>
        </div>

        {{-- Mood History --}}
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white">
                <strong>Your Mood History</strong>
            </div>
            <div class="card-body">
                @if($moods->isEmpty())
                    <p>No mood entries found yet.</p>
                @else
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Mood</th>
                                <th>Note</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($moods as $mood)
                                <tr>
                                    <td>{{ $mood->date }}</td>
                                    <td>{{ $mood->mood }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('moods.update', $mood->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="text" name="note" value="{{ $mood->note }}" class="form-control">
                                            <button type="submit" class="btn btn-sm btn-primary mt-1">Update</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('moods.destroy', $mood->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Clear this note?')">Delete Note</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

    </main>

    {{-- Footer --}}
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">&copy; {{ now()->year }} Mood Tracker App</p>
    </footer>

</body>
</html>
