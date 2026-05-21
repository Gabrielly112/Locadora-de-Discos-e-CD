# 🎵 RetroGroove - Sistema de Locadora de Discos

O **RetroGroove** é um sistema web responsivo para o gerenciamento e locação de discos de música, permitindo o controlo de inventário entre mídias físicas de **Vinil (LP)** e **CD (Compact Disc)**. O sistema conta com controlo de acesso (módulo de administração), catálogo em tempo real e calculadora de previsão de custos de aluguer.

---

## 🚀 Funcionalidades

### 👤 Área do Cliente / Utilizador Comum
* **Visualização do Catálogo:** Consulta simplificada de todos os discos cadastrados, formato (CD/Vinil) e status de disponibilidade.
* **Simulador de Aluguer:** Calculadora integrada para prever o valor/tempo da locação com base no formato escolhido e na quantidade de dias.

### 🛡️ Área do Administrador 
* **Gerenciamento de Inventário:** Formulário dinâmico para registar novos títulos e artistas com códigos identificadores únicos (UPC/EAN).
* **Controlo de Fluxo:** Ferramentas rápidas na listagem para **Alugar** (definindo o prazo em dias), **Devolver** ou **Eliminar** um disco do sistema.

---

## 🛠️ Tecnologias Utilizadas

* **Backend:** PHP 8.x (Arquitetura baseada em Programação Orientada a Objetos)
* **Frontend:** HTML5, CSS3, Bootstrap 5.3 (Interface limpa, moderna e responsiva)
* **Ícones:** Bootstrap Icons 1.11.3
* **Autenticação:** Serviço customizado de controlo de sessão (`Services\Auth`)

---

## 📂 Estrutura de Pastas do Projeto 

```text
├── models/
│   ├── Disco.php          # Classe abstrata/mãe
│   ├── Vinil.php          # Extensão para Discos de Vinil
│   └── CD.php             # Extensão para Compact Discs
├── services/
│   └── Auth.php           # Controlo de login e níveis de acesso (Admin/User)
├── views/
│   └── index.php          # Tela principal do sistema (Código da interface)
└── README.md
