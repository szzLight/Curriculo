document.addEventListener("DOMContentLoaded", () => {

    // Tema escuro

    const themeToggle = document.getElementById("theme-toggle");

    const savedTheme = localStorage.getItem("theme");
    const initialTheme = savedTheme || "light";

    document.documentElement.setAttribute("data-theme", initialTheme);

    function atualizarTextoTema(theme) {
        themeToggle.textContent =
            theme === "dark"
                ? "Modo Claro"
                : "Modo Escuro";
    }

    atualizarTextoTema(initialTheme);

    themeToggle.addEventListener("click", () => {
        const currentTheme =
            document.documentElement.getAttribute("data-theme") || "light";

        const newTheme = currentTheme === "dark" ? "light" : "dark";

        document.documentElement.setAttribute("data-theme", newTheme);
        localStorage.setItem("theme", newTheme);
        atualizarTextoTema(newTheme);
    });

    const skillsToggle = document.getElementById("skills-toggle");
    const skillsPanel = document.getElementById("skills-panel");

    if (skillsToggle && skillsPanel) {
        skillsToggle.addEventListener("click", () => {
            const isOpen = skillsPanel.classList.toggle("visible");
            skillsPanel.setAttribute("aria-hidden", String(!isOpen));
            skillsToggle.setAttribute("aria-expanded", String(isOpen));
            skillsToggle.textContent = isOpen ? "Ocultar competências" : "Mostrar competências";
        });
    }

    const downloadBtn = document.getElementById("download-pdf");
    if (downloadBtn) {
        downloadBtn.addEventListener("click", () => {
            const element = document.documentElement;
            const opt = {
                margin: 10,
                filename: 'curriculo.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { orientation: 'portrait', unit: 'mm', format: 'a4' }
            };
            
            if (typeof html2pdf !== 'undefined') {
                html2pdf().set(opt).from(element).save();
            } else {
                alert('Funcionalidade de PDF indisponível. Use a função de impressão (Ctrl+P).');
            }
        });
    }

    // API do github

    carregarRepositorios();

    async function carregarRepositorios() {

        const container =
            document.getElementById("github-repos");

        const username =
            container.dataset.username;

        try {

            const response = await fetch(
                `https://api.github.com/users/${username}/repos?sort=updated&per_page=6`
            );

            if (!response.ok)
                throw new Error("Erro GitHub");

            const repos = await response.json();

            container.innerHTML = "";

            repos.forEach(repo => {

                container.innerHTML += `
                    <div class="repo-card">
                        <h3>${repo.name}</h3>

                        <p>
                            ${repo.description || "Sem descrição"}
                        </p>

                        <div class="repo-info">

                            <span>
                                ⭐ ${repo.stargazers_count}
                            </span>

                            <span>
                                🍴 ${repo.forks_count}
                            </span>

                        </div>

                        <a
                            href="${repo.html_url}"
                            target="_blank"
                        >
                            Ver Projeto
                        </a>
                    </div>
                `;
            });

        } catch (error) {

            container.innerHTML =
                "<p>Não foi possível carregar os projetos.</p>";
        }
    }

    // Animação de Scroll

    const observer = new IntersectionObserver(entries => {

        entries.forEach(entry => {

            if (entry.isIntersecting) {
                entry.target.classList.add("visible");
            }

        });

    }, {
        threshold: 0.2
    });

    document
        .querySelectorAll(".fade-in")
        .forEach(el => observer.observe(el));
});