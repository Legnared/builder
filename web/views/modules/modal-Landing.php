<!-- The Modal -->
<div class="modal fade" id="myLanding">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form method="POST" class="needs-validation" novalidate>

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Gestión de Landing</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <!-- Titulo de la Landing-->
                    <div class=" was-validated">
                        <label for="title_landing">Título de la Página: </label>
                        <input 
                        type="text" 
                        class="form-control" 
                        name="title_landing" 
                        id="title_landing"
                        placeholder="Ingrese el título de la página"
                        onchange="validateJS(event, 'text')"
                        required>

                        <div class="valid-feedback">Válido.</div>
                        <div class="invalid-feedback">Campo inválido.</div>
                    </div>

                    <!-- URL de la Landing-->
                    <div class="my-3">
                        <label for="url_landing">URL de la Página: </label>
                        <input 
                        type="text" 
                        class="form-control" 
                        name="url_landing" 
                        id="url_landing"
                        placeholder="Ingrese el URL de la página" 
                        readonly
                        required>
                        <div class="valid-feedback">Válido.</div>
                        <div class="invalid-feedback">Campo inválido.</div>
                    </div>

                    <input type="hidden" id="pluginsList" name="pluginsList" value='["_0"]'>
                    <!-- PLUGINS de la Landing-->
                    <label for="plugins_landing_0">Plugings: </label>
                    <div class="blockPlugins">
                        <input type="text" class="form-control itemsPlugins mb-3" name="plugins_landing_0" id="plugins_landing_0"
                            placeholder="Ingrese el plugin de la página">
                        <div class="valid-feedback">Válido.</div>
                        <div class="invalid-feedback">Campo inválido.</div>
                    </div>

                    <button type="button" class="btn btn-sm btn-outline-secondary mb-3 addPlugin">Agregar Plugin</button>

                    <!-- Portada de la Landing-->
                    <div class="my-3">
                        <label for="icon_landing">Icono de la Página: </label>
                        <input type="text" class="form-control" name="icon_landing" id="icon_landing"
                            placeholder="Ingrese el URL del icono de la página" required>
                        <div class="valid-feedback">Válido.</div>
                        <div class="invalid-feedback">Campo inválido.</div>
                    </div>

                    <!-- Cover de la Landing-->
                    <div class="my-3">
                        <label for="cover_landing">Portada de la Página: </label>
                        <input type="text" class="form-control" name="cover_landing" id="cover_landing"
                            placeholder="Ingrese el URL de la portada de la página" required>
                        <div class="valid-feedback">Válido.</div>
                        <div class="invalid-feedback">Campo inválido.</div>
                    </div>

                    <!-- Descripción de la Landing-->
                    <div class="my-3">
                        <label for="descripcion_landing">Descripción de la Página: </label>
                        <input type="text" class="form-control" name="descripcion_landing" id="descripcion_landing"
                            placeholder="Ingrese la descripción de la página" required>
                        <div class="valid-feedback">Válido.</div>
                        <div class="invalid-feedback">Campo inválido.</div>
                    </div>


                </div>


                <?php

                    require_once "controllers/landings.controller.php";
                    $manage = new LandingsController();
                    $manage -> landingsManage();
                
                ?>

                <!-- Modal footer -->
                <div class="modal-footer d-flex justify-content-between">

                    <div>
                        <button type="button" class="btn btn-default border" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-dark">Guardar</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>