<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Integration with Hart') }}
        </h2>
    </header>


    <form method="post" action="{{ route('tenant-settings-integration.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <label for="hart_activated" class="inline-flex items-center">
                <input type="hidden" name="settings[integration.hart][activated]" value="false">
                <input id="hart_activated" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    name="settings[integration.hart][activated]" value="true"
                    {{ $settings['integration.hart']['activated'] === true ? 'checked' : '' }}>
                <span class="ml-2 text-sm text-gray-600">{{ __('Activated') }}</span>
            </label>
        </div>

        <div>
            <x-input-label for="hart_filename" :value="__('Filename')" />
            <x-text-input id="hart_filename" name="settings[integration.hart][filename]" type="text"
                class="mt-1 block w-full" :value="old('settings.integration.hart.filename', $settings['integration.hart']['filename'])" />

            <x-input-error class="mt-2" :messages="$errors->get('settings.hart_filename')" />
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
