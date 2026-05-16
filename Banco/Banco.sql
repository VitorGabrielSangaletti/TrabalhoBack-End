CREATE TABLE cardapio (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    nome        VARCHAR(100) NOT NULL,      
    preco       DECIMAL(10,2) NOT NULL,     
    descricao   VARCHAR(255),              
    categoria   VARCHAR(50) NOT NULL,
    disponivel  BOOLEAN DEFAULT TRUE        
);

INSERT INTO cardapio (nome, preco, descricao, categoria, disponivel) VALUES
-- 5 Hambúrgueres
('X-Burguer Clássico', 22.50, 'Pão artesanal, blend bovino 150g e queijo prato derretido.', 'Hambúrguer', TRUE),
('Cheddar Bacon Burguer', 32.90, 'Pão australiano, carne 180g, muito cheddar e bacon crocante.', 'Hambúrguer', TRUE),
('Burguer Gourmet Especial', 38.00, 'Pão brioche, blend black angus, cebola caramelizada e rúcula.', 'Hambúrguer', TRUE),
('Chicken Crisp', 25.00, 'Frango empanado crocante, alface americana e maionese da casa.', 'Hambúrguer', TRUE),
('Veggie Supreme', 29.90, 'Hambúrguer de grão-de-bico, queijo branco, tomate e molho pesto.', 'Hambúrguer', TRUE),

-- 3 Bebidas
('Coca-Cola Lata', 6.50, 'Lata 350ml gelada.', 'Bebida', TRUE),
('Suco de Laranja Natural', 12.00, 'Copo de 500ml feito na hora.', 'Bebida', TRUE),
('Cerveja Artesanal IPA', 18.00, 'Garrafa 600ml de produção local.', 'Bebida', TRUE),

-- 2 Sobremesas
('Petit Gâteau', 22.00, 'Bolinho quente de chocolate com uma bola de sorvete de baunilha.', 'Sobremesa', TRUE),
('Pudim de Leite', 12.50, 'Fatia de pudim caseiro com calda de caramelo.', 'Sobremesa', TRUE);

