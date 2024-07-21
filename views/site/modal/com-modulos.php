<div class="modal fade" id="withModulesModal" tabindex="-1" role="dialog" aria-labelledby="withModulesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="withModulesModalLabel">Sistema Com Módulos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <p>Um sistema com módulos organiza o código em sub-aplicações dentro da aplicação principal. Cada módulo pode ter seus próprios controladores, modelos, visões e configurações específicas.</p>
                <h6>Vantagens:</h6>
                <ul>
                    <li>Melhor organização do código.</li>
                    <li>Maior escalabilidade para grandes projetos.</li>
                    <li>Facilita a reutilização de código.</li>
                    <li>Isolamento de funcionalidades, facilitando manutenção.</li>
                </ul>
                <h6>Desvantagens:</h6>
                <ul>
                    <li>Configuração inicial mais complexa.</li>
                    <li>Estrutura de diretórios mais profunda.</li>
                    <li>Possível impacto no desempenho.</li>
                </ul>
                <h6>Estrutura de Projeto Com Módulos:</h6>
                <pre>
frontend/
├── modules/
│   └── admin/
│       ├── controllers/
│       │   └── DefaultController.php
│       ├── models/
│       │   └── AdminUser.php
│       ├── views/
│       │   └── default/
│       │       └── index.php
│       ├── Module.php
├── controllers/
│   └── SiteController.php
├── models/
│   └── User.php
├── views/
│   └── site/
│       └── index.php
                </pre>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>