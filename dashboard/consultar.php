 <?php 
if(!isset($_SESSION)){
session_start();
if (!$_SESSION['logado'])
	header("Location:../index.php");
}
?> 
  <form action="?titulo=Resultado&page=resultado.php" method="POST">
   <div class="mdl-card mdl-shadow--2dp demo-card-wide" >
 
   <div class="mdl-textfield mdl-js-textfield textfield-demo">
 	<br><p id="label-consulta"> Pesquisar por:</p>
    <select name="tipo-consulta">
    <option>Selecione a pesquisa
    </option>
    <option value="autor">Autor
    </option>
    <option value="obra">Obra
    </option>
    <option value="categoria">Categoria
    </option>
    </select>
    </div>
   <br><p id="label-consulta">  Que possuam:</p>
  <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <input class="mdl-textfield__input" type="text" name="pesquisa" />
    <label class="mdl-textfield__label" for="sample1">Digite a pesquisa... 	</label>
  </div>


  <div class="mdl-card__actions mdl-card--border">
        <input type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" value="Pesquisar"/>
  </div>
  </div>
  </form>
<br><p id="label-consulta"> Pesquisa Avançada: </p>
  <form action="?titulo=Resultado&page=resultado.php" method="POST">
   <div class="mdl-card mdl-shadow--2dp demo-card-wide" >
 
   <div class="mdl-textfield mdl-js-textfield textfield-demo">

  <p id="label-consulta">Pesquisar Autor</p>
   <p id="label-consulta">Selecione:</p>
 <label id="label-consulta" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-1">
  <input type="checkbox" id="checkbox-1" name="op-autor[]" class="mdl-checkbox__input" value="nome"/>
  <span class="mdl-checkbox__label">Nome</span><br>
</label>
   <label id="label-consulta" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-2">
  <input type="checkbox" id="checkbox-2" name="op-autor[]" class="mdl-checkbox__input" value="data_nasc"/>
  <span class="mdl-checkbox__label">Data de Nascimento</span><br>
</label>

   <label id="label-consulta" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-3">
  <input type="checkbox" id="checkbox-3" name="op-autor[]" class="mdl-checkbox__input" value="data_morte" />
  <span class="mdl-checkbox__label">Data de Morte</span><br>
</label>
   <label id="label-consulta" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-4">
  <input type="checkbox" id="checkbox-4" name="op-autor[]"  class="mdl-checkbox__input" value="estado"/>
  <span class="mdl-checkbox__label">Estado</span><br>
</label>
   <label id="label-consulta" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-5">
  <input type="checkbox" id="checkbox-5" name="op-autor[]" class="mdl-checkbox__input" value="pseudonimo" />
  <span class="mdl-checkbox__label">Pseudônimo	</span><br>
</label>
    </div>
    <p id="label-consulta"> Aonde: </p>
       <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <select name="tipo-consulta-autor">
    <option>Selecione
    <option value="cordel">Possua um cordel que
    </option>
    <option value="classe-tematica">Possua uma classe temática que
    </option>
    <option value="data_nasc">Sua Data de Nascimento
    </option>
    <option value="data_morte">Sua Data de Morte
    </option>
    <option value="estado">Seu Estado
    </option>
    </select>
    </div>
    <p id="label-consulta"> Contenha: </p>
  <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <input class="mdl-textfield__input" type="text" name="pesquisa-autor" />
    <label class="mdl-textfield__label" for="sample1">Digite o nome ou parte da pesquisa</label>
  </div>

  <div class="mdl-card__actions mdl-card--border">
        <input type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" value="Pesquisar"/>
  </div>
  </div>
  </form>
  <br>
   <form action="?titulo=Resultado&page=resultado.php" method="POST">
   <div class="mdl-card mdl-shadow--2dp demo-card-wide" >
 
   <div class="mdl-textfield mdl-js-textfield textfield-demo">

  <p id="label-consulta">Pesquisar Categoria</p>
   <p id="label-consulta">Selecione as classes temáticas, onde:</p>
    <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <select name="tipo-consulta-categoria">
    <option>Selecione
    <option value="cordeis">Possuam cordeis
    </option>
    <option value="autores">Autores que utilzam
    </option>
    </select>
    </div>
    <p id="label-consulta"> Contenham em seu nome/título: </p>
  <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <input class="mdl-textfield__input" type="text" name="pesquisa-categoria" />
    <label class="mdl-textfield__label" for="sample1">Digite o nome ou parte da pesquisa</label>
  </div>
</div>
  <div class="mdl-card__actions mdl-card--border">
        <input type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" value="Pesquisar"/>
 
</div>
</div>
  </form>
  <br>
    <form action="?titulo=Resultado&page=resultado.php" method="POST">
   <div class="mdl-card mdl-shadow--2dp demo-card-wide" >
 
   <div class="mdl-textfield mdl-js-textfield textfield-demo">

  <p id="label-consulta">Pesquisar Cordel</p>
   <p id="label-consulta">Selecione:</p>
 <label id="label-consulta" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-6">
  <input type="checkbox" id="checkbox-6" name="op-cordel[]" class="mdl-checkbox__input" value="poeta"/>
  <span class="mdl-checkbox__label">Poeta</span><br>
</label>
   <label id="label-consulta" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-7">
  <input type="checkbox" id="checkbox-7" name="op-cordel[]" class="mdl-checkbox__input" value="titulo"/>
  <span class="mdl-checkbox__label">Titulo</span><br>
