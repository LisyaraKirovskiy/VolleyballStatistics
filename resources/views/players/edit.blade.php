@extends('layouts.app')
@section('title', $player->name)
@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 50%, #0a0a0a 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            background: linear-gradient(145deg, #000000 0%, #242424 100%);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .card-header.bg-warning {
            background: linear-gradient(135deg, #f39c12, #e67e22) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .card-header h4 {
            color: #2c3e50;
            font-weight: 400;
            letter-spacing: 0.5px;
            text-shadow: 0 1px 2px rgba(255, 255, 255, 0.1);
        }

        .form-label {
            color: #e0e0e0;
            font-weight: 400;
            letter-spacing: 0.3px;
            margin-bottom: 0.5rem;
        }

        .form-control {
            background: #2d2d2d;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #e0e0e0;
            border-radius: 6px;
            padding: 0.6rem 1rem;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            background: #363636;
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
            color: white;
        }

        .form-control.is-invalid {
            background: #2d2d2d;
            border-color: #e74c3c;
        }

        .invalid-feedback {
            color: #e74c3c;
            font-size: 0.85rem;
            margin-top: 0.3rem;
        }

        /* Стили для кнопок */
        .btn {
            border-radius: 6px;
            font-weight: 400;
            text-transform: none;
            letter-spacing: 0.3px;
            transition: all 0.2s ease;
            padding: 0.6rem 1.5rem;
        }

        .btn-success {
            background: linear-gradient(135deg, #27ae60, #229954);
            border: none;
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #229954, #1e8449);
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #4a5568, #2d3748);
            border: none;
            color: #e2e8f0;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #2d3748, #1a202c);
            color: white;
            transform: translateY(-1px);
        }

        .btn-danger {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            border: none;
            color: white;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
        }

        /* Стили для ссылки "Отмена" */
        .btn-secondary:first-of-type {
            background: linear-gradient(135deg, #4a5568, #2d3748);
        }

        /* Форма удаления */
        .mt-3.text-end form {
            display: inline-block;
        }

        /* Адаптация placeholder */
        .form-control::placeholder {
            color: #888;
            opacity: 0.7;
        }

        /* Стили для числового поля */
        input[type="number"] {
            -moz-appearance: textfield;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            opacity: 0.5;
            background: #4a5568;
        }

        /* Эффект при наведении на карточку */
        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.6);
        }

        /* Разделитель между формами */
        .mt-3.text-end {
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 1.5rem;
            margin-top: 1.5rem !important;
        }

        /* Стили для сообщений об ошибках валидации */
        .alert-danger {
            background: rgba(231, 76, 60, 0.1);
            border: 1px solid rgba(231, 76, 60, 0.3);
            color: #e74c3c;
            border-radius: 6px;
        }

        /* Кастомный скроллбар */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #1a1a1a;
        }

        ::-webkit-scrollbar-thumb {
            background: #444;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header bg-warning">
                        <h4 class="mb-0">Редактировать игрока</h4>
                    </div>
                    <div class="card-body">
                        {{-- Форма обновления --}}
                        <form action="{{ route('players.update', $player->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Имя *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name', $player->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="position" class="form-label">Позиция</label>
                                <input type="text" class="form-control @error('position') is-invalid @enderror"
                                    id="position" name="position" value="{{ old('position', $player->position) }}">
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="team" class="form-label">Команда</label>
                                <input type="text" class="form-control @error('team') is-invalid @enderror" id="team"
                                    name="team" value="{{ old('team', $player->team) }}">
                                @error('team')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="number" class="form-label">Номер</label>
                                <input type="number" class="form-control @error('number') is-invalid @enderror" id="number"
                                    name="number" value="{{ old('number', $player->number) }}" min="1" max="99">
                                @error('number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('players.index') }}" class="btn btn-secondary">Отмена</a>
                                <div>
                                    <button type="submit" class="btn btn-success">Обновить</button>
                                </div>
                            </div>
                        </form>

                        {{-- Форма удаления - отдельно, после формы обновления --}}
                        <div class="mt-3 text-end">
                            <form action="{{ route('players.destroy', $player) }}" method="POST"
                                onsubmit="return confirm('Удалить игрока?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить игрока</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection