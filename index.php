<?php
// Aqui fica a parte chave das informações, caso queira usar, altere para que todas as informações sejam de sua autoria.
// Nas linhas abaixo tem nome, cargo etc... Mais abaixo há formação, experiência e links para redes.
$dados = [
    "nome" => "Koda Felino Whiskers Souza Junior", // Local para inserir seu nome.
    "cargo" => "Engenheiro de Software Felino", // Cargo desejado/atual.
    "foto" => "assets/perfil.jpg", // Mude para sua foto de perfil.
    "github_user" => "szzLight", // Caso você queira usar, altere pro seu usuário correto no GIT.
    "experiencias" => [
        [
            "funcao" => "Supervisor de Segurança Residencial", 
            "ano" => "2022 - Presente", 
            "desc" => "Monitoramento contínuo de portas, janelas e insetos.
                         Atuação estratégica durante madrugadas.
                        Resposta rápida a ameaças como sacolas e aspiradores de pó."
        ],
        [
            "funcao" => "Fiscal de Tigelas Vazias", 
            "ano" => "2022 - Presente", 
            "desc" => "Inspeção diária e incessante de tigelas alimentares que possam estar preocupantemente vazias."
        ]
    ],
    "competencias" => ["HTML5 & CSS3", "JavaScript", "PHP", "Git", "After Effects", "SQL", "C", "Java", "Node.js", "Caça Avançada de Laser", "Detecção de Latas de Ração", "Gerenciamento de Caixas de Papelão", "Escalonamento Horizontal de Ronrons"],
    "objetivo" => "Dormir e ronronar.",
    "formacao" => [
        [
            "curso" => "Análise e Desenvolvimento de Sistemas",
            "instituicao" => "Estácio de Sá",
            "ano" => "2026 - Presente",
            "desc" => "Foco em desenvolvimento back-end, banco de dados e práticas de software."
        ],
        [
            "curso" => "Curso de caça",
            "instituicao" => "Residência dos Souza (EAD)",
            "ano" => "2022 - 2022",
            "desc" => "Desisti porquê a barata corria mais que eu."
        ]
    ],
    "contato" => [
        "email" => "kodafelino@gatomail.com",
        "telefone" => "(27) 999999999",
        "local" => "Vila Velha, ES"
    ],
    "idiomas" => [
        ["nome" => "Português", "fluencia" => 100],
        ["nome" => "Inglês", "fluencia" => 85],
        ["nome" => "Espanhol", "fluencia" => 50]
    ],
    "links" => [
        [
            "nome" => "LinkedIn",
            "url" => "https://www.linkedin.com/in/brayan-souza-003b27342",
            "icone" => "assets/logolk.png"
        ],
        [
            "nome" => "YouTube",
            "url" => "https://www.youtube.com/@Essiz%C3%AAFx",
            "icone" => "assets/logoyt.png"
        ],
        [
            "nome" => "TikTok",
            "url" => "https://www.tiktok.com/@essizefx",
            "icone" => "assets/logotk.webp"
        ]
    ]
];
function renderizarSkills(array $skills): void {
    foreach ($skills as $skill) {
        $classeEspecial = in_array($skill, ['PHP', 'JavaScript', 'Node.js', 'After Effects']) ? ' skill-highlight' : '';
        echo "<span class='skill-tag" . $classeEspecial . "'>" . htmlspecialchars($skill) . "</span>";
    }
}

function renderizarFormacao(array $formacao): void {
    foreach ($formacao as $item) {
        echo "<li>";
        echo "<strong>" . htmlspecialchars($item['curso']) . "</strong>";
        echo "<span class='exp-date'> (" . htmlspecialchars($item['ano']) . ")</span>";
        echo "<p><strong>" . htmlspecialchars($item['instituicao']) . "</strong></p>";
        echo "<p>" . htmlspecialchars($item['desc']) . "</p>";
        echo "</li>";
    }
}

function renderizarLinks(array $links): void {
    foreach ($links as $link) {
        echo "<a href='" . htmlspecialchars($link['url']) . "' target='_blank' rel='noopener noreferrer'>";
        echo "<img class='link-icon' src='" . htmlspecialchars($link['icone']) . "' alt='" . htmlspecialchars($link['nome']) . " icon'>";
        echo htmlspecialchars($link['nome']);
        echo "</a>";
    }
}

