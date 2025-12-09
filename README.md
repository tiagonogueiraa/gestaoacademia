# Gestão Academia – Projeto Multi-Tenant (Laravel 12 + Inertia + Vue)

Este projeto foi desenvolvido como teste técnico, com foco em criar um sistema de gestão para academias usando multi-tenancy (um sistema central que gerencia várias academias, cada uma com seu próprio banco de dados isolado).

Usei Laravel 12, Inertia.js, Vue.js, MySQL e o pacote stancl/tenancy para a parte multi-tenant.

## Visão Geral do Sistema

### 1 - Sistema Central (gestaoacademia.localhost)

É o painel principal, onde consigo:

* Visualizar todas as academias (tenants)

* Criar novas academias (Tenants)

* Excluir academias (Tenants)

* Acessar rapidamente o tenant pelo domínio

* Acompanhar algumas informações gerais

Cada tenant criado já recebe um banco próprio, domínio e um usuário admin automaticamente.

