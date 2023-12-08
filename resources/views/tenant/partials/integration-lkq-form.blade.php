<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Integration with LKQ') }}
        </h2>
    </header>


    <form method="post" action="{{ route('tenant-settings-integration.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <label for="lkq_activated" class="inline-flex items-center">
                <input type="hidden" name="settings[integration.lkq][activated]" value="false">
                <input id="hart_activated" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    name="settings[integration.lkq][activated]" value="true"
                    {{ isset($settings['integration.lkq']['activated']) ? ($settings['integration.lkq']['activated'] === 'true' ? 'checked' : '') : '' }}>
                <span class="ml-2 text-sm text-gray-600">{{ __('Activated') }}</span>
            </label>
        </div>

       {{--  <div>
            <x-input-label for="lkq_api_key" :value="__('API Key')" />
            <x-text-input id="lkq_api_key" name="settings[integration.lkq][api_key]" type="text"
                class="mt-1 block w-full" :value="old(
                    'settings.integration.lkq.api_key',
                    isset($settings['integration.lkq']['api_key']) ? $settings['integration.lkq']['api_key'] : '',
                )" />
            <x-input-error class="mt-2" :messages="$errors->get('settings[integration.lkq][api_key]')" />
        </div> --}}

        <div>
            <x-input-label for="lkq_client_id" :value="__('Client ID')" />
            <x-text-input id="lkq_client_id" name="settings[integration.lkq][client_id]" type="text"
                class="mt-1 block w-full" :value="old(
                    'settings.integration.lkq.client_id',
                    isset($settings['integration.lkq']['client_id']) ? $settings['integration.lkq']['client_id'] : '',
                )" />
            <x-input-error class="mt-2" :messages="$errors->get('settings[integration.lkq][client_id]')" />
        </div>

        <div>
            <x-input-label for="lkq_client_secret" :value="__('Client Secret')" />
            <x-text-input id="lkq_client_secret" name="settings[integration.lkq][client_secret]" type="text"
                class="mt-1 block w-full" :value="old(
                    'settings.integration.lkq.client_secret',
                    isset($settings['integration.lkq']['client_secret']) ? $settings['integration.lkq']['client_secret'] : '',
                )" />
            <x-input-error class="mt-2" :messages="$errors->get('settings[integration.lkq][client_secret]')" />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'tenant-integration-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
