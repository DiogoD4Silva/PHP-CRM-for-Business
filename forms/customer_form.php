<fieldset>
    <div class="form-group">
        <label for="company">Empresa </label>
        <input type="text" name="company" value="<?php echo htmlspecialchars($edit ? $customer['company'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Empresa" class="form-control" required="required" id="company">
    </div>

    <div class="form-group">
        <label for="emp">Nome do responsável </label>
        <input type="text" name="emp" value="<?php echo htmlspecialchars($edit ? $customer['emp'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Nome do responsável" class="form-control" required="required" id="emp">
    </div>

    <div class="form-group">
        <label for="address">Morada</label>
        <textarea name="address" placeholder="Morada" class="form-control" id="address"><?php echo htmlspecialchars(($edit) ? $customer['address'] : '', ENT_QUOTES, 'UTF-8'); ?></textarea>
    </div>

    <div class="form-group">
        <label>Cidade</label>
        <?php $opt_arr = array("Abrantes", "Agualva-Cacém", "Águeda", "Albergaria-a-Velha", "Albufeira", "Alcácer do Sal", "Alcobaça", "Alfena", "Almada", "Almeirim", "Alverca do Ribatejo", "Amadora", "Amarante", "Amora", "Anadia", "Angra do Heroísmo", "Aveiro", "Barcelos", "Barreiro", "Beja", "Borba", "Braga", "Bragança", "Caldas da Rainha", "Câmara de Lobos", "Caniço", "Cantanhede", "Cartaxo", "Castelo Branco", "Chaves", "Coimbra", "Costa da Caparica", "Covilhã", "Elvas", "Entroncamento", "Ermesinde", "Esmoriz", "Espinho", "Esposende", "Estarreja", "Estremoz", "Évora", "Fafe", "Faro", "Faro", "Felgueiras", "Figueira da Foz", "Fiães", "Freamunde", "Funchal", "Funchal", "Gafanha da Nazaré", "Gandra", "Gondomar", "Gouveia", "Guarda", "Guimarães", "Horta", "Ílhavo", "Lagoa", "Lagoa", "Lagos", "Lamego", "Leiria", "Lisboa", "Lixa", "Loulé", "Loures", "Lourosa", "Macedo de Cavaleiros", "Machico", "Maia", "Mangualde", "Marco de Canaveses", "Marinha Grande", "Matosinhos", "Mealhada", "Mêda", "Miranda do Douro", "Mirandela", "Montemor-o-Novo", "Montijo", "Moura", "Odivelas", "Olhão", "Oliveira de Azeméis", "Oliveira do Bairro", "Oliveira do Hospital", "Ourém", "Ovar", "Paços de Ferreira", "Paredes", "Penafiel", "Peniche", "Peso de Régua", "Pinhel", "Pombal", "Ponta Delgada", "Ponte de Sor", "Portalegre", "Portimão", "Porto", "Póvoa de Santa Iria", "Póvoa de Varzim", "Praia da Vitória", "Quarteira", "Queluz", "Rebordosa", "Reguengos de Monsaraz", "Ribeira Grande", "Rio Maior", "Rio Tinto", "Sabugal", "Sacavém", "Samora Correia", "Santa Comba Dão", "Santa Cruz", "Santa Maria da Feira", "Santana", "Santarém", "Santiago do Cacém", "Santo Tirso", "São João da Madeira", "São Mamede de Infesta", "São Pedro do Sul", "Lordelo", "Seia", "Seixal", "Senhora da Hora", "Serpa", "Setúbal", "Silves", "Sines", "Tarouca", "Tavira", "Tomar", "Tondela", "Torres Novas", "Torres Vedras", "Trancoso", "Trofa", "Valbom", "Vale de Cambra", "Valença", "Valongo", "Valpaços", "Vendas Novas", "Viana do Castelo", "Vila Baleira", "Vila do Conde", "Vila Franca de Xira", "Vila Nova de Famalicão", "Vila Nova de Foz Côa", "Vila Nova de Gaia", "Vila Nova de Santo André", "Vila Real", "Vila Real de Santo António", "Viseu", "Vizela");
        ?>
        <select name="city" class="form-control selectpicker" required>
            <option value=" ">Escolhe a cidade</option>
            <?php
            foreach ($opt_arr as $opt) {
                if ($edit && $opt == $customer['city']) {
                    $sel = "selected";
                } else {
                    $sel = "";
                }
                echo '<option value="' . $opt . '"' . $sel . '>' . $opt . '</option>';
            }

            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($edit ? $customer['email'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="E-Mail" class="form-control" id="email">
    </div>

    <div class="form-group">
        <label for="phone">Telemóvel</label>
        <input name="phone" value="<?php echo htmlspecialchars($edit ? $customer['phone'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987-654-321" class="form-control" id="phone" type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}">
    </div>

    <div class="form-group text-center">
        <button type="submit" class="btn btn-warning">Guardar <span class="glyphicon glyphicon-send"></span></button>
        <a class="btn btn-danger" onclick="javascript:history.go(-1)">Sair <span class="glyphicon glyphicon-remove"></span></a>
    </div>
</fieldset>