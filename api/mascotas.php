
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />

    <link rel="stylesheet" href="css/mascotas.css">
    <title>Alta Mascotas</title>
    <link rel="icon" type="image/png" href="img/patita.png" />
</head>

<body>
    <div class="container mt-5">
        <div class="card text-dark bg-light scroll">
            <div class="card-body">
                <h2 class="card-title">Registrar una mascota</h2>

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Oh no, un error!</strong> Deberias verificar alguno de los campos aquí abajo.
                    <button type="button" class="btn btn-danger close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div><br>

                <form>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" aria-describedby="nombre"
                            placeholder="Nombre...">
                    </div><br>
                    <div class="form-group">
                        <label for="apellidos">Raza</label>
                        <input type="text" class="form-control" id="raza" placeholder="Raza...">
                    </div><br>
                    <div class="form-floating">
                        <textarea style="height: 160px;" class="form-control" placeholder="Introduce una breve descripción..."
                            id="descripcion"></textarea>
                        <label for="descripcion">Descripción</label>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <select class="form-control" id="tipo">
                            <option value="perro">Perro 🐶</option>
                            <option value="gato">Gato 🐱</option>
                        </select>
                    </div>

                    <br><br>
                    <button id="register" class="btn btn-primary">Registrar Mascota</button>
                    <button class="btn btn-danger cancelar">Concelar</button>
                </form>

            </div>
        </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
        integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>
     <script src="">
         const session = "<?php echo json_decode($_SESSION); ?>"
     </script>   
    <script src="./js/mascotas.js"></script>
</body>

</html>