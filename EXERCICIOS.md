# Exercícios - Microblog

## 18/10/2023

Programe as rotinas de CRUD para o gerenciamento de **Categorias**. Você deverá:

1) Criar uma nova `branch` para esta atividade (pode chamar de `categorias`)

1) Criar a classe `Categoria` e suas propriedades e métodos (veja o Diagrama de Classes)

2) Programar os scripts necessários para o funcionamento das páginas administrativas: 
    - `categorias.php`
    - `categoria-insere.php`
    - `categoria-atualiza.php`
    - `categoria-exclui.php`

3) Teste as rotinas CRUD da seguinte forma:
    - Cadastre **7 categorias** nesta ordem: Segurança, Mercado, Gastronomia, Mobile, Games, Educação, Programação. 
    - Mude o nome da categoria Programação para Desenvolvimento.
    - Apague a categoria Gastronomia
    
4) Somente usuários do tipo **admin** poderão gerenciar **Categorias**. Portanto, faça os ajustes necessários para que as páginas relacionadas à categorias fiquem bloqueadas para quem não é administrador. Não se esqueça de "esconder" os links de acesso para **Categorias**.

---

## 16/10/2023

1) Após finalizar o método `listarUm` na classe `Usuario`, vá para a página `usuario-atualiza.php` e programe o script necessário para carregar os dados somente do usuário que você escolheu **Atualizar**.

Lembre-se que, no caso do campo **tipo**, é necessário que o tipo já venha selecionado (podendo ser `editor` ou `admin`).

**Obs.: não mostre a senha no formulário.**

2) Na classe `Usuario` faça o método `excluir`.

3) Na página `usuario-exclui.php` programe o necessário para realizar efetivamente a exclusão do usuário escolhido.

---

## 10/10/2023

1) Na classe `Usuario` crie um novo método chamado `listar` (conforme Diagrama de Classe, pode usar outro nome se quiser). Este método deve retornar um array associativo contendo todos os dados de todos os usuários cadastrados até o momento.

2) Na página `usuarios.php` faça a programação necessária para carregar na tabela HTML as informações de Nome, E-mail e Tipo. Quanto ao ID, ele não deve ser exibido mas deve ser aplicado como parâmetro dos links `Atualizar` e `Excluir`.

