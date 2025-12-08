<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

// adiciona o metodo domains e a funcionalidade para gerenciar o bd - criar / excluir o tenant vem os recursos do pacote Stancl Tenant
class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;
}

?>