</label>
   <label id="label-consulta" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-8">
  <input type="checkbox" id="checkbox-8" name="op-cordel[]" class="mdl-checkbox__input" value="contexto" />
  <span class="mdl-checkbox__label">Contexto</span><br>
</label>
   <label id="label-consulta" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-9">
  <input type="checkbox" id="checkbox-9" name="op-cordel[]"  class="mdl-checkbox__input" value="figura"/>
  <span class="mdl-checkbox__label">Figura</span><br>
</label>
   <label id="label-consulta" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-10">
  <input type="checkbox" id="checkbox-10" name="op-cordel[]" class="mdl-checkbox__input" value="tema" />
  <span class="mdl-checkbox__label">Tema</span><br>
</label>
  <label id="label-consulta" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-11">
  <input type="checkbox" id="checkbox-11" name="op-cordel[]" class="mdl-checkbox__input" value="referencia" />
  <span class="mdl-checkbox__label">Referência</span><br>
</label>
  <label id="label-consulta" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-12">
  <input type="checkbox" id="checkbox-12" name="op-cordel[]" class="mdl-checkbox__input" value="classe" />
  <span class="mdl-checkbox__label">Classe Temática</span><br>
</label>
  <label id="label-consulta" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-13">
  <input type="checkbox" id="checkbox-13" name="op-cordel[]" class="mdl-checkbox__input" value="estado" />
  <span class="mdl-checkbox__label">Estado</span><br>
</label>
    </div>
    <p id="label-consulta"> Aonde: </p>
       <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <select name="tipo-consulta-cordel">
    <option>Selecione
    <option value="poeta">Possua poetas que em seu nome
    </option>
    <option value="classe-tematica">Possua uma classe temática que em seu titulo
    </option>
    <option value="contexto">Em seu contexto
    </option>
    <option value="figura">Em sua figura
    </option>
    <option value="tema">Em seu tema
    </option>
     <option value="referencia">Em sua referência
    </option>
    <option value="estado">Seu estado seja
    </option>
    </select>
    </div>
    <p id="label-consulta"> Contenha: </p>
  <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <input class="mdl-textfield__input" type="text" name="pesquisa-cordel" />
    <label class="mdl-textfield__label" for="sample1">Digite o nome ou parte da pesquisa</label>
  </div>

  <div class="mdl-card__actions mdl-card--border">
        <input type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" value="Pesquisar"/>
  </div>
  </div>
  </form>
  <br>
    <form action="?titulo=Resultado&page=resultado.php" method="POST">
   <div class="mdl-card mdl-shadow--2dp demo-card-wide" >
 
   <div class="mdl-textfield mdl-js-textfield textfield-demo">

  <p id="label-consulta">Pesquisas Diversas</p>
   <p id="label-consulta">Selecione:</p>
 <label id="label-consulta" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-13">
  <input type="checkbox" id="checkbox-13" name="op-diverso[]" class="mdl-checkbox__input" value="nome-poeta-diversos"/>
  <span class="mdl-checkbox__label">Nome do Poeta</span><br>
</label>
   <label id="label-consulta" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-14">
  <input type="checkbox" id="checkbox-14" name="op-diverso[]" class="mdl-checkbox__input" value="estado-diversos"/>
  <span class="mdl-checkbox__label">Estado</span><br>
</label>
     <label id="label-consulta" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-15">
  <input type="checkbox" id="checkbox-15" name="op-diverso[]" class="mdl-checkbox__input" value="tema-diversos"/>
  <span class="mdl-checkbox__label">Tema</span><br>
</label>
    </div>
    <p id="label-consulta"> Aonde: </p>
       <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <select name="tipo-consulta-diverso">
    <option>Selecione
    <option value="classe-tematica">Possua uma classe temática que em seu titulo
    </option>
    <option value="contexto">Em seu contexto
    </option>
    <option value="figura">Em sua figura
    </option>
    <option value="tema">Em seu tema
    </option>
     <option value="referencia">Em sua referência
    </option>
    </select>
    </div>
    <p id="label-consulta"> Contenha: </p>
  <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <input class="mdl-textfield__input" type="text" name="pesquisa-diverso" />
    <label class="mdl-textfield__label" for="sample1">Digite o nome ou parte da pesquisa</label>
  </div>

  <div class="mdl-card__actions mdl-card--border">
        <input type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" value="Pesquisar"/>
  </div>
  </div>
  </form>
  <br>
     <form action="?titulo=Resultado&page=resultado.php" method="POST">
   <div class="mdl-card mdl-shadow--2dp demo-card-wide" >
 
   <div class="mdl-textfield mdl-js-textfield textfield-demo">

  <p id="label-consulta">Estatísticas</p>

    </div>
    <p id="label-consulta"> Numero de: </p>
       <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <select name="tipo-estatistica">
    <option>Selecione
    <option value="poetas">Poetas
    </option>
    <option value="cordeis">Cordeis
    </option>
    </select>
    </div>
       <p id="label-consulta"> Aonde: </p>
       <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <select name="argumento-estatistica">
    <option>Selecione
    <option value="estado">Estado
    </option>
     <option value="tema">Tema
    </option>
    </select>
    </div>
    <p id="label-consulta"> Contenha: </p>
  <div class="mdl-textfield mdl-js-textfield textfield-demo">
    <input class="mdl-textfield__input" type="text" name="pesquisa-estatistica" />
    <label class="mdl-textfield__label" for="sample1">Digite o nome ou parte da pesquisa</label>
  </div>

  <div class="mdl-card__actions mdl-card--border">
        <input type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" value="Pesquisar"/>
  </div>
  </div>
  </form>