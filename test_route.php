<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = Illuminate\Http\Request::create('/budlite-security/store/products/security-uniform', 'GET');
echo "Testing: /budlite-security/store/products/security-uniform\n\n";

try {
    $response = $kernel->handle($request);
    echo "Status: " . $response->getStatusCode() . "\n\n";

    if ($response->getStatusCode() === 404) {
        echo "404 ERROR - Debugging:\n\n";
        $tenant = \App\Models\Tenant::where('slug', 'budlite-security')->first();
        echo "1. Tenant: " . ($tenant ? "Found" : "Not found") . "\n";

        if ($tenant) {
            $product = \App\Models\Product::where('tenant_id', $tenant->id)->where('slug', 'security-uniform')->where('is_visible_online', true)->where('is_active', true)->first();
            echo "2. Product (with filters): " . ($product ? "Found" : "Not found") . "\n";

            $productRaw = \App\Models\Product::where('tenant_id', $tenant->id)->where('slug', 'security-uniform')->first();
            if ($productRaw && !$product) {
                echo "   Product exists but: visible=" . ($productRaw->is_visible_online ? 'Y' : 'N') . ", active=" . ($productRaw->is_active ? 'Y' : 'N') . "\n";
            }
        }
    } else {
        echo "SUCCESS!\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
$kernel->terminate($request, $response ?? null);
