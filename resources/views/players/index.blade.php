@extends('layouts.app')
@section('title', 'Игроки')
@section('content')
    <style>
        .pagination {
            --bs-pagination-bg: #2d2d2d;
            --bs-pagination-border-color: #444;
            --bs-pagination-color: #e0e0e0;
            --bs-pagination-hover-bg: #444;
            --bs-pagination-hover-color: #fff;
            --bs-pagination-hover-border-color: #555;
            --bs-pagination-focus-bg: #2d2d2d;
            --bs-pagination-focus-color: #fff;
            --bs-pagination-focus-box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.1);
            --bs-pagination-active-bg: #666;
            --bs-pagination-active-border-color: #666;
            --bs-pagination-active-color: #fff;
            --bs-pagination-disabled-bg: #1a1a1a;
            --bs-pagination-disabled-border-color: #333;
            --bs-pagination-disabled-color: #666;
        }

        .form-control::placeholder {
            color: white;
            font-size: 0.95em;
        }
    </style>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header d-flex justify-content-between bg-dark">
                        <h3 class="text-white">Список игроков</h3>
                        @can('view-players', auth()->user())
                            <a href="{{ route('players.create') }}" class="btn btn-secondary">Добавить</a>
                        @endcan
                    </div>
                    <div class="card-body" style="background-image: linear-gradient(to bottom, rgb(105, 105, 105), black);">
                        @can('view-players', auth()->user())

                            <form method="GET" action="{{ route('players.index') }}" class="row g-3" id="filter-form">
                                <div class="col-md-2">
                                    <input type="text" name="name" class="form-control bg-dark text-white" placeholder="Имя"
                                        value="{{ request('name') }}">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="position" class="form-control bg-dark text-white"
                                        placeholder="Позиция" value="{{ request('position') }}">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="team" class="form-control bg-dark text-white" placeholder="Команда"
                                        value="{{ request('team') }}">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="number" class="form-control bg-dark text-white"
                                        placeholder="Номер" value="{{ request('number') }}">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-secondary">Применить фильтр</button>
                                    <a href="{{ route('players.index') }}" class="btn btn-secondary">Сбросить</a>
                                </div>
                            </form>



                            <table class="table table-hover table-striped mt-2 table-dark">
                                <thead>
                                    <tr>
                                        <th>Имя</th>
                                        <th>Позиция</th>
                                        <th>Команда</th>
                                        <th>Номер</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($players as $player)
                                        <tr onclick="window.location='{{ route('players.show', $player->id) }}'"
                                            style="cursor: pointer;">
                                            <td class="fs-4 fw-medium">{{ $player->name }}</td>
                                            <td class="fs-4 fw-medium">{{ $player->position ?? 'Не указана' }}</td>
                                            <td class="fs-4 fw-medium">{{ $player->team ?? 'Без команды' }}</td>
                                            <td class="fs-4 fw-medium">{{ $player->number ?? 'Нет номера' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Игроки не найдены</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>

                            <div class="d-flex justify-content-center mt-4">
                                {{ $players->links('pagination::bootstrap-4') }}
                            </div>

                            <div class="text-white text-center mt-2">
                                Показано с {{ $players->firstItem() }} по {{ $players->lastItem() }}
                                из {{ $players->total() }} игроков
                            </div>
                        @else
                            <div>
                                <p class="text-center mt-3 fw-bold fs-4">Авторизуйтесь для отображения игроков</p>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('filter-form').submit();
            }
        }
    </script>
@endsection