<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD MYSQLI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<style>
    body {
        background: linear-gradient(135deg, #0F0F1A, #1A1A2E);
        color: #000000 !important;
        min-height: 100vh;
    }

    h1.bg-warning {
        background: linear-gradient(90deg, #00D4FF, #6C4EF8) !important;
        color: #000000 !important;
        font-weight: 700;
        border-bottom: 2px solid rgba(0, 212, 255, 0.3);
        box-shadow: 0 4px 20px rgba(0, 212, 255, 0.2);
    }

    .container a.btn-danger {
        background: linear-gradient(90deg, #FF6B6B, #FFD166);
        border: none;
        color: #000000;
        font-weight: 600;
        padding: 12px 25px;
        border-radius: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
    }

    .container a.btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(255, 107, 107, 0.4);
        background: linear-gradient(90deg, #FFD166, #FF6B6B);
        color: #000000;
    }

    .container.bg-light {
        background: linear-gradient(135deg, rgba(26, 26, 46, 0.9), rgba(15, 15, 26, 0.95)) !important;
        border: 1px solid rgba(0, 212, 255, 0.2) !important;
        border-radius: 12px !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(10px);
    }

    .container.bg-light h1 {
        color: #000000 !important;
        background: linear-gradient(90deg, #00D4FF, #6C4EF8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .table {
        background: rgba(15, 15, 26, 0.7);
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid rgba(0, 212, 255, 0.2);
        color: #000000 !important;
    }

    .table-dark {
        background: linear-gradient(90deg, #00D4FF, #6C4EF8) !important;
        color: #000000 !important;
    }

    .table-dark th {
        border: none;
        font-weight: 700;
        padding: 15px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #000000 !important;
    }

    .table tbody tr {
        background: rgba(26, 26, 46, 0.6);
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(0, 212, 255, 0.1);
        color: #000000 !important;
    }

    .table tbody tr:hover {
        background: rgba(0, 212, 255, 0.1);
        transform: scale(1.01);
        color: #000000 !important;
    }

    .table tbody th {
        color: #000000 !important;
        font-weight: 500;
        padding: 12px 15px;
        border: none;
    }

    .btn-warning {
        background: linear-gradient(90deg, #00D4FF, #00FF9D);
        border: none;
        color: #000000;
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 6px;
        transition: all 0.3s ease;
        box-shadow: 0 3px 10px rgba(0, 212, 255, 0.3);
    }

    .btn-warning:hover {
        background: linear-gradient(90deg, #00FF9D, #00D4FF);
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(0, 212, 255, 0.4);
        color: #000000;
    }

    .btn-danger {
        background: linear-gradient(90deg, #FF6B6B, #FFD166);
        border: none;
        color: #000000;
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 6px;
        transition: all 0.3s ease;
        box-shadow: 0 3px 10px rgba(255, 107, 107, 0.3);
    }

    .btn-danger:hover {
        background: linear-gradient(90deg, #FFD166, #FF6B6B);
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(255, 107, 107, 0.4);
        color: #000000;
    }

    .container {
        padding: 20px;
    }

    * {
        color: #000000 !important;
    }

    th, td, h1, h2, h3, h4, h5, h6, p, span, div, a {
        color: #000000 !important;
    }

    .table th, .table td {
        color: #000000 !important;
    }

    @media (max-width: 768px) {
        .table-responsive {
            border-radius: 8px;
            border: 1px solid rgba(0, 212, 255, 0.2);
        }
        
        .btn {
            margin-bottom: 5px;
            width: 100%;
        }
        
        .table-dark th {
            padding: 10px 8px;
            font-size: 0.9rem;
            color: #000000 !important;
        }
        
        .table tbody th {
            padding: 8px 6px;
            font-size: 0.85rem;
            color: #000000 !important;
        }
    }
</style>
<body>
    <h1 class="bg-warning p-2 text-white text-center">CRUD MYSQLI</h1>
    <br>
    <div class="container">
        <a href="../html/crearusuario.html" class="btn btn-danger">agregar cliente</a>
    </div>
    <br>
    <div class="container bg-light p-3 border border-dark rounded">
        <h1>lista de clientes</h1>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">nombre</th>
                    <th scope="col">apellido</th>
                    <th scope="col">fnacimiento</th>
                    <th scope="col">contraseña</th>
                    <th scope="col">acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once('../config/conexion.php');

                $sql = "SELECT * FROM usuario";
                $query = mysqli_query($conexion, $sql);

                while ($fila = mysqli_fetch_array($query)) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $fila['id']?></th>
                        <th scope="row"><?php echo $fila['nombre']?></th>
                        <th scope="row"><?php echo $fila['apellido']?></th>
                        <th scope="row"><?php echo $fila['fnacimiento']?></th>
                        <th scope="row"><?php echo $fila['contraseña']?></th>
                        <th scope="row">
                            <a href="../php/editardato.php?id=<?php echo $fila['id']?>" class="btn btn-warning">editar datos</a>
                            <a href="../php/eliminardato.php?id=<?php echo $fila['id']?>" class="btn btn-danger">eliminar datos</a>
                        </th>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" 
    crossorigin="anonymous"></script>
</body>
</html>