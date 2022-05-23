<fieldset>

    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Username</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" name="user_name" autocomplete="off" placeholder="Username" class="form-control" value="<?php echo ($edit) ? $admin_account['user_name'] : ''; ?>" autocomplete="off">
            </div>
        </div>
    </div>
    
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Palavra-passe</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="password" name="password" autocomplete="off" placeholder="Palavra-passe " class="form-control" required="" autocomplete="off">
            </div>
        </div>
    </div>

    <!-- radio checks -->
    <div class="form-group">
        <label class="col-md-4 control-label">Nível</label>
        <div class="col-md-4">
            <div class="radio">
                <label>

                    <input type="radio" name="admin_type" value="admin" required="" <?php echo ($edit && $admin_account['admin_type'] == 'admin') ? "checked" : ""; ?> /> Administrador
                </label>
            </div>
            <div class="radio">
                <label>

                    <input type="radio" name="admin_type" value="func" required="" <?php echo ($edit && $admin_account['admin_type'] == 'func') ? "checked" : ""; ?> /> Funcionário
                </label>
            </div>
        </div>
    </div>

    <!-- Button -->
    <div class="form-group text-center">
        <button type="submit" class="btn btn-warning">Guardar <span class="glyphicon glyphicon-send"></span></button>
        <a class="btn btn-danger" onclick="javascript:history.go(-1)">Sair <span class="glyphicon glyphicon-remove"></span></a>
    </div>
</fieldset>