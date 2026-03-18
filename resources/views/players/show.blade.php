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

        .btn {
            border-radius: 6px;
            font-weight: 400;
            text-transform: none;
            letter-spacing: 0.3px;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3498db, #2980b9);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2980b9, #3498db);
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
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
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            border: none;
            color: #2c3e50;
        }

        .btn-warning:hover {
            color: #2c3e50;
            transform: translateY(-1px);
        }

        .form-select {
            background: #2d2d2d;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #e0e0e0;
            transition: all 0.2s ease;
        }

        .form-select:focus {
            background: #363636;
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
            color: white;
        }

        .form-select option {
            background: #2d2d2d;
            color: #e0e0e0;
        }

        .form-check-input {
            background-color: #2d2d2d;
            border-color: rgba(255, 255, 255, 0.2);
        }

        .form-check-input:checked {
            background-color: #3498db;
            border-color: #3498db;
        }

        .form-check-label {
            color: #e0e0e0;
            font-size: 0.9rem;
        }

        .alert-secondary {
            background: rgba(45, 55, 72, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.05);
            color: #e2e8f0;
            backdrop-filter: blur(5px);
        }
    </style>
    <div class="container-fluid mt-1">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Информация об игроке</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-dark fs-3">
                            <tr>
                                <th style="width: 120px;">ID:</th>
                                <td>{{ $player->id }}</td>
                            </tr>
                            <tr>
                                <th>Имя:</th>
                                <td>{{ $player->name }}</td>
                            </tr>
                            <tr>
                                <th>Позиция:</th>
                                <td>{{ $player->position ?? '—' }}</td>
                            </tr>
                            <tr>
                                <th>Команда:</th>
                                <td>{{ $player->team ?? '—' }}</td>
                            </tr>
                            <tr>
                                <th>Номер:</th>
                                <td>{{ $player->number ?? '—' }}</td>
                            </tr>
                        </table>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('players.index') }}" class="btn btn-secondary">← Назад</a>
                            <div class="d-flex gap-2">
                                <form action="{{ route('players.destroy', $player) }}" method='post'>
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Удалить игрока?')">
                                        Удалить
                                    </button>
                                </form>
                                <form action="{{ route('players.scores.clearAllScores', $player) }}" method='post'>
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Очистить очки игрока?')">
                                        Очистить очки игрока
                                    </button>
                                </form>
                                <a href="{{ route('players.edit', $player) }}" class="btn btn-secondary">Редактировать</a>
                            </div>
                        </div>
                        <div class="border border-1 p-3 mt-2 bg-dark">
                            <form class="d-flex flex-row justify-content-between mt-5" method="post" id="display-options">
                                @csrf
                                <div
                                    class="form-check form-switch d-flex flex-column align-content-center align-items-center">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label text-white">1 зона</label>
                                </div>
                                <div
                                    class="form-check form-switch d-flex flex-column align-content-center align-items-center">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label text-white">2 зона</label>
                                </div>
                                <div
                                    class="form-check form-switch d-flex flex-column align-content-center align-items-center">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label text-white">3 зона</label>
                                </div>
                                <div
                                    class="form-check form-switch d-flex flex-column align-content-center align-items-center">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label text-white">4 зона</label>
                                </div>
                                <div
                                    class="form-check form-switch d-flex flex-column align-content-center align-items-center">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label text-white">6 зона</label>
                                </div>
                                <div
                                    class="form-check form-switch d-flex flex-column align-content-center align-items-center">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label text-white">Скидки</label>
                                </div>
                                <div
                                    class="form-check form-switch d-flex flex-column align-content-center align-items-center">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label text-white">Подачи</label>
                                </div>
                                <button type="submit" class="btn btn-secondary">Применить</button>
                            </form>

                            <div class="card-body">
                                <div class="d-flex justify-content-center align-items-center p-1 mb-4"
                                    style="background-color: #1ea5b4; height: 500px;">
                                    <canvas id="court" width="900" height="450"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-secondary py-2 px-3 mb-3 small d-flex flex-wrap gap-3 justify-content-around"
                            style="font-size: 0.9rem;">
                            <span>⚡ <strong>E/У</strong> - Удар</span>
                            <span>🖐️ <strong>С/C</strong> - Скидка</span>
                            <span>🏐 <strong>G/П</strong> - Подача</span>
                            <span>✅ <strong>1</strong> - Успех</span>
                            <span>❌ <strong>2</strong> - Проигрыш</span>
                            <span>▷ <strong>3</strong> - В игре</span>
                            <span>⏎ <strong>ENTER</strong> - Добавить</span>
                        </div>
                        <form action="{{ route('players.scores.store', $player) }}" method="post" id="scores-form">
                            @csrf
                            <input type="hidden" name="player_id" value="{{ $player->id }}">
                            <div class="d-flex flex-row justify-content-center gap-3">
                                <div
                                    class="d-flex flex-column justify-content-center align-content-center align-items-center">
                                    <label class="fw-bold text-white">Атака из зоны</label>
                                    <select name="x" class="form-select fw-bold bg-dark text-white">
                                        <option value="" selected>Атака из зоны</option>
                                        <option class="fw-bold" value="6">6 зона</option>
                                        <option class="fw-bold" value="4">4 зона</option>
                                        <option class="fw-bold" value="3">3 зона</option>
                                        <option class="fw-bold" value="2">2 зона</option>
                                        <option class="fw-bold" value="1">1 зона</option>
                                        <option class="fw-bold" value="Подача">Подача</option>
                                    </select>
                                </div>
                                <div
                                    class="d-flex flex-column justify-content-center align-content-center align-items-center">
                                    <label class="fw-bold text-white">Атака в зону</label>
                                    <select name="y" class="form-select fw-bold bg-dark text-white">
                                        <option class="fw-bold" value="" selected>Атака в ...</option>
                                        <option class="fw-bold" value="1">1 зона</option>
                                        <option class="fw-bold" value="1/2">Между 1 и 2 зоной</option>
                                        <option class="fw-bold" value="2">2 зона</option>
                                        <option class="fw-bold" value="3">3 зона</option>
                                        <option class="fw-bold" value="4">4 зона</option>
                                        <option class="fw-bold" value="4/5">Между 4 и 5 зоной</option>
                                        <option class="fw-bold" value="5">5</option>
                                        <option class="fw-bold" value="5/6">Между 5 и 6 зоной</option>
                                        <option class="fw-bold" value="6">6 зона</option>
                                        <option class="fw-bold" value="1/6">Между 1 и 6 зоной</option>
                                        <option class="fw-bold" value="3/6">Котел (между 6 и 3 зоной)</option>
                                    </select>
                                </div>
                                <div
                                    class="d-flex flex-column justify-content-center align-content-center align-items-center">
                                    <label class="fw-bold text-white">Тип атаки</label>
                                    <select name="type" class="form-select fw-bold bg-dark text-white">
                                        <option class="fw-bold" value="" selected>Тип атаки ...</option>
                                        <option class="fw-bold" value="Удар">Удар</option>
                                        <option class="fw-bold" value="Скидка">Скидка</option>
                                        <option class="fw-bold" value="Подача">Подача</option>
                                    </select>
                                </div>
                                <div
                                    class="d-flex flex-column justify-content-center align-content-center align-items-center">
                                    <label class="fw-bold text-white">Результат</label>
                                    <select name="result" class="form-select fw-bold bg-dark text-white">
                                        <option value="" selected>Результат ...</option>
                                        <option class="text-success fw-bold" value="true">✅ Успех</option>
                                        <option class="text-danger fw-bold" value="false">❌ Проигрыш</option>
                                        <option class="text-primary fw-bold" value="null"> ▷ Осталось в игре</option>
                                    </select>
                                </div>
                                <div
                                    class="d-flex flex-column justify-content-center align-content-center align-items-center">
                                    <label>&#8203;</label>
                                    <button type="submit" class="btn btn-secondary">Добавить</button>
                                </div>

                            </div>


                            <div class="mt-5">
                                <table
                                    class="table table-sm table-bordered table-hover text-center align-middle table-dark">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Всего атак</th>
                                            <th>Успешных атак</th>
                                            <th>Проиграно</th>
                                            <th>Осталось в игре</th>
                                            <th>% Успешных</th>
                                            <th>% Проигранных</th>
                                            <th>% Оставшихся</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold">
                                                {{ $player->scores->whereIn('type', ['Удар', 'Скидка'])->count() }}
                                            </td>
                                            <td class="text-success fw-bold">
                                                {{ $player->scores->whereIn('type', ['Удар', 'Скидка'])->where('result', 'true')->count() }}
                                            </td>
                                            <td class="text-danger fw-bold">
                                                {{ $player->scores->whereIn('type', ['Удар', 'Скидка'])->where('result', 'false')->count() }}
                                            </td>
                                            <td class="text-secondary fw-bold">
                                                {{ $player->scores->whereIn('type', ['Удар', 'Скидка'])->where('result', 'null')->count() }}
                                            </td>

                                            @php
                                                $total = $player->scores->whereIn('type', ['Удар', 'Скидка'])->count();
                                                $success = $player->scores->whereIn('type', ['Удар', 'Скидка'])->where('result', 'true')->count();
                                                $fail = $player->scores->whereIn('type', ['Удар', 'Скидка'])->where('result', 'false')->count();
                                                $pending = $player->scores->whereIn('type', ['Удар', 'Скидка'])->where('result', 'null')->count();

                                                $successPercent = $total > 0 ? round(($success / $total) * 100, 1) : 0;
                                                $failPercent = $total > 0 ? round(($fail / $total) * 100, 1) : 0;
                                                $pendingPercent = $total > 0 ? round(($pending / $total) * 100, 1) : 0;
                                            @endphp

                                            <td class="text-success">{{ $successPercent }}%</td>
                                            <td class="text-danger">{{ $failPercent }}%</td>
                                            <td class="text-secondary">{{ $pendingPercent }}%</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table
                                    class="table table-sm table-bordered table-hover text-center align-middle table-dark">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Зона атаки</th>
                                            <th>Чаще всего бьют в</th>
                                            <th>Чаще всего скидывают в</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(['1', '2', '3', '4', '6', 'Подача'] as $zone)
                                            @php
                                                $zoneScores = $player->scores->where('x', $zone);

                                                $topTarget = $zoneScores->groupBy('y')->map->count()->sortDesc()->keys()->first();
                                                $topTip = $zoneScores->where('type', 'Скидка')->groupBy('y')->map->count()->sortDesc()->keys()->first();

                                            @endphp

                                            <tr>
                                                <td class="fw-bold">{{ $zone }}</td>
                                                <td class="{{ $topTarget ? 'text-primary' : 'text-white' }}">
                                                    {{ $topTarget ?? '—' }}
                                                </td>
                                                <td class="{{ $topTip ? 'text-success' : 'text-white' }}">
                                                    {{ $topTip ?? '—' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <table
                                    class="table table-sm table-bordered table-hover text-center align-middle table-dark">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Зона атаки</th>
                                            <th>Всего</th>
                                            <th>1</th>
                                            <th>М/у 1 и 2</th>
                                            <th>2</th>
                                            <th>3</th>
                                            <th>М/у 3 и 6 (котел)</th>
                                            <th>4</th>
                                            <th>М/у 4 и 5</th>
                                            <th>5</th>
                                            <th>М/у 5 и 6</th>
                                            <th>6</th>
                                            <th>М/у 1 и 6</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $attackZones = ['1', '2', '3', '4', '6', 'Подача'];
                                            $targetZones = ['1', '1/2', '2', '3', '3/6', '4', '4/5', '5', '5/6', '6', '1/6'];
                                        @endphp

                                        @foreach($attackZones as $zone)
                                            @php
                                                $zoneScores = $player->scores->where('x', $zone);
                                                $zoneTotal = $zoneScores->count();
                                            @endphp
                                            <tr>
                                                <td class="fw-bold">{{ $zone }}</td>
                                                <td class="fw-bold">{{ $zoneTotal }}</td>

                                                @foreach($targetZones as $target)
                                                    @php
                                                        $count = $zoneScores->where('y', $target)->count();
                                                        $percent = $zoneTotal > 0 ? round(($count / $zoneTotal) * 100, 1) : 0;
                                                    @endphp
                                                    <td>
                                                        {{ $count > 0 ? $count : "—" }}
                                                        @if($count > 0)
                                                            <small class="text-white">({{ $percent }}%)</small>
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                            </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // ================== НАСТРОЙКИ ==================
            const ZONE_RADIUS = 20;
            const HOVER_RADIUS = 25;
            const SELECTED_OPACITY = 1.0;
            const NORMAL_OPACITY = 0.5;

            // ================== ИНИЦИАЛИЗАЦИЯ ==================
            const ctx = document.getElementById('court').getContext('2d');

            const team_zones = {
                '1': [300, 405], '2': [420, 405], '3': [420, 225],
                '4': [420, 55], '6': [300, 225], 'Подача': [5, 405]
            };

            const enemy_zones = {
                '1': [730, 55], '1/2': [600, 55], '2': [480, 55],
                '3': [480, 225], '3/6': [650, 225], '4': [480, 405],
                '4/5': [600, 405], '5': [730, 405], '5/6': [825, 325],
                '6': [850, 225], '1/6': [825, 125]
            };

            // ================== СОСТОЯНИЕ ==================
            let selectedFromZone = null;
            let selectedToZone = null;
            let hoveredZone = null;        // текущая точка под курсором
            let hoveredType = null;        // 'team' или 'enemy'

            const fromSelect = document.querySelector('select[name="x"]');
            const toSelect = document.querySelector('select[name="y"]');

            // ================== ВСПОМОГАТЕЛЬНЫЕ ФУНКЦИИ ==================
            function random(min, max) {
                return Math.random() * (max - min) + min;
            }

            function findZone(x, y, zones) {
                for (let [zone, coords] of Object.entries(zones)) {
                    const dist = Math.sqrt((x - coords[0]) ** 2 + (y - coords[1]) ** 2);
                    if (dist < 30) return zone;
                }
                return null;
            }

            // ================== ОТРИСОВКА ==================
            function drawLine(x, y, color) {
                ctx.beginPath();
                let fromCoords = team_zones[x];
                let toCoords = enemy_zones[y];
                if (fromCoords && toCoords) {
                    ctx.moveTo(fromCoords[0], fromCoords[1]);
                    ctx.lineTo(toCoords[0] + random(0, 30), toCoords[1] + random(0, 30));
                    ctx.strokeStyle = color;
                    ctx.lineWidth = 2;
                    ctx.stroke();
                }
            }

            function drawPlayerScores() {
                const scores = @json($player->scores);
                scores.forEach(score => {
                    if (score.x && score.x) {
                        let color;
                        if (score.result == 1 || score.result === '1' || score.result == 'true') color = 'green';
                        else if (score.result == 0 || score.result === '0' || score.result == 'false') color = 'red';
                        else color = 'lightgray';
                        drawLine(score.x, score.y, color);
                    }
                });
            }

            function drawZones() {
                // Рисуем свои зоны
                Object.entries(team_zones).forEach(([zone, coords]) => {
                    ctx.beginPath();

                    // Определяем радиус (больше если под курсором)
                    let radius = (hoveredZone === zone && hoveredType === 'team') ? HOVER_RADIUS : ZONE_RADIUS;
                    ctx.arc(coords[0], coords[1], radius, 0, 2 * Math.PI);

                    // Определяем прозрачность (без прозрачности если выбрана)
                    let opacity = (zone === selectedFromZone) ? SELECTED_OPACITY : NORMAL_OPACITY;
                    ctx.fillStyle = zone === selectedFromZone
                        ? `rgba(0, 255, 0, ${opacity})`      // зеленая если выбрана
                        : `rgba(250, 250, 250, ${opacity})`;     // красная если нет
                    ctx.fill();
                });

                // Рисуем зоны противника
                Object.entries(enemy_zones).forEach(([zone, coords]) => {
                    ctx.beginPath();

                    let radius = (hoveredZone === zone && hoveredType === 'enemy') ? HOVER_RADIUS : ZONE_RADIUS;
                    ctx.arc(coords[0], coords[1], radius, 0, 2 * Math.PI);

                    let opacity = (zone === selectedToZone) ? SELECTED_OPACITY : NORMAL_OPACITY;
                    ctx.fillStyle = zone === selectedToZone
                        ? `rgba(0, 255, 0, ${opacity})`      // зеленая если выбрана
                        : `rgba(255, 0, 0, ${opacity})`;   // желтая если нет
                    ctx.fill();
                });
            }

            function drawCourt() {
                // Фон
                ctx.fillStyle = "coral";
                ctx.fillRect(0, 0, 900, 450);

                // Разметка
                ctx.strokeStyle = "white";
                ctx.strokeRect(0, 0, 900, 450);
                ctx.strokeRect(300, 0, 2, 450);
                ctx.strokeRect(450, 0, 2, 450);
                ctx.strokeRect(600, 0, 2, 450);
            }

            function redrawCanvas() {
                ctx.clearRect(0, 0, 900, 450);
                drawCourt();
                drawZones();

                // Рисуем линию между выбранными зонами
                if (selectedFromZone && selectedToZone) {
                    ctx.beginPath();
                    ctx.moveTo(team_zones[selectedFromZone][0], team_zones[selectedFromZone][1]);
                    ctx.lineTo(enemy_zones[selectedToZone][0], enemy_zones[selectedToZone][1]);
                    ctx.strokeStyle = 'white';
                    ctx.lineWidth = 3;
                    ctx.stroke();
                }

                drawPlayerScores();
            }

            // ================== ОБРАБОТЧИКИ ==================
            // Клик на canvas
            document.getElementById('court').addEventListener('click', function (e) {
                const rect = this.getBoundingClientRect();
                const scaleX = this.width / rect.width;
                const scaleY = this.height / rect.height;

                const mouseX = (e.clientX - rect.left) * scaleX;
                const mouseY = (e.clientY - rect.top) * scaleY;

                const teamZone = findZone(mouseX, mouseY, team_zones);
                if (teamZone) {
                    selectedFromZone = teamZone;
                    fromSelect.value = teamZone;
                    redrawCanvas();
                    return;
                }

                const enemyZone = findZone(mouseX, mouseY, enemy_zones);
                if (enemyZone) {
                    selectedToZone = enemyZone;
                    toSelect.value = enemyZone;
                    redrawCanvas();
                }
            });

            // Наведение мыши на canvas
            document.getElementById('court').addEventListener('mousemove', function (e) {
                const rect = this.getBoundingClientRect();
                const scaleX = this.width / rect.width;
                const scaleY = this.height / rect.height;

                const mouseX = (e.clientX - rect.left) * scaleX;
                const mouseY = (e.clientY - rect.top) * scaleY;

                // Проверяем свои зоны
                const teamZone = findZone(mouseX, mouseY, team_zones);
                if (teamZone) {
                    hoveredZone = teamZone;
                    hoveredType = 'team';
                    this.style.cursor = 'pointer';
                    redrawCanvas();
                    return;
                }

                // Проверяем зоны противника
                const enemyZone = findZone(mouseX, mouseY, enemy_zones);
                if (enemyZone) {
                    hoveredZone = enemyZone;
                    hoveredType = 'enemy';
                    this.style.cursor = 'pointer';
                    redrawCanvas();
                    return;
                }

                // Если ни над чем
                if (hoveredZone !== null) {
                    hoveredZone = null;
                    hoveredType = null;
                    this.style.cursor = 'default';
                    redrawCanvas();
                }
            });

            // Изменение селектов
            fromSelect.addEventListener('change', function () {
                selectedFromZone = this.value || null;
                redrawCanvas();
            });

            toSelect.addEventListener('change', function () {
                selectedToZone = this.value || null;
                redrawCanvas();
            });

            // Обработчик фильтрации
            document.querySelector('form.d-flex.flex-row.justify-content-between.mt-5 button[type="submit"]').addEventListener('click', function (e) {
                e.preventDefault();

                let checkboxes = document.querySelectorAll('form.d-flex.flex-row.justify-content-between.mt-5 .form-check-input');
                let selectedZones = [];
                let selectedTypes = [];

                checkboxes.forEach((cb, index) => {
                    if (cb.checked) {
                        if (index < 5) {
                            let zones = ['1', '2', '3', '4', '6'];
                            selectedZones.push(zones[index]);
                        }
                        else if (index === 5) selectedTypes.push('Скидка');
                        else if (index === 6) {
                            selectedTypes.push('Подача');
                            selectedZones.push('Подача');
                        }
                    }
                });

                const allScores = @json($player->scores);
                let filteredScores = allScores.filter(score => {
                    let zoneMatch = selectedZones.length === 0 || selectedZones.includes(score.x.toString());
                    let typeMatch = selectedTypes.length === 0 || selectedTypes.includes(score.type);
                    return zoneMatch && typeMatch;
                });

                if (selectedZones.length === 0 && selectedTypes.length === 0) filteredScores = allScores;

                ctx.clearRect(0, 0, 900, 450);
                drawCourt();

                ctx.fillStyle = 'red';
                Object.values(team_zones).forEach(coords => {
                    ctx.beginPath();
                    ctx.arc(coords[0], coords[1], 10, 0, 2 * Math.PI);
                    ctx.fill();
                });

                filteredScores.forEach(score => {
                    if (score.x && score.y) {
                        let color;
                        if (score.result == 1 || score.result === '1' || score.result == 'true') color = 'green';
                        else if (score.result == 0 || score.result === '0' || score.result == 'false') color = 'red';
                        else color = 'lightgray';

                        ctx.beginPath();
                        ctx.moveTo(team_zones[score.x][0], team_zones[score.x][1]);
                        ctx.lineTo(enemy_zones[score.y][0] + random(0, 30), enemy_zones[score.y][1] + random(0, 30));
                        ctx.strokeStyle = color;
                        ctx.lineWidth = 2;
                        ctx.stroke();
                    }
                });
            });

            // Обработчик клавиш Enter/Space
            document.addEventListener('keydown', function (e) {
                if ((e.key === 'Enter' || e.key === 'Space') && selectedFromZone && selectedToZone) {
                    e.preventDefault();
                    document.getElementById('scores-form').submit();
                }

                if (e.key === '1') { // Успех
                    document.querySelector('select[name="result"]').value = 'true';
                    e.preventDefault();
                }
                if (e.key === '2') { // Проигрыш
                    document.querySelector('select[name="result"]').value = 'false';
                    e.preventDefault();
                }
                if (e.key === '3') { // В игре
                    document.querySelector('select[name="result"]').value = 'null';
                    e.preventDefault();
                }

                // Буквы для типа атаки
                if (e.key === 'e' || e.key === 'у') { // Удар
                    document.querySelector('select[name="type"]').value = 'Удар';
                    e.preventDefault();
                }
                if (e.key === 'c' || e.key === 'с') { // Скидка
                    document.querySelector('select[name="type"]').value = 'Скидка';
                    e.preventDefault();
                }
                if (e.key === 'g' || e.key === 'п') { // Подача
                    document.querySelector('select[name="type"]').value = 'Подача';
                    e.preventDefault();
                }
            });

            // Стартовая отрисовка
            redrawCanvas();

        </script>
@endsection