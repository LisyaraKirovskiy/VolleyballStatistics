@extends('layouts.app')
@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            min-height: 100vh;
        }

        .card {
            background: #1e1e1e;
            border: 1px solid #333;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.5);
        }

        .card-header {
            background: #2c3e50;
            border-bottom: 1px solid #444;
        }

        .card-header h4 {
            color: #fff;
            margin: 0;
        }

        .form-label {
            color: #ddd;
        }

        .form-control {
            background: #2d2d2d;
            border: 1px solid #444;
            color: #fff;
        }

        .form-control:focus {
            background: #363636;
            border-color: #3498db;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.3);
            color: #fff;
        }

        .form-control::placeholder {
            color: #888;
        }

        .btn {
            border-radius: 4px;
            padding: 0.5rem 1.5rem;
            border: none;
        }

        .btn-success {
            background: #27ae60;
            color: white;
        }

        .btn-success:hover {
            background: #2ecc71;
        }

        .btn-secondary {
            background: #4a5568;
            color: #fff;
        }

        .btn-secondary:hover {
            background: #2d3748;
        }

        .d-flex {
            gap: 1rem;
            margin-top: 1.5rem;
        }

        input[required] {
            border-left: 3px solid #e74c3c;
        }
    </style>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Добавить нового игрока</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('players.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Имя *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="position" class="form-label">Позиция *</label>
                                <input type="text" class="form-control" id="position" name="position" required>
                            </div>

                            <div class="mb-3">
                                <label for="team" class="form-label">Команда *</label>
                                <input type="text" class="form-control" id="team" name="team" required>
                            </div>

                            <div class="mb-3">
                                <label for="number" class="form-label">Номер *</label>
                                <input type="number" class="form-control" id="number" name="number" min="1" max="99"
                                    required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('players.index') }}" class="btn btn-secondary">Отмена</a>
                                <button type="submit" class="btn btn-success">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection