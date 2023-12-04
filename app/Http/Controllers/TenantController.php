<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenantSettingsUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Tenant;

class TenantController extends Controller
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
    public function update(TenantSettingsUpdateRequest $request): RedirectResponse
    {
       // $request->user()->tenant()->fill($request->validated());

        $request->user()->tenant()->update($request->validated());

        return Redirect::route('tenant-settings.edit')->with('status', 'tenant-settings-updated');
    }
}
