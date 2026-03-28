@extends('layout')

@section('title', 'Dodaj člana')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">

        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Dodaj novog člana</h4>
            </div>

            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('members.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Ime i prezime</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name') }}"
                               placeholder="Unesite ime i prezime">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email adresa</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email') }}"
                               placeholder="Unesite email adresu">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('members.index') }}" class="btn btn-secondary">
                            Nazad
                        </a>

                        <button type="submit" class="btn btn-primary">
                            Sačuvaj
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

@endsection