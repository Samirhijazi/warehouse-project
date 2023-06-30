<div>
    <div class="mb-6">
        <div class="mb-3 flex items-center gap-4">
            <a href="{{ route('goods-category.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h3 class="text-2xl font-semibold">
                {{ __('Add Goods Category') }}
            </h3>
        </div>
    </div>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="mt-5 md:col-span-2 md:mt-0">
            <form wire:submit.prevent="submit" method="POST">
                <div class="shadow sm:overflow-hidden sm:rounded-md">
                    <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <label for="company-website" class="block text-sm font-medium text-gray-700">
                                    {{ __('Name') }}
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input
                                        wire:model.defer="name"
                                        type="text"


                                        class="block w-full flex-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        placeholder="{{ __('Name') }}"
                                    >
                                </div>
                                @error('name')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="about" class="block text-sm font-medium text-gray-700">
                                {{ __('Description') }}
                            </label>
                            <div class="mt-1">
                                <textarea
                                    wire:model.defer="description"
                                    name="about"
                                    rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="{{ __('Description') }}"
                                ></textarea>
                            </div>
                            @error('description')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-4 flex justify-between sm:px-6 border-t">
                        <a href="{{ route('goods-category.index') }}" class="inline-flex justify-center rounded-md bg-white py-2 px-4 text-sm font-medium border border-gray-300 shadow-sm hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-slate-900 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="md:col-span-1">
        </div>
    </div>
</div>
