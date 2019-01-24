
 <?php
	include_once '../config.php';
	if (! isset ( $_SESSION )) {
		session_start ();
		if (! $_SESSION ['logado'])
			header ( "Location:../index.php" );
	}
	?>


<form action="?titulo=Cadastrar+Obra&page=resultado.php" method="POST">
	<div class="mdl-card mdl-shadow--2dp demo-card-wide">
		<div class="mdl-textfield mdl-js-textfield textfield-demo">
 	<?php
		$objAutor = new AutorDAO ();
		$autores = $objAutor->getAutores ();
		echo "<select name ='autor-obra'>";
		echo "<option selected='selected'>Selecione o Poeta...</option>";
		foreach ( $autores as $row ) {
			echo "<option value='" . $row ["id"] . "'>" . $row ["nome"] . "</option>";
		}
		echo "</select>";
		?>
    </div>
		<div class="mdl-textfield mdl-js-textfield textfield-demo">
			<input class="mdl-textfield__input" type="text" name="titulo-obra" />
			<label class="mdl-textfield__label" for="sample1">Insira o titulo do
				cordel...</label>
		</div>

		<div class="mdl-textfield mdl-js-textfield textfield-demo">
			<p id="label-consulta">Contexto:</p>
			<textarea class="mdl-textfield__input" name="conteudo" rows="4"
				cols="50"></textarea>
		</div>
		<div class="mdl-textfield mdl-js-textfield textfield-demo">
			<input class="mdl-textfield__input" type="text" name="figura-obra" />
			<label class="mdl-textfield__label" for="sample1">Insira a figura...</label>
		</div>

		<div class="mdl-textfield mdl-js-textfield textfield-demo">
			<input class="mdl-textfield__input" type="text" name="tema-obra" /> <label
				class="mdl-textfield__label" for="sample1">Insira o tema...</label>
		</div>

		<div class="mdl-textfield mdl-js-textfield textfield-demo">
			<p id="label-consulta">Referência:</p>
			<textarea class="mdl-textfield__input" name="referencia-obra"
				rows="4" cols="50"></textarea>
				<script type="text/javascript">
      window.onload = function()  {
        CKEDITOR.replace( 'referencia-obra' );
      };
    </script>  
		</div>
		<div class="mdl-textfield mdl-js-textfield textfield-demo">
 	
 <?php
	$objCategoria = new CategoriaDAO ();
	$categorias = $objCategoria->getCategorias ();
	echo "<select name='categoria-obra'>";
	echo "<option selected='selected'>Selecione a Classe Temática...</option>";
	foreach ( $categorias as $row ) {
		echo "<option value='" . $row ["id"] . "'>" . $row ["titulo"] . "</option>";
	}
	echo "</select>";
	?>
    </div>

		<div class="mdl-card__actions mdl-card--border">
			<input type="submit"
				class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect"
				value="Cadastrar Obra" />
		</div>
	</div>
</form>

