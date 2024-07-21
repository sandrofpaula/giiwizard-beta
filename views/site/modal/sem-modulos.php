<div class="modal fade" id="noModulesModal" tabindex="-1" role="dialog" aria-labelledby="noModulesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noModulesModalLabel">Sistema Sem Módulos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <p>Um sistema sem módulos é mais simples e adequado para projetos menores. Todos os controladores, modelos e visões são organizados em pastas diretamente na estrutura principal da aplicação.</p>
                <h6>Vantagens:</h6>
                <ul>
                    <li>Simplicidade na estrutura do projeto.</li>
                    <li>Menor configuração inicial.</li>
                    <li>Facilidade de navegação entre arquivos.</li>
                </ul>
                <h6>Desvantagens:</h6>
                <ul>
                    <li>Escalabilidade limitada.</li>
                    <li>Organização pode se tornar confusa conforme o projeto cresce.</li>
                    <li>Menos adequado para reutilização de código.</li>
                </ul>
                <h6>Estrutura de Projeto Sem Módulos:</h6>
                <pre>
frontend/
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