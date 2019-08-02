
    <section class="section-interior">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 column-extend p-5 text-center">
                <p class="heading-form">Ingresa a DEGO</p>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="border-form" method="POST">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Correo electrónico" name="usuario">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Contraseña" name="clave">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <a href="#" class="link">Olvidé mi contraseña</a>
                            </div>
                        </div>
                        
                            <?php if (!empty($error_clave)): ?>
								<div class="alert alert-danger" role="alert"><?php echo $error_clave; ?></div>
							<?php endif ?>
                            <?php if (!empty($error_usuario)): ?>
								<div class="alert alert-danger" role="alert"><?php echo $error_usuario; ?></div>
							<?php endif ?>
                        
                        <div class="col-12 col-md-8">
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">Ingresar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12 col-md-6 column-extend image d-none d-md-block">
               <img src="src/img/fondo-login.png" alt="" class="img-fluid"> 
            </div>
        </div>
    </section>