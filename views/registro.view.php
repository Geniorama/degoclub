<section class="section-interior">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 column-extend image d-none d-md-block">
               <img src="src/img/pexels-photo-840996.png" alt="" class="img-fluid"> 
            </div>
            <div class="col-12 col-md-6 column-extend p-5 text-center">
                <p class="heading-form">¡Es muy sencillo registrarte!</p>
                <p class="subheading-form">Completa el formulario y comienza a usar <span class="text-bold">DEGO</span></p>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="border-form" method="POST">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Nombre" name="nombre">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Apellido" name="apellido">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Correo electrónico" name="email">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="password" id="clave" class="form-control" placeholder="Crea una contraseña" name="clave">
                                <small id="clave" class="text-left ml-3 form-text text-muted">
                                Tu contraseña debe contener al menos 6 caracteres, una letra minúscula, una letra mayúscula, un caracter numérico.
                                </small>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="password" id="clave2" class="form-control" placeholder="Confirma tu contraseña" name="clave2">
                                <small id="clave2" class="text-left ml-3 form-text text-muted">
                                Tu contraseña debe coincidir.
                                </small>
                            </div>
                        </div>
                        <div class="col-12">
                            <?php if (!empty($error_clave)): ?>
								<div class="alert alert-danger" role="alert"><?php echo $error_clave; ?></div>
							<?php endif ?>
                            <?php if (!empty($error_usuario)): ?>
								<div class="alert alert-danger" role="alert"><?php echo $error_usuario; ?></div>
							<?php endif ?>
                            <?php if (!empty($error_coincidencia)): ?>
								<div class="alert alert-danger" role="alert"><?php echo $error_coincidencia; ?></div>
							<?php endif ?>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">enviar</button>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <a href="login.php" class="link">Ya tengo una cuenta</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>