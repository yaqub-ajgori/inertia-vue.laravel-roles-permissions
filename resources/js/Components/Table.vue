<script setup>

</script>

<template>

<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-white uppercase bg-gray-800">
           <slot name="header"></slot>
        </thead>
        <tbody>
            <slot name="default"></slot>
        </tbody>
    </table>
</div>
</template>
