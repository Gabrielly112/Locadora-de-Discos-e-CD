<?php
require_once __DIR__ . '/../services/Auth.php';
use Services\Auth;
$usuario = Auth::getUsuario();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RetroGroove - Locadora de Discos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f2f2f2;
            color: #111;
            font-family: Arial, sans-serif;
        }

        h1 {
            font-weight: 700;
            color: #111;
        }

        .card {
            border: none;
            border-radius: 12px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .card-header {
            background-color: #111;
            color: #fff;
            border-radius: 12px 12px 0 0 !important;
            padding: 15px;
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
            background-color: white;
        }

        .table thead {
            background-color: #111;
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: #f7f7f7;
        }

        .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: 0.2s;
        }

        .btn-primary {
            background-color: #111;
            border: none;
        }

        .btn-primary:hover {
            background-color: #000;
        }

        .btn-danger {
            background-color: #d11a2a;
            border: none;
        }

        .btn-warning {
            background-color: #555;
            border: none;
            color: white;
        }

        .btn-info {
            background-color: #222;
            border: none;
            color: white;
        }

        .btn-info:hover,
        .btn-warning:hover {
            background-color: #111;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #111;
            box-shadow: none;
        }

        .user-info {
            background-color: #111;
            padding: 10px 15px;
            border-radius: 10px;
            color: white;
        }

        .user-icon i {
            color: white;
        }

        .welcome-text strong {
            color: #fff;
            font-weight: bold;
        }

        .btn-outline-danger {
            border-color: #fff;
            color: #fff;
        }

        .btn-outline-danger:hover {
            background-color: white;
            color: #111;
        }

        .badge.bg-success {
            background-color: #111 !important;
        }

        .badge.bg-warning {
            background-color: #777 !important;
            color: white;
        }

        .action-wrapper { 
            display: flex;
            align-items: center; 
            gap: 0.5rem;
        }

        .btn-group-actions { 
            display: flex; 
            gap: 0.5rem; 
            align-items: center;
        }

        .rent-group { 
            display: flex; 
            align-items: center;
            gap: 0.5rem;
        }

        .days-input { 
            width: 60px !important; 
            text-align: center;
        }

        @media (max-width: 768px) {
            .action-wrapper,
            .btn-group-actions,
            .rent-group {
                flex-direction: column;
                width: 100%;
            }

            .days-input {
                width: 100% !important;
            }
        }
    </style>
</head>
<body class="container py-4">
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>RetroGroove - Locadora de Discos</h1>
                    <div class="d-flex align-items-center gap-3 user-info">
                        <span class="user-icon"><i class="bi bi-person-circle" style="font-size: 24px;"></i></span>
                        <span class="welcome-text">Bem-vindo, <strong><?= htmlspecialchars($usuario['username']) ?></strong></span>
                        <a href="?logout=1" class="btn btn-outline-danger d-flex align-items-center gap-1">
                            <i class="bi bi-box-arrow-right"></i> Sair
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($mensagem): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($mensagem) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <div class="row same-height-row">
            <?php if (Auth::isAdmin()): ?>
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header"><h4 class="mb-0">Adicionar Novo Disco</h4></div>
                    <div class="card-body">
                        <form method="post" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label class="form-label">Título do Álbum / Artista</label>
                                <input type="text" name="titulo" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Código de Identificação (UPC/EAN)</label>
                                <input type="text" name="codigo" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Formato</label>
                                <select name="tipo" class="form-select" required>
                                    <option value="Vinil">Disco de Vinil (LP)</option>
                                    <option value="CD">Compact Disc (CD)</option>
                                </select>
                            </div>
                            <button type="submit" name="adicionar" class="btn btn-primary w-100">Adicionar Disco</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="col-<?= Auth::isAdmin() ? 'md-6' : '12' ?>">
                <div class="card h-100">
                    <div class="card-header"><h4 class="mb-0">Calcular Previsão de Aluguel</h4></div>
                    <div class="card-body">
                        <form method="post" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label class="form-label">Formato</label>
                                <select name="tipo_calculo" class="form-select" required>
                                    <option value="Vinil">Vinil</option>
                                    <option value="CD">CD</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Quantidade de Dias</label>
                                <input type="number" name="dias_calculo" class="form-control" value="1" required>
                            </div>
                            <button type="submit" name="calcular" class="btn btn-info w-100">Calcular Previsão</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header"><h4 class="mb-0">Catálogo de Discos Cadastrados</h4></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Formato</th>
                                        <th>Título / Artista</th>
                                        <th>Código</th>
                                        <th>Status</th>
                                        <?php if (Auth::isAdmin()): ?><th>Ações</th><?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($locadora->listarDiscos() as $disco): ?>
                                    <tr>
                                        <td><?= $disco instanceof \Models\Vinil ? 'Vinil' : 'CD' ?></td>
                                        <td><?= htmlspecialchars($disco->getTitulo()) ?></td>
                                        <td><?= htmlspecialchars($disco->getCodigo()) ?></td>
                                        <td>
                                            <span class="badge bg-<?= $disco->isDisponivel() ? 'success' : 'warning' ?>">
                                                <?= $disco->isDisponivel() ? 'Disponível' : 'Alugado' ?>
                                            </span>
                                        </td>
                                        <?php if (Auth::isAdmin()): ?>
                                        <td>
                                            <div class="action-wrapper">
                                                <form method="post" class="btn-group-actions">
                                                    <input type="hidden" name="titulo" value="<?= htmlspecialchars($disco->getTitulo()) ?>">
                                                    <input type="hidden" name="codigo" value="<?= htmlspecialchars($disco->getCodigo()) ?>">
                                                    <button type="submit" name="deletar" class="btn btn-danger btn-sm delete-btn">Deletar</button>
                                                    <div class="rent-group">
                                                        <?php if (!$disco->isDisponivel()): ?>
                                                            <button type="submit" name="devolver" class="btn btn-warning btn-sm">Devolver</button>
                                                        <?php else: ?>
                                                            <input type="number" name="dias" class="form-control days-input" value="1" min="1" required>
                                                            <button type="submit" name="alugar" class="btn btn-primary btn-sm">Alugar</button>
                                                        <?php endif; ?>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>