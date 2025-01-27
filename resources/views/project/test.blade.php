/* Estilizando a barra de paginação */
.pagination {
    display: flex;
    justify-content: center;
    padding: 20px;
    list-style: none;
    margin: 0;
}

/* Estilizando os itens de paginação */
.pagination li {
    margin: 0 5px;
}

/* Estilizando os links de paginação */
.pagination a, .pagination span {
    display: inline-block;
    padding: 10px 15px;
    text-decoration: none;
    color: #4CAF50;
    border: 1px solid #4CAF50;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
}

/* Estilo para o link ativo */
.pagination .active a, .pagination .active span {
    background-color: #4CAF50;
    color: #fff;
}

/* Estilo para o link hover */
.pagination a:hover, .pagination span:hover {
    background-color: #45a049;
    color: #fff;
}

/* Estilo para o link desabilitado */
.pagination .disabled a, .pagination .disabled span {
    color: #ccc;
    border-color: #ccc;
    pointer-events: none;
}