// simulação de contato por empresa
$retorno = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $empresa = htmlspecialchars(trim($_POST["empresa"] ?? ""));

    if ($empresa === "") {
        $retorno = "Por favor, informe o nome da empresa para simular o contato.";
    } else {
        $retorno = "Obrigado pelo interesse, $empresa. Entrarei em contato em breve.";
    }
}

function renderizarIdiomas(array $idiomas): void {
    foreach ($idiomas as $idioma) {
        echo "<div class='language-item'>";
        echo "<div class='lang-header'>";
        echo "<span class='lang-name'>" . htmlspecialchars($idioma['nome']) . "</span>";
        echo "<span class='lang-level'>" . htmlspecialchars($idioma['fluencia']) . "%</span>";
        echo "</div>";
        echo "<div class='progress-bar'><div class='progress-fill' style='width: " . htmlspecialchars($idioma['fluencia']) . "%'></div></div>";
        echo "</div>";
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
        
        <div class="header-buttons">
            <button id="theme-toggle" aria-label="Alternar tema">🌙 Modo Escuro</button>
            <button id="download-pdf" aria-label="Baixar currículo em PDF"> Baixar PDF</button>
        </div>
    </header>

<!-- Area de sobre mim e objetivo -->
    <section class="section fade-in">
        <center><h2>Sobre Mim</h2></center>
        <p> <center>
            4 Anos. (De humano é 33 anos) <br>
            Casado, pai de 3 filhotes. <br>
            Castrado mas não morto. <br>
            Naturalizado na gatolândia, falo gatanês e aprendendo latidês no Duolingo.
        </p> </center>
    </section>

    <section class="section fade-in">
        <center><h2>Objetivo Pessoal</h2></center>
        <center><p><?php echo htmlspecialchars($dados['objetivo']); ?></p></center>
    </section>

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
<!-- Formação acadêmica, competência etc... -->
        <section class="section fade-in">
            <h2>Formação Acadêmica</h2>
            <ul class="exp-list">
                <?php renderizarFormacao($dados['formacao']); ?>
            </ul>
        </section>

        <section class="section fade-in">
            <h2>Competências</h2>
            <button id="skills-toggle" type="button" aria-expanded="false">Mostrar competências</button>
            <div id="skills-panel" class="skills-panel hidden" aria-hidden="true">
                <?php renderizarSkills($dados['competencias']); ?>
            </div>
        </section>

        <section class="section fade-in">
            <h2>Idiomas</h2>
            <div class="languages-container">
                <?php renderizarIdiomas($dados['idiomas']); ?>
            </div>
        </section>

        <section class="section fade-in">
            <h2>Contato direto</h2>
            <p>Se interessou? Insira o nome da sua empresa que entrarei em contato o mais breve possível!</p>
            <form method="POST" class="contact-form">
                <input type="text" name="empresa" placeholder="Nome da empresa" value="<?php echo isset($_POST['empresa']) ? htmlspecialchars($_POST['empresa']) : ''; ?>">
                <button type="submit">Enviar</button>
            </form>
            <?php if ($retorno !== ""): ?>
                <div class="contact-result"><?php echo $retorno; ?></div>
            <?php endif; ?>
        </section>

        <section class="section fade-in contact-section">
            <h2>Contato & Redes</h2>
            <div class="contact-grid">
                <div class="contact-card">
                    <p><strong>E-mail:</strong> <a href="mailto:<?php echo htmlspecialchars($dados['contato']['email']); ?>"><?php echo htmlspecialchars($dados['contato']['email']); ?></a></p>
                    <p><strong>Telefone:</strong> <?php echo htmlspecialchars($dados['contato']['telefone']); ?></p>
                    <p><strong>Endereço:</strong> <?php echo htmlspecialchars($dados['contato']['local']); ?></p>
                </div>
                <div class="contact-card social-card">
                    <p><strong>Rede profissional:</strong></p>
                    <?php renderizarLinks($dados['links']); ?>
                </div>
            </div>
        </section>

        <!-- Local com integração Github (API), pedida no trabalho. -->
        <section class="section fade-in">
            <h2>Projetos Recentes (GitHub)</h2>
            <div id="github-repos" data-username="<?php echo htmlspecialchars($dados['github_user']); ?>">
                <div class="loading">Carregando projetos...</div>
            </div>
        </section>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="js/main.js"></script>
    
</body>
</html>