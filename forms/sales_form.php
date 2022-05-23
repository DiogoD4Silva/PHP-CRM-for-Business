<fieldset>

    <div class="form-group">
        <label>Comprador</label>
        <select name="buyer" class="form-control selectpicker" required>
            <option value="" selected disabled hidden>Seleciona</option>
            <?php
            $query = "SELECT company FROM customers";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_array($result)) :; ?>

                <option value="<?php echo $row[0]; ?>"><?php echo $row['company'] ?></option>

            <?php endwhile; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="p_name">Nome do projeto</label>
        <input name="p_name" placeholder="Nome do projeto" class="form-control" id="p_name" value="<?php echo htmlspecialchars(($edit) ? $sales['p_name'] : '', ENT_QUOTES, 'UTF-8'); ?>"></input>
    </div>

    <div class="form-group">
        <label for="description">Descrição</label>
        <textarea name="description" placeholder="Descrição" class="form-control" id="description"><?php echo htmlspecialchars(($edit) ? $sales['description'] : '', ENT_QUOTES, 'UTF-8'); ?></textarea>
    </div>

    <div class="form-group">
        <label for="type">Serviço contratado </label>

        <div class="radio">
            <label>
                <input type="radio" name="type" value="Estudos CATI" required="" <?php echo ($edit && $sales['type'] == 'Estudos CATI') ? "checked" : ""; ?> /> Estudos CATI
            </label>
        </div>

        <div class="radio">
            <label>
                <input type="radio" name="type" value="Estudos CAWI" required="" <?php echo ($edit && $sales['type'] == 'Estudos CAWI') ? "checked" : ""; ?> /> Estudos CAWI
            </label>
        </div>

        <div class="radio">
            <label>
                <input type="radio" name="type" value="Cliente Mistério" required="" <?php echo ($edit && $sales['type'] == 'Cliente Mistério') ? "checked" : ""; ?> /> Cliente Mistério
            </label>
        </div>

        <div class="radio">
            <label>
                <input type="radio" name="type" value="Focus Group" required="" <?php echo ($edit && $sales['type'] == 'Focus Group') ? "checked" : ""; ?> /> Focus Group
            </label>
        </div>

        <div class="radio">
            <label>
                <input type="radio" name="type" value="IDI ( in-depth interviews )" required="" <?php echo ($edit && $sales['type'] == 'IDI ( in-depth interviews )') ? "checked" : ""; ?> /> IDI ( in-depth interviews )
            </label>
        </div>

        <div class="radio">
            <label>
                <input type="radio" name="type" value="Desk Research" required="" <?php echo ($edit && $sales['type'] == 'Desk Research') ? "checked" : ""; ?> /> Desk Research
            </label>
        </div>

        <div class="radio">
            <label>
                <input type="radio" name="type" value="Consultoria" required="" <?php echo ($edit && $sales['type'] == 'Consultoria') ? "checked" : ""; ?> /> Consultoria
            </label>
        </div>

        <div class="radio">
            <label>
                <input type="radio" name="type" value="Design" required="" <?php echo ($edit && $sales['type'] == 'Design') ? "checked" : ""; ?> /> Design
            </label>
        </div>

        <div class="radio">
            <label>
                <input type="radio" name="type" value="Outro" required="" <?php echo ($edit && $sales['type'] == 'Outro') ? "checked" : ""; ?> /> Outro
              
            </label>
        </div>
    </div>

    <div class="form-group">
        <label for="value">Valor</label>
        <input name="value" value="<?php echo htmlspecialchars($edit ? $sales['value'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="€" class="form-control" type="text" id="value">
    </div>

    <div class="form-group">
        <label>Estado </label>
        <br>
        <label class="radio-inline">
            <input type="radio" name="status" value="Completo" <?php echo ($edit && $sales['status'] == 'Completo') ? "checked" : ""; ?> required="required" /> Completo
        </label>
        <label class="radio-inline">
            <input type="radio" name="status" value="Incompleto" <?php echo ($edit && $sales['status'] == 'Incompleto') ? "checked" : "";  ?> required="required" /> Incompleto
        </label>
    </div>

    <div class="form-group">
        <label>Data da venda</label>
        <input name="saled_at" value="<?php echo htmlspecialchars($edit ? $sales['saled_at'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="dd/mm/aaaa" class="form-control" type="date">
    </div>

    <div class="form-group text-center">
        <button type="submit" class="btn btn-warning">Guardar <span class="glyphicon glyphicon-send"></span></button>
        <a class="btn btn-danger" onclick="javascript:history.go(-1)">Sair <span class="glyphicon glyphicon-remove"></span></a>
    </div>
</fieldset>