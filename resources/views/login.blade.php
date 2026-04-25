@extends('layout')

@section('title', 'Prijava')

@section('content')

<div class="d-flex justify-content-center align-items-center" style="height: 80vh;">

    <div class="card shadow" style="width: 400px;">
        
        <div class="card-header text-center bg-dark text-white">
            <h4>Prijava</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email adresa</label>
                    <input type="email" class="form-control" name="email" placeholder="Unesite email">
                </div>

                <div class="mb-3">
                    <label class="form-label">Lozinka</label>
                    <input type="password" class="form-control" name="password" placeholder="Unesite lozinku">
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Prijavi se
                </button>

            </form>

        </div>

        <div class="card-footer text-center">
            <small>Nemate račun? <a href="{{ url('/registration') }}">Registruj se</a></small>
        </div>

    </div>

</div>

@endsection