<?php 
require_once "../inc/cabecalho-admin.php";

use Microblog\Noticia;
use Microblog\Utilitarios;
$noticia = new Noticia;

/* Capturando o id e o tipo do usuário logado
e associando estes valores às propriedades do objeto */
$noticia->usuario->setId($_SESSION['id']);
$noticia->usuario->setTipo($_SESSION['tipo']);

$listaDeNoticias = $noticia->listar();

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Notícias 
		<span class="badge bg-dark">
			<?=count($listaDeNoticias)?>
		</span>
		</h2>

		<p class="text-center mt-5">
			<a class="btn btn-primary" href="noticia-insere.php">
			<i class="bi bi-plus-circle"></i>	
			Inserir nova notícia</a>
		</p>
				
		<div class="table-responsive">
		
			<table class="table table-hover">
				<thead class="table-light">
					<tr>
                        <th>Título</th>
                        <th>Data</th>
					
						<?php if($_SESSION["tipo"] === "admin"){ ?>
						<th>Autor</th>
						<?php } ?>

						<th class="text-center">Destaque</th>
						<th class="text-center" colspan="2">Operações</th>
					</tr>
				</thead>

				<tbody>

<?php foreach($listaDeNoticias as $itemNoticia) { ?>
					<tr>
                        <td> <?=$itemNoticia['titulo']?> </td>
                        <td> <?=Utilitarios::formataData($itemNoticia['data'])?> </td>

                        <?php if($_SESSION["tipo"] === "admin"){ ?>
						<td> <?=$itemNoticia['autor']?> </td>
						<?php } ?>

						<td class="text-center"><?=$itemNoticia['destaque']?></td>

						<td class="text-center">
							<a class="btn btn-warning" 
							href="noticia-atualiza.php?id=<?=$itemNoticia['id']?>">
							<i class="bi bi-pencil"></i> Atualizar
							</a>
						</td>
						<td>
							<a class="btn btn-danger excluir" 
							href="noticia-exclui.php?id=<?=$itemNoticia['id']?>">
							<i class="bi bi-trash"></i> Excluir
							</a>
						</td>
					</tr>
<?php } ?>
				</tbody>                
			</table>
	</div>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

