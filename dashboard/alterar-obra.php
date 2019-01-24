
 <?php

	include_once '../config.php';

	if (! isset ( $_SESSION )) {

		session_start ();

		if (! $_SESSION ['logado'])

			header ( "Location:../index.php" );

	}

	?>


<form
	action="?titulo=Alterar+Obra&page=resultado.php&id=<?php echo $_GET["id"]?>"
	method="POST">
	<div class="mdl-card mdl-shadow--2dp demo-card-wide">
		<div class="mdl-textfield mdl-js-textfield textfield-demo">
 	<?php


		
		$objObra = new ObraDAO ();

		$obra = $objObra->PesquisarObraPorId($_GET["id"]); 	

		$objAutor = new AutorDAO ();

		$autores = $objAutor->getAutores ();

		echo "<select name ='novoautor-obra'>";

		foreach ( $autores as $row ) {

			if ($row ["nome"] == $obra[0]["nome"]) {

				echo "<option selected='selected' value='" . $row ["id"] . "'>" . $row ["nome"] . "</option>";

			} else

				echo "<option value='" . $row ["id"] . "'>" . $row ["nome"] . "</option>";

		}

		echo "</select>";

		?>
    </div>

		<div class="mdl-textfield mdl-js-textfield textfield-demo">
			<input class="mdl-textfield__input" type="text"
				value="<?php echo $obra[0]["titulo"];?>" name="novotitulo-obra" />
			<label class="mdl-textfield__label" for="sample1"><?php echo $obra[0]["titulo"];?></label>
		</div>
		<div class="mdl-textfield mdl-js-textfield textfield-demo">
			<p id="label-consulta">Contexto</p>
			<textarea class="mdl-textfield__input" name="novoconteudo" rows="4"
				cols="50"><?php echo $obra[0]["contexto"];?></textarea>
		</div>
		<div class="mdl-textfield mdl-js-textfield textfield-demo">
			<input class="mdl-textfield__input" type="text"
				value="<?php echo $obra[0]["figura"];?>" name="novafigura-obra" /> <label
				class="mdl-textfield__label" for="sample1"><?php echo $obra[0]["figura"];?></label>
		</div>

		<div class="mdl-textfield mdl-js-textfield textfield-demo">
			<input class="mdl-textfield__input" type="text"
				value="<?php echo $obra[0]["tema"];?>" name="novotema-obra" /> <label
				class="mdl-textfield__label" for="sample1"><?php echo $obra[0]["tema"];?></label>
		</div>
		<div class="mdl-textfield mdl-js-textfield textfield-demo">
			<textarea class="mdl-textfield__input" name="novareferencia-obra" rows="4"
				cols="50"><?php echo $obra[0]["referencia"];?></textarea>
				<script type="text/javascript">
      window.onload = function()  {
        CKEDITOR.replace( 'novareferencia-obra' );
      };
    </script>  
			<label class="mdl-textfield__label" for="sample1"><?php echo $obra[0]["referencia"];?></label>
		</div>
		<div class="mdl-textfield mdl-js-textfield textfield-demo">
 	
 <?php

	$objCategoria = new CategoriaDAO ();

	$categorias = $objCategoria->getCategorias ();

	echo "<select name='novacategoria-obra'>";

	foreach ( $categorias as $row ) {

		if ($row ["titulo"] == $obra[0]["categoria"]) {

			echo "<option selected='selected' value='" . $row ["id"] . "'>" . $row ["titulo"] . "</option>";

		} else

			echo "<option value='" . $row ["id"] . "'>" . $row ["titulo"] . "</option>";

	}

	echo "</select>";

	?>
    </div>
		<br>


		<div class="mdl-card__actions mdl-card--border">
			<input type="submit"
				class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect"
				value="Alterar Obra" />
		</div>
	</div>
</form>

