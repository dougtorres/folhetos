 <?php 
include_once '../config.php';
if(!isset($_SESSION)){
session_start();
if (!$_SESSION['logado'])
	header("Location:../index.php");
}
?> 

  <?php

  $objAutor = new AutorDAO ();

  $autor = $objAutor->PesquisarAutorPorId($_GET["id"]);
  ?>
  <form action="?titulo=Alterar+Autor&page=resultado.php&id=<?php echo $_GET["id"]; ?>" method="POST">
  <div class="mdl-card mdl-shadow--2dp demo-card-wide" >
  <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <input class="mdl-textfield__input" type="text" name="novonome-autor" value="<?php echo $autor[0]["nome"] ?>" />
    <label class="mdl-textfield__label" for="sample1">Insira o nome do Poeta...</label>
  </div>
  <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <input class="mdl-textfield__input" type="text" name="novopseudonimo-autor" value="<?php echo $autor[0]["pseudonimo"] ?>" />
    <label class="mdl-textfield__label" for="sample1">Insira o pseud�nimo...</label>
  </div>
  <div class="mdl-textfield mdl-js-textfield textfield-demo">
  <p id="label-consulta">Data de Nascimento: </p>
    <input class="mdl-textfield__input" type="number" min="1000" max="3000" name="novadata_nasc" value="<?php if($autor[0]["data_nasc"] != 0) echo $autor[0]["data_nasc"]; ?>"/>
  </div>
<div class="mdl-textfield mdl-js-textfield textfield-demo">
  <p id="label-consulta">Data a morte: </p>
    <input class="mdl-textfield__input" type="number" min="1000" max="3000" name="novadata_morte" value="<?php if($autor[0]["data_morte"] != 0) echo $autor[0]["data_morte"]; ?>" />
  </div>
  <div class="mdl-textfield mdl-js-textfield textfield-demo">
  <p id="label-consulta">Estado do poeta: * </p>
   <select name="novoestado">
  <option value="">Selecione o estado: </option>
  <option value="AC" <?php if($autor[0]["estado"] == "AC") echo ' selected';?>> Acre</option>
  <option value="AL" <?php if($autor[0]["estado"] == "AL") echo ' selected';?>>Alagoas</option>
  <option value="AP" <?php if($autor[0]["estado"] == "AP") echo ' selected';?>>Amapá</option>
  <option value="AM" <?php if($autor[0]["estado"] == "AM") echo ' selected';?>>Amazonas</option>
  <option value="BA" <?php if($autor[0]["estado"] == "BA") echo ' selected';?>>Bahia</option>
  <option value="CE" <?php if($autor[0]["estado"] == "CE") echo ' selected';?>>Ceará</option>
  <option value="DF" <?php if($autor[0]["estado"] == "DF") echo ' selected';?>>Distrito Federal</option>
  <option value="ES" <?php if($autor[0]["estado"] == "ES") echo ' selected';?>>Espirito Santo</option>
  <option value="GO" <?php if($autor[0]["estado"] == "GO") echo ' selected';?>>Goiás</option>
  <option value="MA" <?php if($autor[0]["estado"] == "MA") echo ' selected';?>>Maranhão</option>
  <option value="MS" <?php if($autor[0]["estado"] == "MS") echo ' selected';?>>Mato Grosso do Sul</option>
  <option value="MT" <?php if($autor[0]["estado"] == "MT") echo ' selected';?>>Mato Grosso</option>
  <option value="MG" <?php if($autor[0]["estado"] == "MG") echo ' selected';?>>Minas Gerais</option>
  <option value="PA" <?php if($autor[0]["estado"] == "PA") echo ' selected';?>>Pará</option>
  <option value="PB" <?php if($autor[0]["estado"] == "PB") echo ' selected';?>>Paraíba</option>
  <option value="PR" <?php if($autor[0]["estado"] == "PR") echo ' selected';?>>Paraná</option>
  <option value="PE" <?php if($autor[0]["estado"] == "PE") echo ' selected';?>>Pernambuco</option>
  <option value="PI" <?php if($autor[0]["estado"] == "PI") echo ' selected';?>>Piauí</option>
  <option value="RJ" <?php if($autor[0]["estado"] == "RJ") echo ' selected';?>>Rio de Janeiro</option>
  <option value="RN" <?php if($autor[0]["estado"] == "RN") echo ' selected';?>>Rio Grande do Norte</option>
  <option value="RS" <?php if($autor[0]["estado"] == "RS") echo ' selected';?>>Rio Grande do Sul</option>
  <option value="RO" <?php if($autor[0]["estado"] == "RO") echo ' selected';?>>Rondônia</option>
  <option value="RR" <?php if($autor[0]["estado"] == "RR") echo ' selected';?>>Roraima</option>
  <option value="SC" <?php if($autor[0]["estado"] == "SC") echo ' selected';?>>Santa Catarina</option>
  <option value="SP" <?php if($autor[0]["estado"] == "SP") echo ' selected';?>>São Paulo</option>
  <option value="SE" <?php if($autor[0]["estado"] == "SE") echo ' selected';?>>Sergipe</option>
  <option value="TO" <?php if($autor[0]["estado"] == "TO") echo ' selected';?>>Tocantins</option>
</select>
  </div>

  <div class="mdl-card__actions mdl-card--border">
    <input type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" value="Alterar Autor"/>
  </div> 	
  </div>
  </form>

