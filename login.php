<?php 
use Microblog\ControleDeAcesso;
use Microblog\Usuario;
use Microblog\Utilitarios;

require_once "inc/cabecalho.php";
// Programação das mensagens de feedback (campos obrigatórios, dados incorretos, saiu do sistema etc.)
if( isset($_GET["campos_obrigatorios"]) )
{
	$feedback = "Preencha e-mail e senha!";
} elseif( isset($_GET['dados_incorretos']) ) {
	$feedback = "Dados incorretos, tente novamente.";
}
?>


<div class="row">
    <div class="bg-white rounded shadow col-12 my-1 py-4">
        <h2 class="text-center fw-light">Acesso à área administrativa</h2>

        <form action="" method="post" id="form-login" name="form-login" class="mx-auto w-50">

                <?php if(isset($feedback)) { ?>
				<p class="my-2 alert alert-warning text-center"><?=$feedback?></p>
				<?php } ?>
				<div class="mb-3">
					<label for="email" class="form-label">E-mail:</label>
					<input class="form-control" type="email" id="email" name="email">
				</div>
				<div class="mb-3">
					<label for="senha" class="form-label">Senha:</label>
					<input class="form-control" type="password" id="senha" name="senha">
				</div>

				<button class="btn btn-primary btn-lg" name="entrar" type="submit">Entrar</button>

			</form>

<?php
if(isset($_POST['entrar'])){
	// Verificar se os campos foram preenchidos
	if(empty($_POST['email']) || empty($_POST['senha']))
	{
		header("location:login.php?campos_obrigatorios");
	} else 
	{
		// Capturar o e-mail
		$usuario = new Usuario;
		$usuario->setEmail($_POST['email']);
		// Buscar o usuário/e-mail no Banco de Dados
		$dados = $usuario->buscar();
		// Se não existir o usuário/e-mail, continuará em login.php
		if(!$dados){ // OU if($dados === false)
			header("location:login.php?dados_incorretos");
		} else {
			// Se existir;
			// - verificar a senha
			if(password_verify($_POST['senha'], $dados['senha'])){
				// - está correta? iniciar o processo de login
				$sessao = new ControleDeAcesso;
				$sessao->login($dados['id'], $dados['nome'], $dados['tipo']);
				header("location:admin/index.php");
			} else {
				header("location:login.php?dados_incorretos");
			}
		}
	}
}
?>

    </div>
    
    
</div>        
        
        
    



<?php 
require_once "inc/rodape.php";
?>

