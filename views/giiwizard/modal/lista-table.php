<?php
use yii\helpers\Html;
?>
<style>
    #custom-alert {
        display: none;
        position: fixed;
        bottom: 10px;
        left: 50%;
        right: 10px;
        padding: 10px;
        background-color: #a4aba4;
        /* color: white; */
        border-radius: 5px;
        z-index: 1100; /* Ajuste conforme necessário */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 300px; /* Define a largura máxima */
        max-height : 50px; /* Define a comprimento máxima */
        word-wrap: break-word; /* Quebra de linha automática */
    }
</style>
<div id="custom-alert">This is an alert message!</div>
<div class="modal-body">
    <p>Para listar todas as tabelas de um banco de dados em MySQL e Oracle, você pode utilizar as seguintes consultas SQL:</p>
    <div id="code-content">
    <h3>Consultas SQL para Listar Todas as Tabelas no Banco de Dados</h3>

    <h4>MySQL</h4>
    <p>Para listar todas as tabelas em um banco de dados específico, utilize a consulta abaixo:</p>
    <!-- <div><code id="code-1">SHOW TABLES;</code><button onclick="copyCode('code-1')">Copiar</button></div> -->
    <div>
        <code id="code-1">SHOW TABLES;</code>
        <button style="margin-left: 20px;" type="button" class="btn btn-outline-secondary" onclick="copyCode('code-1')"><i class="bi bi-clipboard"></i></button>
    </div>
    <p>Se você quiser listar as tabelas de um banco de dados específico, substitua <code>seu_banco_de_dados</code> pelo nome do banco de dados desejado:</p>
    <!-- <div><code id="code-2">SHOW TABLES FROM seu_banco_de_dados;</code><button onclick="copyCode('code-2')">Copiar</button></div> -->
    <div>
        <code  id="code-2">SHOW TABLES FROM seu_banco_de_dados;</code>
        <button style="margin-left: 20px;" type="button" class="btn btn-outline-secondary" onclick="copyCode('code-2')"><i class="bi bi-clipboard"></i></button>
    </div>
    <p>Para gerar JSON no MySQL (versão 5.7 ou superior), use as funções <code>JSON_OBJECT</code> e <code>JSON_ARRAYAGG</code>:</p>
    <div>
        <code id="code-3">
            SELECT JSON_OBJECT(<br>
                'database', JSON_OBJECT(<br>
                    'tables', JSON_ARRAYAGG(table_name)<br>
                )<br>
            ) AS result<br>
            FROM information_schema.tables<br>
            WHERE table_schema = 'seu_esquema';
        </code>
        <!-- <button onclick="copyCode('code-3')">Copiar</button> -->
        <button style="margin-left: 20px;" type="button" class="btn btn-outline-secondary" onclick="copyCode('code-3')"><i class="bi bi-clipboard"></i></button>
    </div>

    <h4>Explicação</h4>
    <ul>
        <li><code>JSON_OBJECT('database', JSON_OBJECT('tables', JSON_ARRAYAGG(table_name)))</code> cria um objeto JSON.</li>
        <li><code>JSON_ARRAYAGG(table_name)</code> agrega todos os nomes de tabelas em um array JSON.</li>
        <li><code>information_schema.tables</code> é a tabela que contém as informações de todas as tabelas do banco de dados.</li>
        <li><code>table_schema = 'seu_esquema'</code> filtra as tabelas para o esquema especificado.</li>
    </ul>

    <h4>Exemplo de Saída</h4>
    <p>Se houver tabelas no esquema 'seu_esquema', a saída será algo parecido com:</p>
    <div>
        <code id="code-4">
            {<br>
            "database": {<br>
                "tables": [<br>
                "tb_autores",<br>
                "tb_categorias",<br>
                "tb_editoras",<br>
                "tb_emprestimos",<br>
                "tb_livros",<br>
                "tb_migration",<br>
                "tb_usuario"<br>
                ]<br>
            }<br>
            }
        </code>
        <!-- <button onclick="copyCode('code-4')">Copiar</button> -->
        <button style="margin-left: 20px;" type="button" class="btn btn-outline-secondary" onclick="copyCode('code-4')"><i class="bi bi-clipboard"></i></button>
    </div>
   

    <h4>Oracle</h4>
    <p>Para obter o resultado em formato JSON diretamente após executar a consulta no Oracle (a partir da versão 12c), você pode usar as funções <code>JSON_OBJECT</code> e <code>JSON_ARRAYAGG</code>:</p>
    <div>
        <code id="code-5">
        SELECT JSON_OBJECT(<br>
                'database' VALUE JSON_OBJECT(<br>
                    'tables' VALUE JSON_ARRAYAGG(table_name)<br>
                )<br>
            ) AS result<br>
        FROM all_tables<br>
        WHERE owner = 'SEU_ESQUEMA';
        </code>
        <!-- <button onclick="copyCode('code-5')">Copiar</button> -->
        <button style="margin-left: 20px;" type="button" class="btn btn-outline-secondary" onclick="copyCode('code-5')"><i class="bi bi-clipboard"></i></button>
    </div>

    <p>Para listar todas as tabelas de um esquema específico em Oracle:</p>
    <div>
        <code id="code-6">
        SELECT table_name <br>
        FROM all_tables <br>
        WHERE owner = 'SEU_ESQUEMA';
        </code>
        <!-- <button onclick="copyCode('code-6')">Copiar</button> -->
        <button style="margin-left: 20px;" type="button" class="btn btn-outline-secondary" onclick="copyCode('code-6')"><i class="bi bi-clipboard"></i></button>
    </div>

    <p>Substitua <code>SEU_ESQUEMA</code> pelo nome do esquema desejado.</p>

    <p>Para listar tabelas do próprio usuário:</p>
    <div>
        <code id="code-7">
        SELECT table_name <br>
        FROM user_tables;
        </code>
        <!-- <button onclick="copyCode('code-7')">Copiar</button> -->
        <button style="margin-left: 20px;" type="button" class="btn btn-outline-secondary" onclick="copyCode('code-7')"><i class="bi bi-clipboard"></i></button>
    </div>

    <p>Para listar todas as tabelas acessíveis ao usuário:</p>
    <div>
        <code id="code-8">
        SELECT table_name <br>
        FROM all_tables;
        </code>
        <!-- <button onclick="copyCode('code-8')">Copiar</button> -->
        <button style="margin-left: 20px;" type="button" class="btn btn-outline-secondary" onclick="copyCode('code-8')"><i class="bi bi-clipboard"></i></button>
    </div>

    <p>Essas consultas fornecem uma visão completa das tabelas disponíveis no banco de dados, seja em MySQL ou Oracle.</p>

    <h4>Tutorial Rápido e Simples para Gerar JSON no Oracle (Para Oracle 10g consulte informações abaixo)</h4>
    <p>Para obter o resultado em formato JSON diretamente após executar a consulta no Oracle, você pode usar funções específicas de formatação JSON fornecidas pelo Oracle. A partir do Oracle 12c, há suporte para geração de JSON nativa. Aqui está como você pode fazer isso:</p>
    <ol>
        <li><p><strong>Verifique se você tem a versão do Oracle que suporta funções JSON</strong>: As funções JSON foram introduzidas no Oracle 12c.</p></li>
        <li><p><strong>Use a função <code>JSON_OBJECT</code> e <code>JSON_ARRAYAGG</code></strong> para formatar sua saída. Aqui está um exemplo de como você pode fazer isso:</p>
        <div>
            <code id="code-9">
            SELECT JSON_OBJECT(<br>
                    'database' VALUE JSON_OBJECT(<br>
                        'tables' VALUE JSON_ARRAYAGG(table_name)<br>
                    )<br>
                ) AS result<br>
            FROM all_tables<br>
            WHERE owner = 'SEU_ESQUEMA';
            </code>
            <!-- <button onclick="copyCode('code-9')">Copiar</button> -->
            <button style="margin-left: 20px;" type="button" class="btn btn-outline-secondary" onclick="copyCode('code-9')"><i class="bi bi-clipboard"></i></button>
        </div>
        </li>
        <li><p><strong>Verifique se há tabelas disponíveis</strong>: A consulta acima deve funcionar se houver tabelas para o proprietário do 'SEU_ESQUEMA'. Caso contrário, a consulta retornará um JSON vazio.</p></li>
        <li><p><strong>Resultado</strong>: A consulta retornará um JSON estruturado com a lista de tabelas do esquema especificado.</p></li>
    </ol>

    <h4>Executando a consulta</h4>
    <p>Execute a consulta em sua ferramenta de SQL (como SQL*Plus, SQL Developer ou qualquer outro cliente Oracle que você esteja usando).</p>

    <h4>Observação</h4>
    <p>Certifique-se de ter permissões adequadas para usar as funções JSON no Oracle e de que a versão do banco de dados suporta essas funções. Se estiver usando uma versão mais antiga do Oracle que não suporta JSON, você precisará formatar o resultado no lado do cliente (por exemplo, usando uma linguagem de programação como Python ou PL/SQL).</p>

    <h4>Tutorial Rápido e Simples para Gerar JSON no Oracle 10g</h4>
    <p>No Oracle 10g, não há suporte nativo para funções JSON como <code>JSON_OBJECT</code> e <code>JSON_ARRAYAGG</code> que foram introduzidas no Oracle 12c. No entanto, você pode gerar JSON manualmente concatenando strings.</p>

    <h5>1. Executar a Consulta no Oracle</h5>
    <p>Use a consulta abaixo para gerar a saída JSON com entidades HTML:</p>
    <div>
        <code id="code-10">
        SELECT '{ "database": { "tables": [' ||<br>
            RTRIM (<br>
                XMLAGG (<br>
                    XMLELEMENT (e, '"' || REPLACE(table_name, '"', '\"') || '",')<br>
                    ORDER BY table_name<br>
                ).EXTRACT ('//text()').getCLOBVal(),<br>
                ','<br>
            ) || '] } }' AS json_output<br>
        FROM all_tables<br>
        WHERE owner = 'SEU_ESQUEMA';
        </code>
        <!-- <button onclick="copyCode('code-10')">Copiar</button> -->
        <button style="margin-left: 20px;" type="button" class="btn btn-outline-secondary" onclick="copyCode('code-10')"><i class="bi bi-clipboard"></i></button>
         
    </div>
    <h5>2. Processar o Resultado no Editor de Código</h5>
    <div class="alert alert-warning" role="alert">
        <h1><span class="badge badge-danger">ATENÇÃO</span></h1>
        <p>Depois de obter o resultado da consulta, você pode usar qualquer editor de texto ou uma ferramenta de script para substituir <code>&amp;quot;</code> por aspas duplas (<code>"</code>). </p>
        
    </div>
    <p>Aqui estão algumas maneiras de fazer isso:</p>
    

    <h6>Usando um Editor de Texto</h6>
    <ol>
        <li><p><strong>Abrir um Editor de Texto</strong>: Abra o editor de texto de sua escolha (por exemplo, Visual Studio Code, Sublime Text, Atom, Notepad++, etc.).</p></li>
        <li><p><strong>Colar o Resultado da Consulta</strong>: Cole o resultado da consulta no editor de texto.</p></li>
        <li><p><strong>Usar a Funcionalidade de Substituição</strong>:<br>
            <ul>
                <li>Abra a caixa de diálogo de substituição (geralmente acessível através do menu ou por um atalho de teclado, como <code>Ctrl + H</code>).</li>
                <li>No campo "Localizar o que:", insira <code>&quot;</code>.</li>
                <li>No campo "Substituir por:", insira <code>"</code>.</li>
                <li>Clique em "Substituir Tudo".</li>
            </ul>
        </p></li>
    </ol>

    <h5>3. Formatar a Resposta JSON</h5>
    <p>Depois de substituir <code>&quot;</code> por aspas duplas (<code>"</code>), você pode formatar o JSON resultante para melhor legibilidade. Acesse [Json Formatter] <?php echo Html::a('Json Formatter', ['/site/json-formatter'], ['class' => 'btn btn-outline-primary', 'target'=>"_blank"]); ?>.</p>

    <h4>Resumo</h4>
    <ul>
        <li><strong>Consulta no Oracle 10g</strong>: Use a consulta SQL fornecida para gerar a saída JSON.</li>
        <li><strong>Processamento no Editor de Texto</strong>: Utilize a funcionalidade de substituição de qualquer editor de texto para converter <code>&quot;</code> em aspas duplas (<code>"</code>).</li>
        <li><strong>Formatação do JSON</strong>: Use o [Json Formatter] <?php echo Html::a('Json Formatter', ['/site/json-formatter'], ['class' => 'btn btn-outline-primary', 'target'=>"_blank"]); ?>Json Formatter</a> para formatar o JSON resultante para melhor legibilidade.</li>
    </ul>
    <p>Seguindo esses passos, você conseguirá transformar o resultado da consulta SQL em um JSON corretamente formatado e legível.</p>
</div>

</div>


<script>
    function copyCode(elementId) {
    var codeElement = document.getElementById(elementId);
    var range = document.createRange();
    range.selectNodeContents(codeElement);
    var selection = window.getSelection();
    selection.removeAllRanges();
    selection.addRange(range);
    try {
        var successful = document.execCommand('copy');
        if (successful) {
            // showFlashMessage('Copiado: ' + codeElement.textContent.trim());
            showFlashMessage('Copiado');
        } else {
            showFlashMessage('Falha ao copiar');
        }
    } catch (err) {
        showFlashMessage('Erro ao copiar');
    }
    selection.removeAllRanges();  // Limpa a seleção
}

function showFlashMessage(message) {
    var customAlert = document.getElementById('custom-alert');
    customAlert.textContent = message;
    customAlert.style.display = 'block';

    setTimeout(function() {
        customAlert.style.display = 'none';
    }, 4000);
}


</script>
