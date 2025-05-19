<x-display-template
    :items="$items"
    href="products"
    labelField="name"
    labelSource="product"
    quantityField="quantity">
    <x-slot:header>Products</x-slot:header>
</x-display-template>
