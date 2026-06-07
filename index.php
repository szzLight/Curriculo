<?php
// Recurso PHP: Armazenamento e renderização dinâmica de dados
$dados = [
    "nome" => "Brayan Souza Beck",
    "cargo" => "Desenvolvedor Back-End / Editor de Vídeo",
    "foto" => "https://via.placeholder.com/150", 
    "github_user" => "brayansb", // Altere para o seu usuário do GitHub correto
    "experiencias" => [
        [
            "funcao" => "Operador de Telemarketing", 
            "ano" => "2022 - 2025", 
            "desc" => "Suporte técnico de Nível 1 para usuários, diagnóstico de incidentes, registro de tickets em sistemas de CRM e resolução de conflitos de alta complexidade (Clientes Críticos)."
        ],
        [
            "funcao" => "Editor de Vídeo & Motion Designer", 
            "ano" => "2019 - Presente", 
            "desc" => "Criação de conteúdo dinâmico, rastreamento de movimento e efeitos visuais."
        ]
    ],
    "competencias" => ["HTML5 & CSS3", "JavaScript", "PHP", "Git", "After Effects", "SQL", "C", "Java", "Node.js", "Inglês fluente"]
];

/**
 * Função PHP para renderizar as tags de competências de forma dinâmica
 * e aplicar uma classe de destaque para tecnologias específicas.
 */
function renderizarSkills(array $skills): void {
    foreach ($skills as $skill) {
        $classeEspecial = in_array($skill, ['PHP', 'JavaScript', 'Node.js', 'After Effects']) ? ' skill-highlight' : '';
        echo "<span class='skill-tag" . $classeEspecial . "'>" . htmlspecialchars($skill) . "</span>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currículo de <?php echo htmlspecialchars($dados['nome']); ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header class="profile-header">
        <img src="<?php echo $dados['foto']; ?>" alt="Foto de <?php echo htmlspecialchars($dados['nome']); ?>" class="avatar">
        <h1><?php echo htmlspecialchars($dados['nome']); ?></h1>
        <p class="subtitle"><?php echo htmlspecialchars($dados['cargo']); ?></p>
        
        <button id="theme-toggle" aria-label="Alternar tema">Alternar Modo Escuro</button>
    </header>

    <main class="container">
        <section class="section fade-in">
            <h2>Experiência Profissional</h2>
            <ul class="exp-list">
                <?php foreach($dados['experiencias'] as $exp): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($exp['funcao']); ?></strong> 
                        <span class="exp-date">(<?php echo htmlspecialchars($exp['ano']); ?>)</span>
                        <p><?php echo htmlspecialchars($exp['desc']); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section class="section fade-in">
            <h2>Competências</h2>
            <div class="skills-grid">
                <?php renderizarSkills($dados['competencias']); ?>
            </div>
        </section>

        <section class="section fade-in">
            <h2>Projetos Recentes (GitHub)</h2>
            <!-- Passamos o usuário do GitHub via data-attribute para o JS ler dinamicamente -->
            <div id="github-repos" data-username="<?php echo htmlspecialchars($dados['github_user']); ?>">
                <div class="loading">Carregando projetos...</div>
            </div>
        </section>
    </main>

    <script src="js/main.js"></script>
</body>
</html>