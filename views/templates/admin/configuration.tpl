
<div class="panel">

    <div class="panel-heading">
        <h3>{$title}</h3>
    </div>

    <form method="post" id="form">
    
    <div class="panel-body">
        <p class="card-text">{$content}</p>   

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name" class="form-label">Nombre del descuento:</label>
                <input type="text" class="form-control"  id="nombre_descuento" name="nombre_descuento">

                <label for="id_usuario" class="form-label">id_usuario:</label>
                <input type="text" class="form-control"  id="id_usuario" name="id_usuario">
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Tipo:</label>
                <select id="tipo_descuento" name="tipo_descuento" class="form-control">
                    <option value="portcentaje" selected>Porcentaje...</option>
                    <option value="monto">Monto</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="name" class="form-label">Descuento:</label>
                <input type="text" class="form-control"  id="valor_descuento" name="valor_descuento">
            </div>
        </div>

        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="aplicar_a" name="aplicar_a">
                <label class="form-check-label" for="aplicar_a">
                    Aplicar a todos los productos
                </label>
            </div>
        </div>
    </div>

    <div class="panel-footer">
        <button type="submit" class="btn btn-primary" id="btnSubmit" name="btnSubmit">Guardar</button>
    </div>

    </form>

</div>

