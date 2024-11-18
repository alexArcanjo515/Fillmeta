<?php 
session_start();

// Conexão com o banco de dados
$host = 'localhost'; // ou o endereço do seu servidor
$db = 'fillmeta';
$user = 'root';
$pass = '';

$conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);

// Configurações de paginização
$mensagensPorPagina = 10; // Número de mensagens por página
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($paginaAtual - 1) * $mensagensPorPagina;

// Consultar mensagens com LIMIT e OFFSET
$stmt = $conn->prepare("SELECT `id`, `nome`, `email`, `projeto`, `mensagem`, `data_envio` FROM `mensagem` ORDER BY `data_envio` DESC LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $mensagensPorPagina, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$mensagens = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Contar o total de mensagens
$stmt = $conn->prepare("SELECT COUNT(*) as total FROM `mensagem`");
$stmt->execute();
$totalMensagens = $stmt->fetchColumn();
$totalPaginas = ceil($totalMensagens / $mensagensPorPagina);

?>

<!--**********************************
            Header end ti-comment-alt
        ***********************************-->

<!--**********************************
            Sidebar start

*********************************
            Sidebar end
        ***********************************-->

<!--**********************************
            Content body start
        ***********************************-->

<div class="content-body">
    

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="font-size:20px">
                    <div class="card-body">
                        <div class="email-left-box">
                            <a href="#" class="btn btn-primary btn-block">Mensagens</a><br><br>
                            <div class="mail-list mt-4 mb-4" id="emailList">
                                <?php foreach ($mensagens as $mensagem): ?>
                                <a href="email-read.php?id=<?php echo $mensagem['id']; ?>"
                                    class="list-group-item border-0 p-r-0">
                                    <i
                                        class="fa fa-envelope font-18 align-middle mr-2"></i><?php echo htmlspecialchars($mensagem['nome']); ?>
                                    <span
                                        class="float-right"><?php echo htmlspecialchars($mensagem['data_envio']); ?></span>
                                </a>
                                <br><br><br>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="email-right-box">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-left">
                                        <?php echo ($offset + 1) . ' - ' . min($offset + $mensagensPorPagina, $totalMensagens) . ' of ' . $totalMensagens; ?>
                                    </div>
                                </div>
                                <div class="col-5 text-right">
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            <?php if ($paginaAtual > 1): ?>
                                            <li class="page-item"><a class="page-link"
                                                    href="?pagina=<?php echo $paginaAtual - 1; ?>">Anterior</a></li>
                                            <?php endif; ?>
                                            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                                            <li class="page-item <?php echo $i == $paginaAtual ? 'active' : ''; ?>">
                                                <a class="page-link"
                                                    href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                                            </li>
                                            <?php endfor; ?>
                                            <?php if ($paginaAtual < $totalPaginas): ?>
                                            <li class="page-item"><a class="page-link"
                                                    href="?pagina=<?php echo $paginaAtual + 1; ?>">Próximo</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>