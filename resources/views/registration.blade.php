@extends('layout')

@section('title', 'Registracija')

@section('content')

<div class="d-flex justify-content-center align-items-center" style="height: 80vh;">

    <div class="card shadow" style="width: 420px;">

        <div class="card-header text-center bg-success text-white">
            <h4>Registracija</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('registration.post') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Ime i prezime</label>
                    <input type="text" class="form-control" name="name" placeholder="Unesite ime">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email adresa</label>
                    <input type="email" class="form-control" name="email" placeholder="Unesite email">
                </div>

                <div class="mb-3">
                    <label class="form-label">Lozinka</label>
                    <input type="password" class="form-control" name="password" placeholder="Unesite lozinku">
                </div>

                <div class="mb-3">
                    <label class="form-label">Potvrda lozinke</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Ponovite lozinku">
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif


                <button type="submit" class="btn btn-success w-100">
                    Registruj se
                </button>

            </form>

        </div>

        <div class="card-footer text-center">
            <small>Već imaš račun? <a href="{{ url('/login') }}">Prijavi se</a></small>
        </div>

    </div>

</div>

@endsection