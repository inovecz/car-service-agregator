<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenantSettingsUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Tenant;
use App\Models\TenantSetting;

class TenantSettingsController extends Controller
{
    /**
     * Display the tenant's edit form.
     */
    public function edit(Request $request): View
    {
        return view('tenant.edit', [
            'user' => $request->user(),
            'tenant' => Auth::user()->tenant
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $tenantId = Auth::user()->tenant->getId();

        $settings = $request->input('settings');

        foreach ($settings as $key => $value) {

            $existingRecord = Auth::user()->tenant->tenantSettings()->where('tenant_id', $tenantId)->where('key', $key)->first();
            if ($existingRecord) {
                Auth::user()->tenant->tenantSettings()->where('tenant_id', $tenantId)->where('key', $key)->update(['tenant_id' => $tenantId, 'key' => $key, 'value' => json_encode($value)]);
            } else {
                Auth::user()->tenant->tenantSettings()->create(['tenant_id' => $tenantId, 'key' => $key, 'value' => json_encode($value)]);
            }
        }
       
        return Redirect::route('tenant-settings.edit')->with('status', 'tenant-integration-updated');
    }
}
