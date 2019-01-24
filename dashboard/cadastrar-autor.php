 <?php 
include_once '../config.php';
if(!isset($_SESSION)){
session_start();
if (!$_SESSION['logado'])
	header("Location:../index.php");
}
?> 


  
  <form action="?titulo=Cadastrar+Autor&page=resultado.php" method="POST">
  <div class="mdl-card mdl-shadow--2dp demo-card-wide" >
  

  	<div class="mdl-textfield mdl-js-textfield textfield-demo"> 
    <input class="mdl-textfield__input" type="text" name="nome-autor" />
    <label class="mdl-textfield__label" for="sample1">Insira o nome do poeta *</label>
</div>
<div class="mdl-textfield mdl-js-textfield textfield-demo"> 
    <input class="mdl-textfield__input" type="text" name="pseudonimo-autor" />
    <label class="mdl-textfield__label" for="sample1">Insira o pseud�nimo</label>
</div>

  <div class="mdl-textfield mdl-js-textfield textfield-demo">
  <p id="label-consulta">Ano do Nascimento: </p>
    <input class="mdl-textfield__input" type="number" min="1000" max="3000"name="data_nasc" />
  </div>
<div class="mdl-textfield mdl-js-textfield textfield-demo">
  <p id="label-consulta">Ano da Morte: </p>
    <input class="mdl-textfield__input" type="number" min="1000" max="3000" name="data_morte" />
  </div>
  <div class="mdl-textfield mdl-js-textfield textfield-demo">
  <p id="label-consulta">Estado do poeta: * </p>
   <select name="estado">
	<option value="">Selecione o estado: </option>
	<option value="AC">Acre</option>
	<option value="AL">Alagoas</option>
	<option value="AP">Amapá</option>
	<option value="AM">Amazonas</option>
	<option value="BA">Bahia</option>
	<option value="CE">Ceará</option>
	<option value="DF">Distrito Federal</option>
	<option value="ES">Espirito Santo</option>
	<option value="GO">Goiás</option>
	<option value="MA">Maranhão</option>
	<option value="MS">Mato Grosso do Sul</option>
	<option value="MT">Mato Grosso</option>
	<option value="MG">Minas Gerais</option>
	<option value="PA">Pará</option>
	<option value="PB">Paraíba</option>
	<option value="PR">Paraná</option>
	<option value="PE">Pernambuco</option>
	<option value="PI">Piauí</option>
	<option value="RJ">Rio de Janeiro</option>
	<option value="RN">Rio Grande do Norte</option>
	<option value="RS">Rio Grande do Sul</option>
	<option value="RO">Rondônia</option>
	<option value="RR">Roraima</option>
	<option value="SC">Santa Catarina</option>
	<option value="SP">São Paulo</option>
	<option value="SE">Sergipe</option>
	<option value="TO">Tocantins</option>
</select>
  </div>
  <div class="mdl-card__actions mdl-card--border">
    <input type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" value="Cadastrar"/>
  </div> 	
  </div>
  </form>

