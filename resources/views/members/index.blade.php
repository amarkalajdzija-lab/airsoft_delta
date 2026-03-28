@extends('layout')

@section('title', 'Članovi')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Članovi kluba</h2>
        <p class="text-muted mb-0">Pregled svih registrovanih članova.</p>
    </div>

    <a href="{{ route('members.create') }}" class="btn btn-primary">
        + Dodaj člana
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card shadow border-0">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th width="80">ID</th>
                        <th>Ime</th>
                        <th>Email</th>
                        <th width="200">Akcije</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($members as $member)
                        <tr>
                            <td>{{ $member->id }}</td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->email }}</td>
                            <td>
                                <a href="{{ route('members.edit', $member->id) }}" class="btn btn-sm btn-warning me-1">
                                    Uredi
                                </a>

                                <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Da li ste sigurni da želite obrisati ovog člana?')">
                                        Obriši
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Trenutno nema članova.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection