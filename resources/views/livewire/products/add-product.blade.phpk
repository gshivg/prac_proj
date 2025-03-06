<div class="flex flex-row items-center justify-center h-full">
    <div class="w-[33%] h-min p-4 gap-2 bg-white-700 rounded-md bg-clip-padding backdrop-filter backdrop-blur-md bg-opacity-30 border border-gray-100">
        <h1 class="text-xl">Add Products</h1>
        <form wire:submit="save" class="flex flex-col gap-2 mt-2">
            <flux:input wire:model="name" label="Product Name"  />
            <flux:textarea wire:model="description" label="Description" rows="3" resize="none" />
            <flux:input wire:model="price" label="Price" type="number" icon="currency-rupee" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"/>
            <flux:dropdown class="w-full">
                <flux:button class="w-full" icon-trailing="chevron-down">Category</flux:button>

                <flux:menu>
                    <flux:menu.radio.group wire:model="category">
                    @foreach ($categories as $category)
                        <flux:menu.radio>{{$category}}</flux:menu.radio>
                    @endforeach
                    </flux:menu.radio.group>
                </flux:menu>
            </flux:dropdown>
            <flux:input wire:model="category" label="Selected Category" placeholder="Select Category" disabled type="text" icon="lock-closed" />
            <flux:input wire:model="best_before" label="Best Before in Months" type="number" icon="calendar" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"/>
            <flux:button type="submit" variant="primary" icon="plus" wire:click="">Add</flux:blutton>
        </form>
    </div>
</div>
