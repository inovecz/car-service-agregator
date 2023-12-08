<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenantUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Tenant;
use App\Models\TenantSettings;

class TenantController extends Controller
{
    /**
     * Display the tenant's edit form.
     */
    public function edit(Request $request): View
    {
        $settings = Auth::user()->tenant->tenantSettings()->get();
        foreach ($settings as $item) {
            $preparedSettings[$item->getKey()] = $item->value; 
            if ($item->value['activated'] == 'true') {
                $preparedSettings[$item->getKey()]['activated'] = true; 
            } elseif ($item->value['activated'] == 'false') {
                $preparedSettings[$item->getKey()]['activated'] = false; 
            } 
        }

        return view('tenant.edit', [
            'user' => $request->user(),
            'tenant' => Auth::user()->tenant,
            'settings' => $preparedSettings
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(TenantUpdateRequest $request): RedirectResponse
    {
       // $request->user()->tenant()->fill($request->validated());

        $request->user()->tenant()->update($request->validated());

        return Redirect::route('tenant-settings.edit')->with('status', 'tenant-settings-updated');
    }
}
