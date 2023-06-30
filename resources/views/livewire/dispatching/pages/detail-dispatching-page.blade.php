<div>
    <div class="mb-6">
        <div class="mb-3 flex items-center gap-4">
            <a href="{{ route('dispatching.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h3 class="text-2xl font-semibold">{{ __('Detail Dispatching') }}</h3>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-6">
        <div class="bg-white rounded-md shadow col-span-2">
            <div class="py-3 px-4">
                <div class="pb-3 border-b mb-3 text-xs uppercase">
                    {{ __('Dispatching Info') }}
                </div>
                <div class="mb-8">
                    <dl>
                        <div class="mb-4 grid grid-cols-3 gap-4">
                            <dt>
                                {{ __('Shipper') }}
                            </dt>
                            <dd class="text-gray-900 col-span-2 mt-0">
                                {{ $transaction->shipper->name ?? 'n/a' }}
                            </dd>
                        </div>
                        <div class="my-4 grid grid-cols-3 gap-4">
                            <dt>
                                {{ __('Dispatch at') }}
                            </dt>
                            <dd class="text-gray-900 col-span-2 mt-0">
                                {{ format_date($transaction->transaction_at) ?? '-' }}
                            </dd>
                        </div>
                        <div class="my-4 grid grid-cols-3 gap-4">
                            <dt>
                                {{ __('Description') }}
                            </dt>
                            <dd class="text-gray-900 col-span-2 mt-0">
                                {{ $transaction->description ?? '-' }}
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="mb-6 pb-3 border-b text-xs uppercase">
                    {{ __('Dispatching Items') }}
                </div>

                <div class="mb-8">
                    <div class="grid grid-cols-4 gap-4 mb-4">
                        <div class="text-sm font-medium text-gray-700 col-span-2">
                            <span>{{__('Goods')}}</span>
                        </div>
                        <div class="text-sm font-medium text-gray-700">
                            <span>{{__('Quantity')}}</span>
                        </div>
                        <div class="text-sm font-medium text-gray-700">
                            <span>{{__('Unit')}}</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        @foreach($transaction->items as $item)
                            <div class="col-span-2">{{ $item->goods->codeName ?? 'n/a' }}</div>
                            <div>{{ number_format($item->quantity) }}</div>
                            <div>{{ $item->goods->unit->symbol ?? 'n/a' }}</div>
                        @endforeach
                    </div>
                </div>

                <div class="mb-3 pb-3 border-b text-xs uppercase">
                    {{ __('Additional Info') }}
                </div>

                <div class="mb-8">
                    <dl>
                        <div class="mb-4 grid grid-cols-3 gap-4">
                            <dt>
                                {{ __('Created by') }}
                            </dt>
                            <dd class="text-gray-900 col-span-2 mt-0">
                                {{ $transaction->creator->name ?? 'n/a' }}
                            </dd>
                        </div>
                        <div class="mb-4 grid grid-cols-3 gap-4">
                            <dt>
                                {{ __('Created at') }}
                            </dt>
                            <dd class="text-gray-900 col-span-2 mt-0">
                                {{ format_date($transaction->created_at) ?? '-' }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-4 mt-4 flex justify-between border-t rounded-b-md">
                <a href="{{ route('dispatching.index') }}"
                   class="inline-flex justify-center rounded-md bg-white py-2 px-4 text-sm font-medium border border-gray-300 shadow-sm hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    {{ __('Back') }}
                </a>
                <button
                    wire:click="printPDF()"
                    type="button"
                    class="inline-flex justify-center items-center rounded-md border border-transparent bg-slate-900 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    <svg wire:loading wire:target="printPDF" aria-hidden="true" role="status" class="w-4 h-4 text-white animate-spin mr-2" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                    {{ __('Print PDF') }}
                </button>
            </div>
        </div>
    </div>
</div>
