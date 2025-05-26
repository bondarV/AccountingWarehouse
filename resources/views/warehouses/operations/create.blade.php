<x-layout>
    <x-slot:page>
        Operation is on the process...
    </x-slot:page>
    <x-slot:backButton>
        <x-return-back/>
    </x-slot:backButton>
    <div class="max-w-2xl mx-auto mt-12 bg-white shadow-2xl rounded-2xl p-10">
        <div class="mb-8 text-center">
            <p class="text-gray-500 text-sm uppercase tracking-wide">Warehouse Stock Available</p>
            <p class="text-3xl font-black text-blue-700 underline">{{ $inventory->quantity ?? 0 }}</p>
        </div>

        <h2 class="text-center text-2xl font-bold text-gray-800 mb-8">
            Stock Operation for:
            <span class="text-indigo-600">{{ $inventory->warehouse->title }}</span>
        </h2>

        <form
            action="{{ route('warehouses.products.operations.store',[$key_warehouse->id,$inventory->product->id])}}"
            method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    {{ $variationLabel ?? 'Movement Type' }}
                </label>
                <select name="movement_type" id="movement_type"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-300 focus:ring-1"
                        required>
                    <option value="" disabled selected>Choose the intent of the operation...</option>
                    @foreach($operations as $type)
                        <option value="{{ $type->value }}">{{ ucfirst(strtolower($type->name)) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="quantity" class="block text-sm font-semibold text-gray-700 mb-1">Quantity</label>
                <input id="quantity" type="number" name="quantity" min="1" required
                       class="w-full rounded-lg border border-gray-300 px-4 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-300 focus:ring-1"/>
            </div>

            <div>
                <label for="reason" class="block text-sm font-semibold text-gray-700 mb-1">Reason</label>
                <input id="reason" type="text" name="reason" placeholder="e.g. Restocking, Sale, Damage" required
                       class="w-full rounded-lg border border-gray-300 px-4 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-300 focus:ring-1"/>
            </div>

            <div id="relocate-fields" class="hidden">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Warehouse Placement</label>
                <select name="warehouse"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-300 focus:ring-1">
                    @foreach($warehouses as $warehouse)
                        <option value="{{$warehouse->id}}">    {{$warehouse->title}} </option>
                    @endforeach>
                </select>
            </div>

            <div id="out-fields" class="hidden">
                <label for="customer" class="block text-sm font-semibold text-gray-700 mb-1">Customer Name</label>
                <input id="customer" type="text" name="customer"
                       class="w-full rounded-lg border border-gray-300 px-4 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-300 focus:ring-1"/>
            </div>

            <div>
                <button type="submit"
                        class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-bold py-2 px-6 rounded-lg shadow-md hover:from-purple-700 hover:to-indigo-700 transition-all duration-300">
                    Submit Operation
                </button>
            </div>
        </form>
    </div>

    @vite('resources/js/script.js')
</x-layout>
