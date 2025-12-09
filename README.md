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

* Dashboard - (Em andamento)

Cada tenant criado já recebe um banco próprio, domínio e um usuário admin automaticamente.

### Sistema de Cada Academia

Cada academia tem:

 * Banco de dados isolado

 * Autenticação isolada

 * CRUD de alunos

 * Dashboard próprio com gráficos e estatísticas

### Tecnologias que usei

 * PHP 8.2

 * Laravel 12

 * Laravel Sail (Docker)

 * MySQL

 * Inertia.js

 * Vue.js

 * Tailwind CSS

 * Chart.js (via CDN)

 * Stancl/Tenancy 3.x

## Como funciona a parte Multi-Tenant

Cada tenant tem:

 * Seu próprio banco (tenant{ID})

 * Domínio próprio (academia1.localhost)
    Para adicionar mais, pode criar na rota gestaoacademia/***

 * Migrations independentes
   gestaoacademia/database/migrations/tenant/
   

 * Quando o tenant é acessado, o Laravel muda automaticamente a conexão para o banco correto.

    No caso no arquivo gestaoacademia/app/Providers/TenancyServiceProvider.php
    gerado automaticamente pelo comando 
    
    <pre>sail artisan tenancy:install</pre>

    * Realizei a alteração para o laravel diferenciar qual é o arquivo de 
    rota dos Tenants e qual é do projeto central.
    
    <pre>
       protected function mapRoutes()
        {
            $this->app->booted(function () {

                // ROTAS DO CENTRAL APP
                Route::middleware(['web'])
                    ->domain('gestaoacademia.localhost')
                    ->group(base_path('routes/central.php')); // arquivo de rota central

                // ROTAS DOS TENANTS
                Route::middleware([
                    'web',
                    \Stancl\Tenancy\Middleware\InitializeTenancyByDomain::class,
                    \Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains::class,
                ])
                    ->group(base_path('routes/tenant.php')); // arquivo de rota tenant
            });
        }
    <pre>

 * 

No controller do tenant, qualquer query SQL já cai no banco isolado.

### Criação de Tenants

 * Criei um formulário no painel central onde é possível:

 * Informar o ID da academia
Ex: academia1, academia2, academia3 ...

 * Informar o domínio
Ex. academia1.localhost, academia2.localhost, academia3.localhost...

 * Criar automaticamente o tenant

### CRUD de Alunos (no Tenant)

 * Cada academia tem seu próprio CRUD de alunos:

 * Formulário com os dados solicitados, nome, telefone, endereço...

 




